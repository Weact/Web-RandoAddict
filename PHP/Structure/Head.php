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

  if(isset($_SESSION)){
    //CONNEXION AUTOMATIQUE
  }

  if(isset($_POST["sMail_Marcheur_Inscription"]))
  {
    require_once("DBOperation/Managers/ManagerMarcheur.php");
    require_once("DBOperation/PDO_Connect.php");
    $conn = connect_bd();
    $mng = new ManagerMarcheur($conn);

    $donnees = array(
      'sMail_Marcheur' => $_POST['sMail_Marcheur_Inscription'],
      'sPseudo_Marcheur' => $_POST['sPseudo_Marcheur'],
      'sTel_Marcheur' => $_POST['sTel_Marcheur'],
      'sMdp_Marcheur' => $_POST['sMdp_Marcheur'],
      'sRole_Marcheur' => 'Marcheur'
      );

    $new_marcheur = new Marcheur();
    $new_marcheur->hydrate($donnees);
    $result = $mng->insertMarcheur($new_marcheur);


    //CONNEXION AUTOMATIQUE
    require_once("Structure/HeaderOnline.php");

  }
  elseif(isset($_POST["sMail_Marcheur_Connexion"])) {
      //CONNEXION AUTOMATIQUE
      require_once("Structure/HeaderOnline.php");


  }
  else {
  require_once("Structure/Header.php");

  }

?>
