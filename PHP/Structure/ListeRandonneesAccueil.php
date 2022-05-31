<?php session_start();
require_once(__DIR__ . '/../Include/programManager.php');
  $progs = getAllPrograms();

?>
<section class="container-fluid w-100 h-100" id="randonneesection">
    <div id="randoPaysages" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $nb = 0;
            foreach($progs as $prog){
              if($nb > 2){
                break;
              }
              $nb++;
            echo '<button type="button" data-bs-target="#randoPaysages" data-bs-slide-to="'.($prog['idProgramme']-1).'" class="active p-2"
                aria-current="true" aria-label="Randonnee Paysage 1"></button>';
          }  ?>

        </div>
        <div class="carousel-inner">

              <?php
              $nb = 0;
              foreach($progs as $prog){
                if($nb > 2){
                  break;
                }
                $photo = getPhotoOfExcursion(getExcsOfProg($prog)[0]['idExcursion']);

                $photolink = '/../../ASSETS/' . $photo['lienPhoto'];?>
              <div class="carousel-item
              <?php if($nb == 0){
                echo "active";} ?>
              ">
                  <img src=
                  <?php
                  echo $photolink;
                  $nb++;
                  ?>
                  class="d-block w-100" alt="paysage1" style="height: 800px;">
                  <div class="carousel-caption d-md-block text-dark font-weigh-bolder text-uppercase m-5"
                      style="background-color: rgba(180, 180, 180, 0.5)">
                      <h1 class="display-5"><?php echo $prog['labelProgramme']; ?></h1>
                      <span><?php echo $prog['descProgramme']; ?></span>
                  </div>
              </div>'
            <?php }  ?>

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
      <div class="row p-1" id="randonneeCardsRow">
          <!-- ADD CHILD CARDS IN THIS ELEMENT -->
          <?php
          include_once("RandonneeCardsGenerator.php")
      ?>
        </div>
    </div>
</section>
