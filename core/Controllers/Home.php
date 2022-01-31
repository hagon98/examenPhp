<?php

namespace Controllers;

class Home extends AbstractController

{

    protected $defaultModelName = \Models\Home::class;


    public function index()
    {
        //si on a besoin de réagir avec la BDD, on peut utiliser le modele par defaut
        //du controller et faire une requete sur la table sql par defaut
        // depusi cette class directement

        // $element = $this->defaultModel->findAll()

        //ici la methode render a besoin de deux parametres, un nom de dossier template ainsi
        //qu'un nom de fichier également un tableau d'option avec au moin le nom de la page

        return $this->render("home/index", [
            "pageTitle" => "Accueil"
        ]);
    }
}
