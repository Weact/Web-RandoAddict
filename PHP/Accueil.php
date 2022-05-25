<?php
/*******************************************************************************\
* Fichier       : Accueil.php
*
* Description   : Fichier PHP principal du site; SEUL le header et le body de la
*                   page change en fonction de la situation
* Fonction      : -.
*
* Créateur      : Lucas DRUCKES
\*******************************************************************************/
/*******************************************************************************\
* 21-03-2022    : Création page
\*******************************************************************************/

  session_start();
  include_once('Include/gestionFormBDD.php')
?>
<!DOCTYPE html>
<html lang="en">
<?php
    /* Remplace la balise HEAD des pages HTML */
    include_once('Structure/Head.php');

?>
    <div class="container">
      <div class="toast bg-success" id="toastSuccess" data-delay="3000" style="position: absolute; top: 1rem; right: 1rem; min-width:250px;" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
          Succès !
        </div>
      </div>

      <div class="toast bg-danger" id="toastError" data-delay="3000" style="position: absolute; top: 1rem; left: 1rem; min-width:250px;" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
          Erreur !
        </div>
      </div>
    </div>

    <script>
      //$('#toastSuccess').toast('show');
      //$('#toastError').toast('show');
    </script>

<body class="h-100 text-center text-white bg-dark">
    <main id="main">

    </main>

    <?php
    /* Inclu le footer dans la page */
    /* Contient des liens, le copyright et les réseaux sociaux */
    include_once('Structure/Footer.php');
    ?>
</body>

</html>
