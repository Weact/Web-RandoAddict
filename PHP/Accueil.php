<!DOCTYPE html>
<html lang="en">

<?php
    /* Remplace la balise HEAD des pages HTML */
    include_once('Structure/Head.php');
    /* Inclu le header dans la page */
    include_once('Structure/Header.php');
    
?>

<body class="h-100 text-center text-white bg-dark">

    <?php
        include_once('Randonnee.php');
    ?>

    <?php
    /* Inclu le footer dans la page */
    /* Contient des liens, le copyright et les réseaux sociaux */
    include_once('Structure/Footer.php');
    ?>
</body>

</html>