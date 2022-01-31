<?php

namespace Models;

class Velo extends AbstractModel
{

    protected string $nomDeLaTable = "velos";

    private int $id;
    private string $name;
    private string $description;
    private string $image;
    private int $price;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * ajoute un nouveau velo dans la BDD
     *@param Velo $velo
     * @return void
     */
    public function save(Velo $velo)
    {

        $sql = $this->pdo->prepare("INSERT INTO {$this->nomDeLaTable} 
          (name, description, image, price ) 
          VALUES (:name, :description, :image, :price)");

        $sql->execute([
            "name" => $velo->name,
            "description" => $velo->description,
            "image" => $velo->image,
            "price" => $velo->price
        ]);
    }

    public function edit(Velo $velo)
    {

        $sql = $this->pdo->prepare("UPDATE {$this->nomDeLaTable} 
        SET name = :name, description = :description, image = :image, price = :price WHERE id = :id");

        $sql->execute([
            "name"  => $velo->name,
            "description" => $velo->description,
            "image" => $velo->image,
            "price" => $velo->price,
            "id" => $velo->id
        ]);
    }
}
