<?php

namespace Controllers;

class Velo extends AbstractController

{

    protected $defaultModelName = \Models\Velo::class;

    /**
     * affiche l'accueil des velos avec TOUS les velos
     */
    public function index()
    {


        $velos = $this->defaultModel->findAll();

        $pageTitle = "Accueil des vélos";

        return $this->render("velos/index", compact(["pageTitle", "velos"]));
    }


    /**
     * afficher un velo
     */
    public function show()
    {

        $id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!$id) {
            return $this->redirect([
                'type' => 'velo',
                'action' => 'index',
                'info' => 'noId'
            ]);
        }


        $velo = $this->defaultModel->findById($id);

        if (!$velo) {
            return $this->redirect([
                'type' => 'velo',
                'action' => 'index'
            ]);
        }

        $modelAvis = new \Models\Avi();
        $avis = $modelAvis->findAllByVelo($id);

        return $this->render("velos/show", ["pageTitle" => $velo->getName(), "velo" => $velo, "avis" => $avis]);
    }


    /**
     * Créer une nouveau velo
     * 
     * 
     */
    public function new()
    {
        $name = null;
        $image = null;
        $description = null;
        $price = null;

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (!empty($_POST['image'])) {
            $image = $_POST['image'];
        }
        if (!empty($_POST['description'])) {
            $description = $_POST['description'];
        }

        if (!empty($_POST['price']) && ctype_digit($_POST['price'])) {
            $price = $_POST['price'];
        }

        if ($name && $image && $description && $price) {

            $velo = new \Models\Velo();
            $velo->setname($name);
            $velo->setImage($image);
            $velo->setDescription($description);
            $velo->setPrice($price);

            $this->defaultModel->save($velo);

            return $this->redirect(["type" => "velo", "action" => "index"]);
        }
        return $this->render("velos/create", ["pageTitle" => 'Nouveau cocktail']);
    }

    /**
     * supprimer un cocktail par son ID et rediriger vers l'index des cocktails
     * 
     * 
     */
    public function delete()
    {

        $id = null;
        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = $_POST['id'];
        }

        if (!$id) {
            return $this->redirect([
                "type" => "velo",
                "action" => "index",
                "info" => "noId"
            ]);
        }


        if (!$this->defaultModel->findById($id)) {
            return $this->redirect([
                "type" => "velo",
                "action" => "index",
                "info" => "noId"
            ]);
        }

        $this->defaultModel->remove($id);

        return $this->redirect([
            "type" => "velo",
            "action" => "index",
            "info" => "deleted"
        ]);
    }

    public function edit()
    {

        $idEdit = null;
        $name = null;
        $description = null;
        $image = null;
        $price = null;

        if (!empty($_POST['idEdit']) && ctype_digit($_POST['idEdit'])) {
            $idEdit = $_POST['idEdit'];
        }
        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (!empty($_POST['description'])) {
            $description = $_POST['description'];
        }

        if (!empty($_POST['image'])) {
            $image = $_POST['image'];
        }
        if (!empty($_POST['price']) && ctype_digit($_POST['price'])) {
            $price = $_POST['price'];
        }

        if ($idEdit && $name && $description && $image && $price) {

            $velo = $this->defaultModel->findById($idEdit);

            if (!$velo) {
                return $this->redirect(["type" => "velo", "action" => "show", "id" => $idEdit]);
            }

            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setImage($image);
            $velo->setPrice($price);


            $this->defaultModel->edit($velo);

            return $this->redirect([
                "type" => "velo",
                "action" => "show",
                "id" => $velo->getId()
            ]);
        }


        $id = null;
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }

        $velo = $this->defaultModel->findById($id);

        if (!$velo) {
            return $this->redirect(["type" => "velo", "action" => "show", "id" => $id]);
        }

        return $this->render("velos/edit", [
            "pageTitle" => "modifier",
            "velo" => $velo
        ]);
    }
}
