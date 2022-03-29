<?php
    $pathname = '../HTML/Structure/HeaderAdmin.html';
    include_once($pathname);

    echo '<script type="text/javascript">
            document.getElementById("session_username").innerHTML = "'.$_SESSION['nomUtilisateur'].'";
</script>';
?>
