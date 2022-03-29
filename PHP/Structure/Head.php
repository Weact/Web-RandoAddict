<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rando Addict Ludus</title>

    <!-- CUSTOM CSS FOR HEADERS -->
    <link rel="stylesheet" href="../CSS/header.css">

    <!--  Adding a link to the CSS file that is used to make the Bootstrap CSS work. -->
    <link rel="stylesheet" href="../CSS/bootstrap/bootstrap.css">
    <!-- This is the JavaScript, Popper Included, that is used to make the Bootstrap CSS work. -->
    <script src="../JS/bootstrap/bootstrap.bundle.js"></script>

    <!-- This is adding a link to a CSS file that is used to make the Bootstrap CSS Icons work. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


    <link rel="icon" type="image/x-icon" href="../ASSETS/favicon.ico">

    <script src="AJAX/pageNavigator.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<?php
  //CONNEXION AUTOMATIQUE
    //Vérification et initialisation des variables de session le cas échéant.
    if ($_SESSION['typeUtilisateur'] == "Guide")
    {
      require_once("Structure/HeaderAdmin.php");
    }
    elseif($_SESSION['typeUtilisateur'] == "Marcheur")
    {
      require_once("Structure/HeaderOnline.php");
    }
    else
    {
      require_once("Structure/Header.php");
    }


?>
