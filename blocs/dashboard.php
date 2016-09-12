 <?php
 if(isset($pseudo)){
 

    echo'
    <div class="big container">';
    if ($id == 0){
        $tab_alerte['error'] = "Vous n'avez pas les droits" ;
        include 'blocs/erreur.php';
    }else{
        echo '<h1>Bienvenue <b>'.$_SESSION['pseudo'].'</b></h1>
        <hr>
        <p>Vous pourrez gérer ici vos horaires et autres textes de votre site.</p>';
        // On récupère les posts existants
       
        $row = db_select('SELECT * FROM posts');
        
        echo '<h2>Les entrées existantes</h2>
                <small>Modifiez les entrées en cliquant dessus</small>
                        <table class="entrees">
                                <tr>
                                    <th width="30">N°</th>
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Valider</th>
                                </tr>';
        foreach($row as $rows){
            $date = new DateTime();
            $date->setTimestamp($rows['date_creation']);
            echo '
                                <tr>
                                    <form action="admin.php?action=update&panel=edit-posts" method="post">
                                    <td width="30"><input name="id" class="input-table" value="'.$rows['id'].'"></td>
                                    <td><input name="updatetitle" class="input-table" value="'.$rows['title'].'"></td>
                                    <td><input name="updatedesc" class="input-table" value="'.$rows['description'].'"></td>
                                    <td><input name="updatecode" class="input-table" value="'.$rows['code'].'"></td>
                                    <td><input class="input-table" value="'.$date->format('Y-m-d H:i:s').'"></td>
                                    <td><button type="submit"/>Modifier</td>
                                    </form>
                                </tr>';
        }
        echo '</table>
                    <br>';
        // AJOUT D'UNE NOUVELLE ENTREE
        echo '<h2>Création d\'une nouvelle entrée</h2>
        
        <form action="admin.php?action=insert&panel=edit-posts" method="post">
            <input type="text" name="title" placeholder="Title"><br>
            <input type="text" name="desc" placeholder="Contenu"><br>
            <input hidden value="'.time().'" name="date"><br>
            <input type="submit" value="Ajouter l\'entrée">
        </form>
        
        
        
        </div></body></html>';
        
    }
    
}
?>