<?php

namespace App;

class Response
{

    /**
     * redirige la page vers le lien fournis
     * 
     * @param string $url
     * 
     * @return void
     * 
     */

    public static function redirect(?array $parametres = null): void
    {
        $url = "";

        if ($parametres) {
            $url = "?";
            foreach ($parametres as $cle => $valeur) {

                $nouveauParam = $cle . "=" . $valeur . "&";
                $url .= $nouveauParam;
            }
        }


        header("Location: .$url");
        exit();
    }
}
