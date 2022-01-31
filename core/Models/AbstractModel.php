<?php

namespace Models;

require_once "core/Database/PdoMySQL.php";

abstract class AbstractModel
{
    protected string $nomDeLaTable;
    protected $pdo;

    public function __construct()
    {
        $this->pdo = \Database\PdoMySQL::getPdo();
    }


    /**
     * 
     * retourne un tableau contenant TOUS les elements 
     * tous les champs de la table SQL en question
     * 
     * @param string $option
     * @return array $elements
     * 
     * 
     */
    public function findAll(?string $option = null): array
    {
        $requete = "SELECT * FROM {$this->nomDeLaTable}";

        if ($option) {
            $requete .= " ORDER BY id " . $option;
        }

        $requete = $this->pdo->query($requete);

        $elements = $requete->fetchAll(\PDO::FETCH_CLASS, get_class($this));

        return $elements;
    }


    /**
     * 
     * trouver un element par son id
     * renvoie un tableau contenant un element
     * 
     * @param integer $id
     * @return array|bool
     * 
     */
    public function findById(int $id)
    {


        $maRequete = $this->pdo->prepare("SELECT * 
                        FROM {$this->nomDeLaTable} WHERE id = :id");

        $maRequete->execute(
            [
                "id" => $id
            ]

        );

        $maRequete->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        $element = $maRequete->fetch();

        return $element;
    }

    /**
     * 
     * supprimer un element de la BDD par le biais de son id
     * 
     * @param integer $id
     * @return void
     * 
     * 
     */
    public function remove(int $id): void
    {



        $requeteSuppression = $this->pdo->prepare("DELETE FROM {$this->nomDeLaTable} WHERE id = :id");

        $requeteSuppression->execute([
            "id" => $id
        ]);
    }

    //Lorsqu'on declare une nouvelle class et que l'on veut enregistrer des nouveaux objet de cette classe dans la BDD
    //il nous faut une methode save dans laquel on effectue une requete sql mais en premier on déclare des propriete privee 
    // qui on le nom des colonnes de la table puis on cree des getteur et des setteur qui donne accés au propriétés qui sont privée

    // exemple  private $description;
    //  public function getDescription(){
    //          return $this->description;
    // }
    //  public function setDescription(string $uneDescription){
    //          $this->description = $uneDescription;
    // }

    // public function save(CLASS $objetDUneClasse)
    // {
    //     
    //         $sql = $this->pdo->prepare("INSERT INTO {$this->nomDeLaTable} 
    //       (description) 
    //       VALUES (:descirption)");

    //         $sql->execute([
    //             "description" => $objetDUneClasse->description

    //         ]);
    //     }
    // }
}
