<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("includes/start.php");

echo'<div class="container">';
if ($id == 0 ){
    echo 'Vous êtes déjà déconnecté, <a href="./index.php">veuillez vous connecter !</a></div></body></html>';

}else{
echo '<p>Vous êtes à présent déconnecté <br />
                    
Cliquez <a href="./index.php">ici</a> pour revenir à la page principale</p>

<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "dashboard.php";

    }, 2000);                
</script>
                    
                    ';
echo '</div></body></html>';
}


?>
<!--
Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a>
pour revenir à la page précédente.<br />-->
