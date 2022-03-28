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
    $msg .= "<html><body>";
    //$msg .= "<h1>Email HTML avec 1 image</h1>"; //Corps du mail
    $msg .= "<div>".$texte."</div>";
    $msg .= "<img src=\"cid:image1\"><br/>"; //L'id cid: correspond au Content-ID du fichier joint.
    $msg .= "</html>\r\n";

    //---------------------------------
    // 2nde partie du message
    // Le 1er fichier (inline)
    //---------------------------------
    $fichier = './ASSETS/penguin.jpg'; //Variable
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
//sendMail("romain.schlotter@gmail.com","Le Titre !","Le message");

?>