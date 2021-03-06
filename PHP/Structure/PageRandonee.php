<?php

/*******************************************************************************\
 * Fichier       : /PHP/PageRandonee.php
 *
 * Description   : Fichier PHP incluant les ressources php et html nécéssaires pour la page
 * Fonction      : -.
 *
 * Créateur      : Gaetan Galati
 * Superviseur   : Lucas DRUCKES
\*******************************************************************************/
/*******************************************************************************\
 * 23-03-2022    : Création page
 * 28-03-2022    : Pull Request et mise en commun avec le travail général
\*******************************************************************************/
?>

<section>
    <h1 class="text-center" style="padding-top: 10%;">La randonnée du KFC</h1>
    <h2 class="text-center">Difficulté modérée</h2>

    <div class="d-flex justify-content-center">
        <iframe
            src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin=Pl.+des+Halles,+67000+Strasbourg&destination=KFC+Homme+de+fer&mode=walking"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class=" text-dark font-weigh-bolder text-uppercase m-3"
        style=" border-radius: 30px; background-color: rgba(180, 180, 180, 0.8)">
        <div class="row m-5">
            <div class="col-12">
                <div class="embed-responsive embed-responsive-1by1 text-center">
                    <div class="embed-responsive-item h3">DESCRIPTION</div>
                    <div class="embed-responsive-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-2 embed-responsive-item h4">Depart</div>
                <div class="col-2 embed-responsive-item">LIEU DE DEPART</div>
                <div class="col-2 embed-responsive-item">HEURE DE DEPART</div>
                <div class="w-100 "></div>
                <div class="col-2 embed-responsive-item h4">Arrivée</div>
                <div class="col-2 embed-responsive-item">LIEU D'ARRIVÉE </div>
                <div class="col-2 embed-responsive-item">HEURE D'ARRIVÉ R</div>
                <div class="w-100 "></div>
                <div class="col-2 embed-responsive-item h4">Matériel</div>
                <div class="col-2 embed-responsive-item">OBJET</div>
                <div class="col-2 embed-responsive-item">OBJET</div>
                <div class="col-2 embed-responsive-item">OBJET</div>
                <div class="col-2 embed-responsive-item">OBJET</div>
                <div class="col-2 embed-responsive-item">OBJET</div>
                <div class="w-100 "></div>
                <span
                    class="col-1 d-flex justify-content-center fs-5 bg-dark text-light border rounded-pill border-5 border-primary m-3">
                    00.00 $</span>
                <button type="button" class="btn btn-primary ">Rejoindre comme randonneur</button>
                <button type="button" class="btn btn-success ">Rejoindre comme Guide</button>
                <p
                    style="display: flex; color: white; display: flex; justify-content : center; font-size: larger; background-color: black;">
                    <span>0 </span> <span> / </span> <span> 10 </span> Participants
                </p>

            </div>
        </div>
    </div>

    <style>
        body {
            /* a changer en fonction de la randonnée */
            background-image: url('/ASSETS/PaysageRandonnee_2.jpg');
        }
    </style>
</section>