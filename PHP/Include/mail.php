<!--/*******************************************************************************\
* Fichier       : /PHP/Include/mail.php
*
* Description   : Fichier répertoriant les fonctions d'envoie de mail pour le site RandoAddict.
* Fonction      : sendMail void : Envoie un mail au client avec le titre du mail et le texte du mail en argument.
*
* Créateur      : Romain Schlotter
*
* Note          : Pour fonctionner ce fichier a besoin d'inclure le dossier /sendmail ainsi que de modifier le fichier php.ini tel que dans le dossier /INCLUSION_WAMP à la racine de ce projet.
\*******************************************************************************/
/*******************************************************************************\
* 22-03-2022   : Création de la fonction de sendmail
\*******************************************************************************/-->
<?php

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
$etat = 2;
//1 = La randonnée est ok
//2 = La randonnée est annulé
function sendMail($mailClient, $titre, $etat, $Date, $Date2, 
                 $guide, $Lieu,$Lieu2, $NbGens, $difficult, $Materiel)
//BUT : Envoyer un mail à un client.
//ENTREE : Le mail du client, le titre du mail et le texte du mail.
//SORTIE : Le mail envoyé au client avec une image de pingouin.
{
    //----------------------------------
    // Construction de l'entête
    //----------------------------------
    $delimiteur = "-----=".md5(uniqid(rand()));

    $entete = "MIME-Version: 1.0\r\n";
    $entete .= "Content-Type: multipart/related; boundary=\"$delimiteur\"\r\n";
    $entete .= "\r\n";

    //--------------------------------------------------
    // Construction du message proprement dit
    //--------------------------------------------------

    $msg = "";

    //---------------------------------
    // 1ère partie du message
    // Le code HTML
    //---------------------------------
    $msg .= "--$delimiteur\r\n";
    $msg .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
    $msg .= "Content-Transfer-Encoding:8bit\r\n";
    $msg .= "\r\n";
    /*$msg .= "<html><body>";
    //$msg .= "<h1>Email HTML avec 1 image</h1>"; //Corps du mail
    $msg .= "<div>".$texte."</div>";
    $msg .= "<img src=\"cid:image1\"><br/>"; //L'id cid: correspond au Content-ID du fichier joint.
    $msg .= "</html>\r\n";*/
    if ($etat == 1){
        echo('1');
       $msg .= "
<html>
<html>

<body>
<style>
    
* { margin: 0; padding: 0; font-size: 100%; font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height: 1.65; }

img { max-width: 100%; margin: 0 auto; display: block; }

body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }

a { color: #71bc37; text-decoration: none; }

a:hover { text-decoration: underline; }

.text-center { text-align: center; }

.text-right { text-align: right; }

.text-left { text-align: left; }

.button { display: inline-block; color: white; background: #71bc37; border: solid #71bc37; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }

.button:hover { text-decoration: none; }

h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }

h1 { font-size: 32px; }

h2 { font-size: 28px; }

h3 { font-size: 24px; }

h4 { font-size: 20px; }

h5 { font-size: 16px; }

p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }

.container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; }

.container table { width: 100% !important; border-collapse: collapse; }

.container .masthead { padding: 80px 0; color: white; }

.container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }

.container .content { background: white; padding: 30px 35px; }

.container .content.footer { background: none; }

.container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }

.container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }

.container .content.footer a:hover { text-decoration: underline; }    
</style>    

<table class='body-wrap'>
    <tr>
        <td class='container'>

            <table>
                <tr>
                    <td class='content'>
                    <img src='cid:image1' >

                        <h2 style='color: green'> Excursion Valide,</h2>

                        <p> Votre excursion du <span>$Date</span> à <span>$Lieu </span>est préte et demare dans 72 heures!
                        il y a actuellement <span>$NbGens</span> personnes dans le groupe <br> parmi eux, <span>$guide</span> votre guide. <br>
                        La randonnée a une difficulté de <span>$difficult</span>, elle commence le $Date à $Lieu et fini le $Date2 à $Lieu2<br> n'oubliez pas de prendre <span>$Materiel</span>. <br>
                        Si vous avez besoin de plus d informations, <br> veuillez consulter la page de la randonnée sur notre site web.</p>
                        <table>
                            <tr>
                            <td class='button'>
                                <a  class='link' href='http://randoaddict/PHP/Accueil.php' target='_blank'>
                                Votre Excursion             
                                </a>
                            </td>
                            </tr>
                        </table>

                        <p>Par ailleurs, si vous voulez vous inscrire à d'autres randonnées, n'hésitez pas à venir voir notre site <a href='http://randoaddict/PHP/Accueil.php'>Randoaddict</a>.</p>

                        <p><em>– l'équipe de Randoaddict</em></p>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td class='container'>

            <table>
                <tr>
                    <td class='content footer' align='center'>
                        <center><p> <a href='#'>Se desabonner</a></p></center>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
\r\n"; 
    }
    
    else if ($etat == 2){
        echo('2');
       $msg .= "
    <html>
    <html>

    <body>
    <style>
    
    * { margin: 0; padding: 0; font-size: 100%; font-family: 'Avenir Next', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; line-height:   1.65; }

    img { max-width: 100%; margin: 0 auto; display: block; }
    
    body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }
    
    a { color: #71bc37; text-decoration: none; }
    
    a:hover { text-decoration: underline; }
    
    .text-center { text-align: center; }
    
    .text-right { text-align: right; }
    
.text-  left { text-align: left; }

.button { display: inline-block; color: white; background: #71bc37; border: solid #71bc37; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }

.button:hover { text-decoration: none; }

h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }

h1 { font-size: 32px; }

h2 { font-size: 28px; }

h3 { font-size: 24px; }

h4 { font-size: 20px; }

h5 { font-size: 16px; }

p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }

.container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; }

.container table { width: 100% !important; border-collapse: collapse; }

.container .masthead { padding: 80px 0; color: white; }

.container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }

.container .content { background: white; padding: 30px 35px; }

.container .content.footer { background: none; }

.container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }

.container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }

.container .content.footer a:hover { text-decoration: underline; }    
</style>    

    <table class='body-wrap'>
    <tr>
        <td class='container'>

            <table>
                <tr>
                    <td class='content'>
                    <img src='cid:image1' >

                        <h2 style='color: red'> Excursion Annulée,</h2>

                        <p> Votre excursion du <span>$Date</span> à <span>$Lieu </span>est annulée !
                            Malheureusement, l'excursion ne pourra pas avoir lieu, <br> n'hésitez pas à consulter et à vous inscrire à nos nombreuses autres excursions. 
                        </p>
                        <table>
                            <tr>
                            <td class='button'>
                                <a  class='link' href='http://randoaddict/PHP/Accueil.php' target='_blank'>
                                randoaddict             
                                </a>
                            </td>
                            </tr>
                        </table>

                        <p><em>– l'équipe de Randoaddict</em></p>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td class='container'>

            <table>
                <tr>
                    <td class='content footer' align='center'>
                        <center><p> <a href='#'>Se desabonner</a></p></center>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    </table>
    </body>
    </html>
    \r\n"; 
    }


    //---------------------------------
    // 2nde partie du message
    // Le 1er fichier (inline)
    //---------------------------------
    $fichier = 'PaysageRandonnee_2.jpg'; //VariableASSETS/
    $fp      = fopen($fichier, "rb");
    $fichierattache = fread($fp, filesize($fichier));
    fclose($fp);
    $fichierattache = chunk_split(base64_encode($fichierattache));

    $msg .= "--$delimiteur\r\n";
    $msg .= "Content-Type: application/octet-stream; name=\"$fichier\"\r\n";
    $msg .= "Content-Transfer-Encoding: base64\r\n";
    $msg .= "Content-ID: <image1>\r\n"; //Content-ID du fichier joint qui correspond au cid appelé
    $msg .= "\r\n";
    $msg .= $fichierattache . "\r\n";
    $msg .= "\r\n\r\n";

    $destinataire = $mailClient;//'romain.schlotter@gmail.com';//'r.schlotter@ludus-academie.com'; //Variable
    $expediteur   = 'randoaddictludus@gmail.com'; //Constante
    $reponse      = $expediteur;
    $replyTo      = "Reply-to: no-reply\r\n".$entete;
    echo "Ce script envoie un mail au format HTML avec 1 image à $destinataire";
    mail($destinataire,
        $titre,
        $msg,
        $replyTo);
    echo "<br/>mail appelé";
    }
    $Date = "";// La date de départ
    $Date2 = "";// La date d'arriver
    $guide = "";//Le pseudo du guide
    $Lieu = "";//Le lieu d'arriver 
    $Lieu2 = "";//Le lieu de départ 
    $NbGens = "";//Le nombre de gens
    $difficult = "";///La difficultée de la rando
    $Materiel = "";//Le matériel nécessaire 
    $etat = "";// L'état de la rando :
                                //1 = La randonnée est ok
                                //2 = La randonnée est annulé
    $mailClient = "";//Le mail
    $titre = "";//Le titre du mail 
    //Test du sendMail
    sendMail($mailClient,$titre, $etat, $Date, $Date2, 
                 $guide, $Lieu,$Lieu2,$NbGens,$difficult,$Materiel);

    ?>