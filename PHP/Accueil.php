<!DOCTYPE html>
<html lang="en">

<?php
    /* Changez la variable header_to_load pour ; HeaderOnline ; HeaderAdmin */
    $header_to_load = 'HeaderAdmin';
    $header_path = 'Structure/' . $header_to_load . '.php';

    /* Remplace la balise HEAD des pages HTML */
    include_once('Structure/Head.php');
    /* Inclu le header online dans la page */
    include_once($header_path);
    
?>

<body class="h-100 text-center text-white bg-dark">

    <?php
        include_once('Structure/ListeRandonneesAccueil.php');
    ?>

    <?php
    /* Inclu le footer dans la page */
    /* Contient des liens, le copyright et les réseaux sociaux */
    include_once('Structure/Footer.php');
    ?>
</body>

</html>