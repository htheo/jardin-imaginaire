<nav class="menu">
    <ul>
        
        <?php

        echo '<a href="home"><li>Accueil</li></a>';
        echo '<a href="galerie"><li>Galerie</li></a>';
        echo '<a href="devis"><li>Devis</li></a>';
        if (isset($pseudo)) {
            echo '<a href="admin.php"><li>Espace admin</li></a>';
            echo '<a href="?logout=true"><li>Déconnexion</li></a>';
        }else{
        }
        ?>      
        
    </ul>
</nav>