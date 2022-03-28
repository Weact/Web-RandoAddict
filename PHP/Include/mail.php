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

function sendMail($mailClient, $titre, $texte)
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

    $msg .= "<html>
        <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <title>Email</title>
        <style>
    
            body {
            font-family: sans-serif;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%; 
            }
    
            table {
            border-collapse: separate;
            width: 100%; }
            table td {
                font-family: sans-serif;
                font-size: 14px;
                vertical-align: top; 
            }
    
            .body {
            width: 100%; 
            }
            .container {
            display: block;
            margin: 0 auto !important;
            max-width: 580px;
            padding: 10px;
            width: 580px; 
            }
            .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px; 
            }
    
            .main {
            border-radius: 3px;
            width: 100%; 
            }
    
            .wrapper {
            box-sizing: border-box;
            padding: 20px; 
            }
    
            .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
            }
    
            .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%; 
            }
            .footer td,
            .footer p,
            .footer span,
            .footer  {
                
                font-size: 15px;
                text-align: center; 
            }
    
            h1,
            {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px; 
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize; 
            }
    
            p,
            ul,
            ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px; 
            }
            p li,
            ul li,
            ol li {
                list-style-position: inside;
                margin-left: 5px; 
            }
    
    
        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            font-size: 16px;
            margin-left: 28%;
        }
    
    
        </style>
        </head>
        <body>
        <img style='z-index: -1; position: absolute' src='\"cid:image1\"' >
        <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
    
            <tr>
            <td>&nbsp;</td>
            <td class='container'>
                <div class='content'>
                <table role='presentation' class='main'>
                    <tr style='background: rgba(215,215,215,0.8);  ' >
                    <td class='wrapper'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                            <td>
                            <h1><span style='color: blue' >RANDO</span><span style='color: green'>ADDICT</span></h1>
                            <p>Bonjour,</p>
                            <p> <span style='color: green;'>Bonne nouvelle :<br> </span> Votre excursion du <span>[Date]</span>  à <span>[Lieu] </span>est complète et a un guide <span>[Nom du guide]</span>  ! <br> Vous trouverez ci-dessous un résumé de la randonnée </p>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                <tbody>
                                <tr>
                                    <td align='left'>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                        <tbody>
                                        <tr>
                                    
                                            <h4>[NOM DE LA RANDO]</h4>
                                        </tr>
                                        <tr>
                                            <div style='display: flex;
                                                        justify-content : center; margin-bottom: 30px '>
                                                <iframe src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin=Pl.+des+Halles,+67000+Strasbourg&destination=KFC+Homme+de+fer&mode=walking' width='500' height='450' style='border:0;' allowfullscreen='' loading='lazy'></iframe>
    
                                            </div>                                    
                                            </tr>
                                        <tr>
                                            <td>
                                                <p>
                                                    La randonnée commence le <span>[Date]</span>  a <span>[Lieu] </span> il y a actuellement <span>[Nombre de personnes]</span> personnes dans le groupe, parmi eux, <span>[Nom du guide]</span> votre guide. 
                                                    La randonnée a une difficulté de <span>[Difficulté]</span>, n'oubliez pas de prendre <span>[Materiel]</span>. 
                                                    Si vous avez besoin de plus d'informations, veuillez consulter la page de la randonnée sur notre site web.</p>
                                                    <button type='button' class='btn btn-primary '> <a href='PageRandonee.html'> Page de la randonnée</a></button>
                                            </td>  
                                        </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
    
                </table>
    
                <div class='footer'>
                    <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td class='content-block' style='background: rgba(215,215,215,0.8);'>
                        <span class=''>© 2022 Rando Addict Ludus, Inc. All rights reserved.</span>
                        <br>Vous n'aimez pas ces courriels ? <a href='http://randoaddict/PHP/Accueil.php'>Se désabonner</a>.
                        </td>
                    </tr>
                    <tr>
    
                    </tr>
                    </table>
                </div>
    
                </div>
            </td>
            </tr>
        </table>
        </body>
    </html>\r\n";

    //---------------------------------
    // 2nde partie du message
    // Le 1er fichier (inline)
    //---------------------------------
    $fichier = './PaysageRandonnee_2.jpg'; //VariableASSETS/
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
}

//Test du sendMail
sendMail("romain.schlotter@gmail.com","Le Titre !","Le message");

?>