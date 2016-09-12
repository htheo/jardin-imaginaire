<nav class="menu">
    <ul>
        <li><a href="home.php">Accueil</a></li>
        <?php


        if (isset($_SESSION['pseudo'])) {
            echo '<li><a href="admin.php">Espace admin</a></li>';
            echo '<li><a href="?logout=true">Déconnexion</a></li>';
        }else{
            echo '<li><a href="connexion.php">Se connecter</a></li>';
        }
        ?>      
        
    </ul>
</nav>