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

  include_once('Include/gestionFormBDD.php')
?>
<!DOCTYPE html>
<html lang="en">

<?php
    /* Remplace la balise HEAD des pages HTML */
    include_once('Structure/Head.php');
?>

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
