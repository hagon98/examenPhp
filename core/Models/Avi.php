<?php

namespace Models;

require_once "AbstractModel.php";


class Avi extends AbstractModel
{

    protected string $nomDeLaTable = "avis";

    private int $id;
    private string $author;
    private string $content;
    private int $veloId;

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {

        $this->author = $author;
    }


    public function getContent()
    {
        return $this->content;
    }


    public function setContent($content)
    {

        $this->content = $content;
    }

    public function getveloId()
    {
        return $this->veloId;
    }

    public function setveloId($veloId)
    {
        $this->veloId = $veloId;
    }


    /**
     * trouve tous les velo associés à un vélos
     * 
     * @param int $veloID
     * 
     * @return array|bool
     * 
     */
    public function findAllByVelo(int $velo_id)
    {


        $maRequetePourDesAvis = $this->pdo->prepare("SELECT * FROM avis
                WHERE velo_id = :velo_id");

        $maRequetePourDesAvis->execute([
            "velo_id" => $velo_id
        ]);

        $avis = $maRequetePourDesAvis->fetchAll(\PDO::FETCH_CLASS, get_class($this));


        return $avis;
    }


    /**
     * 
     * enregistre un avis dans la base de données
     * 
     * @param string $author
     * @param string $content
     * @param integer $veloId
     */
    public function save(Avi $avis): void
    {




        $maRequeteCreationAvis = $this->pdo->prepare("INSERT INTO avis 
          (author, content, velo_id ) 
          VALUES(:avis_author, :avis_content, :velo_id)");

        $maRequeteCreationAvis->execute([
            "avis_author" => $avis->author,
            "avis_content" => $avis->content,
            "velo_id" => $avis->veloId
        ]);
    }

    public function edit(AVi $avi)
    {

        $sql = $this->pdo->prepare("UPDATE {$this->nomDeLaTable} 
        SET author = :author, content = :content, WHERE velo_id = :velo_id");

        $sql->execute([
            "author" => $avi->author,
            "content" => $avi->content,
            "id" => $avi->veloId
        ]);
    }
}
