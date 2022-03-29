<?php
/*******************************************************************************\
* Fichier       : /PHP/Include/gestionFormBDD.php
*
* Description   : Fichier répertoriant les réceptions de formulaires et leur gestion.
*
* Créateur      : Romain Schlotter
\*******************************************************************************/
/*******************************************************************************\
* 29-03-2022   : Création du fichier
\*******************************************************************************/
    session_start();

    //Vérification et initialisation des variables de session le cas échéant.
    if (!isset($_SESSION['typeUtilisateur']))
    {
        $_SESSION['typeUtilisateur'] = "anon";
    }
    if (!isset($_SESSION['nomUtilisateur']))
    {
        $_SESSION['nomUtilisateur'] = "anon";
    }

    //Gestion de toutes les réceptions de tous les formulaires formulaires.
    if ($_POST['dataForm'])
    {
       if (true)
       {
            header("HTTP/1.1 303 See Other");
            header("Location: ./");
            exit();
       }
       else
       {
            header("HTTP/1.1 303 See Other");
            header("Location: ./");
            exit();
       }
    }
?>