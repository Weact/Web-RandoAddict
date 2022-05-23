<?php
define('BASE','randoaddict');
define('SERVER','localhost');
define('USER','Luc');
define('PASSWD','lemdp');

function connect_bd()
{
	$dsn = "mysql:dbname=".BASE.";host=".SERVER;
	try
	{
		$connexion = new PDO($dsn, USER, PASSWD);
		//echo "<script>console.log('Connexion réussie')</script>";
		return $connexion;
	}
	catch(PDOException $e)
	{
		printf("Echec de la connexion : %s\n", $e->getMessage());
		exit();
	}
}
?>
