<!--/*******************************************************************************\
* Fichier       : /PHP/Structure/googleMap.php
*
* Description   : Fichier permettant de créer un iframe googlemap pour le site RandoAddict.
* Fonction      : createGoogleMapIframeTravel void : écrit un iframe html avec la carte google map.
*
* Créateur      : Romain Schlotter
\*******************************************************************************/
/*******************************************************************************\
* 23-03-2022   : Création de la fonction de createGoogleMapIframeTravel
\*******************************************************************************/-->
<?php

    function createGoogleMapIframeTravel($depart,$arrive,$taille)
    //BUT : Créer une carte google map avec un trajet à pieds.
    //ENTREE : L'adresse de départ et d'arrivée sous la forme : 
    //          "Pl.+des+Halles,+67000+Strasbourg"
    //          "KFC+Homme+de+fer"
    //          Ainsi que la taille qui est un entier de 0 à 2 pour les tailles petit, moyen, grand. 
    //SORTIE : Un Iframe Google Map écrit en html à l'endroit de l'appel de la fonction.
    {
        if ($taille<=0)
        {
            echo '<iframe src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin='.$depart.'&destination='.$arrive.'&mode=walking" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        }
        else if ($taille <=1)
        {
            echo '<iframe src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin='.$depart.'&destination='.$arrive.'&mode=walking" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        }
        else if ($taille >1)
        {
            echo '<iframe src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin='.$depart.'&destination='.$arrive.'&mode=walking" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        }
    }


    //BUT : Si le fichier php est appelé avec une requête GET, renvoyer une carte à l'endroit de l'appel.
    //ENTREE : les informations depart et arrivé ainsi que la taille dans GET pour la fonction createGoogleMapIframeTravel()
    //SORTIE : L'iframe renvoyé par la fonction en html.
    /*if (isset($_GET['depart'] && isset($_GET['arrive'])))
    {
        //Mise en place des données
        $depart = $_GET['depart'];
        $arrive = $_GET['arrive'];
        $taille = 1;
        if ($isset($_GET['taille']))
        {
            $taille = $_GET['taille'];
        }

        //Appel de la fonction
        createGoogleMapIframeTravel($depart,$arrive,$taille);
    }*/

    
    createGoogleMapIframeTravel("Pl.+des+Halles,+67000+Strasbourg","11+Rue+de+la+Rheinmatt,+67000+Strasbourg",2);//C'est l'adresse à donner à Tom.
?>