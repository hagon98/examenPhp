<?php

namespace Controllers;

class Avi extends AbstractController
{

    protected $defaultModelName = \Models\Avi::class;

    /**
     * supprime un avi par son ID
     * 
     * @return Response
     */
    public function delete()
    {

        $id = null;

        if (!empty($_POST['id']) && \ctype_digit($_POST['id'])) {
            $id = $_POST['id'];
        }

        if (!$id) {
            die("Erreur sur L'id. Pars .");
        }
        //verifier que l'avi existe

        $avi = $this->defaultModel->findById($id);

        if (!$avi) {

            return $this->redirect(["type" => "velo", "action" => "show"]);
        }

        $this->defaultModel->remove($id);

        return $this->redirect(["type" => "velo", "action" => "show", "id" => $avi->velo_id]);
    }


    /**
     * crée un nouveau avis
     *
     */
    public function new()
    {


        $veloId = null;
        $author = null;
        $content = null;

        if (!empty($_POST['veloId']) && ctype_digit($_POST['veloId'])) {

            $veloId = $_POST['veloId'];
        }
        if (!empty($_POST['author'])) {

            $author = htmlspecialchars($_POST['author']);
        }

        if (!empty($_POST['content'])) {

            $content = htmlspecialchars($_POST['content']);
        }



        if (!$veloId || !$content || !$author) {

            return $this->redirect(["type" => "velo", "action" => "show", "id" => $veloId]);
        }


        // on vérifie si le velo existe bien avant de le commenter

        $modelVelo = new \Models\Velo();

        $velo = $modelVelo->findById($veloId);



        if (!$velo) {
            return $this->redirect([
                "type" => "velo",
                "action" => "index"
            ]);
        }

        $avi = new \Models\Avi();
        $avi->setAuthor($author);
        $avi->setContent($content);
        $avi->setveloId($veloId);

        $this->defaultModel->save($avi);



        return $this->redirect(["type" => "velo", "action" => "show", "id" => $veloId]);
    }


    public function edit()
    {

        $idEdit = null;
        $author = null;
        $content = null;


        if (!empty($_POST['idEdit']) && ctype_digit($_POST['idEdit'])) {
            $idEdit = $_POST['idEdit'];
        }
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }
        if (!empty($_POST['content'])) {
            $content = $_POST['content'];
        }



        if ($idEdit && $author && $content) {

            $avi = $this->defaultModel->findById($idEdit);

            if (!$avi) {
                return $this->redirect(["type" => "velo", "action" => "show", "id" => $idEdit]);
            }

            $avi->setAuthor($author);
            $avi->setContent($content);
            $avi->setVeloId($idEdit);

            $this->defaultModel->edit($avi);

            return $this->redirect([
                "type" => "velo",
                "action" => "show",
                "id" => $avi->getVeloId()
            ]);
        }


        $id = null;
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }

        $avi = $this->defaultModel->findById($id);

        if (!$avi) {
            return $this->redirect(["type" => "velo", "action" => "show", "id" => $id]);
        }

        return $this->render("avi/edit", [
            "pageTitle" => "modifier",
            "avi" => $avi
        ]);
    }
}
