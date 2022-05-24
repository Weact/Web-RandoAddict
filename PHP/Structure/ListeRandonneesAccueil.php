<?php
session_start();
?>

<section class="container-fluid w-100 h-100" id="randonneesection">
    <div id="randoPaysages" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#randoPaysages" data-bs-slide-to="0" class="active p-2" aria-current="true" aria-label="Randonnee Paysage 1"></button>
            <button type="button" data-bs-target="#randoPaysages" data-bs-slide-to="1" aria-label="Randonnee Paysage 2" class="p-2"></button>
            <button type="button" data-bs-target="#randoPaysages" data-bs-slide-to="2" aria-label="Randonnee Paysage 3" class="p-2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../ASSETS/PaysageRandonnee_1.jpg" class="d-block w-100" alt="paysage1" style="height: 800px;">
                <div class="carousel-caption d-md-block text-dark font-weigh-bolder text-uppercase m-5" style="background-color: rgba(180, 180, 180, 0.5)">
                    <h1 class="display-5">Randonnée - Montagne / Lac</h1>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../ASSETS/PaysageRandonnee_2.jpg" class="d-block w-100" alt="paysage2" style="height: 800px;">
                <div class="carousel-caption d-md-block text-dark font-weigh-bolder text-uppercase m-5" style="background-color: rgba(180, 180, 180, 0.5)">
                    <h1 class="display-5">Randonnée - Montagne</h1>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../ASSETS/PaysageRandonnee_3.jpg" class="d-block w-100" alt="paysage3" style="height: 800px;">
                <div class="carousel-caption d-md-block text-dark font-weigh-bolder text-uppercase m-5" style="background-color: rgba(180, 180, 180, 0.5)">
                    <h1 class="display-5">Randonnée - Forêt</h1>
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#randoPaysages" data-bs-slide="prev" style="font-size: 100rem;">
            <span class="carousel-control-prev-icon p-5" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#randoPaysages" data-bs-slide="next">
            <span class="carousel-control-next-icon p-5" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid" id="randonneeCardContainer">
        <div class="row p-1" id="randonneeCardsRow">
            <!-- ADD CHILD CARDS IN THIS ELEMENT -->
            <?php
            include_once("RandonneeCardsGenerator.php")
            ?>
        </div>
    </div>
</section>