<?php
session_start();
require_once(__DIR__ . "/../Include/programManager.php");

$excursions = getAllExc();
$max = count($excursions)-1;

$rand_int_0 = rand(0, $max);
$rand_int_1 = rand(0, $max);
$rand_int_2 = rand(0, $max);

$excursion_0 = $excursions[$rand_int_0];
$excursion_1 = $excursions[$rand_int_1];
$excursion_2 = $excursions[$rand_int_2];

$conn = connect_bd();
$mng_Photo = new ManagerPhoto($conn);

$photo_0 = $mng_Photo->selectPhotosByExcursionId($excursion_0[0])['stmt'];
$photo_1 = $mng_Photo->selectPhotosByExcursionId($excursion_1[0])['stmt'];
$photo_2 = $mng_Photo->selectPhotosByExcursionId($excursion_2[0])['stmt'];

if (count($photo_0) > 0) {
    $photo_0 = "../ASSETS/" . $photo_0[0][1];
} else {
    $photo_0 = '../ASSETS/PaysageRandonnee_2.jpg';
}

if (count($photo_1) > 0) {
    $photo_1 = "../ASSETS/" . $photo_1[0][1];
} else {
    $photo_1 = '../ASSETS/PaysageRandonnee_2.jpg';
}

if (count($photo_2) > 0) {
    $photo_2 = "../ASSETS/" . $photo_2[0][1];
} else {
    $photo_2 = '../ASSETS/PaysageRandonnee_2.jpg';
}

?>

<section class="container-fluid w-100 h-100" id="randonneesection">
    <div id="randoPaysages" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#randoPaysages" data-bs-slide-to="0" class="active p-2"
                aria-current="true" aria-label="Randonnee Paysage 1"></button>
            <button type="button" data-bs-target="#randoPaysages" data-bs-slide-to="1" aria-label="Randonnee Paysage 2"
                class="p-2"></button>
            <button type="button" data-bs-target="#randoPaysages" data-bs-slide-to="2" aria-label="Randonnee Paysage 3"
                class="p-2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo $photo_0; ?>" class="d-block w-100" alt="paysage1" style="height: 800px;">
                <div class="carousel-caption d-md-block text-dark font-weigh-bolder text-uppercase m-5"
                    style="background-color: rgba(180, 180, 180, 0.5)">
                    <h1 class="display-5"><?php echo $excursion_0[1]; ?></h1>
                    <span><?php echo $excursion_0[2]; ?></span>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo $photo_1; ?>" class="d-block w-100" alt="paysage2" style="height: 800px;">
                <div class="carousel-caption d-md-block text-dark font-weigh-bolder text-uppercase m-5"
                    style="background-color: rgba(180, 180, 180, 0.5)">
                    <h1 class="display-5"><?php echo $excursion_1[1]; ?></h1>
                    <span><?php echo $excursion_1[2]; ?></span>
                </div>
            </div>
            <div class="carousel-item">
                <img src=" <?php echo $photo_2; ?>" class="d-block w-100" alt="paysage3" style="height: 800px;">
                <div class="carousel-caption d-md-block text-dark font-weigh-bolder text-uppercase m-5"
                    style="background-color: rgba(180, 180, 180, 0.5)">
                    <h1 class="display-5"><?php echo $excursion_2[1]; ?></h1>
                    <span><?php echo $excursion_2[2]; ?></span>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#randoPaysages" data-bs-slide="prev"
            style="font-size: 100rem;">
            <span class="carousel-control-prev-icon p-5" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#randoPaysages" data-bs-slide="next">
            <span class="carousel-control-next-icon p-5" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid" id="randonneeCardContainer">
        <div class="row p-1" id="randonneeCardsRow"> <!-- ADD CHILD CARDS IN THIS ELEMENT -->
        <?php
            include_once("RandonneeCardsGenerator.php")
        ?>
        </div>
    </div>
</section>