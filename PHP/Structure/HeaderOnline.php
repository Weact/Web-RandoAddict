<?php
    include_once('../HTML/Structure/HeaderOnline.html');
        echo '<script type="text/javascript">
                document.getElementById("session_username").innerHTML = "'.$_SESSION['nomUtilisateur'].'";
    </script>';
?>
