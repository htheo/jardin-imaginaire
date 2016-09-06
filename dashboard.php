<?php
//Cette fonction doit être appelée avant tout code html
session_start();

//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
$titre = "Panneau d'administration ";
include("includes/config.php");
include("includes/start.php");


echo'
<div class="big container">';
if ($id == 0){


    echo '<p>Vous n\'êtes pas connecté !</p><script>                            
    window.location.href = "index.php";
    </script>';
}else{


    echo '<h1>Bienvenue <b>'.$_SESSION['pseudo'].'</b></h1>
    <hr>
    <p>Vous pourrez gérer ici vos horaires et autres textes de votre site.</p>';

    // On récupère les posts existants

    $req = $db->prepare('SELECT * FROM posts');

    $req->execute();

    $row = $req->fetchAll();


    // UPDATE POSTS

    if(isset($_POST['updatetitle']))

///*$req = $bdd->prepare('UPDATE jeux_video SET prix = :nvprix, nbre_joueurs_max = :nv_nb_joueurs WHERE nom = :nom_jeu');
//$req->execute(array(
//    'nvprix' => $nvprix,
//    'nv_nb_joueurs' => $nv_nb_joueurs,
//    'nom_jeu' => $nom_jeu
//));*/



    echo '<h2>Les entrées existantes</h2>
            <small>Modifiez les entrées en cliquant dessus</small>
    <table class="entrees">
            <tr>
                <th width="30">N°</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date</th>
            </tr>
            
            <form>';
    foreach($row as $rows){
        echo '
            <tr>
                <td width="30"><input class="input-table" value="'.$rows['id'].'"></td>
                <td><input name="updatetitle" class="input-table" value="'.$rows['title'].'"></td>
                <td><input class="input-table" value="'.$rows['description'].'"></td>
                <td><input class="input-table" value="'.$rows['date_creation'].'"></td>
            </tr>
';

    }

    echo '</form></table><br>';




    // AJOUT D'UNE NOUVELLE ENTREE


    echo '<h2>Création d\'une nouvelle entrée</h2>
    
    <form action="dashboard.php" method="post">
        <input type="text" name="title" placeholder="Title"><br>
        <input type="text" name="desc" placeholder="Contenu"><br>
        <input hidden value="'.time().'" name="date"><br>
        <input type="submit" value="Ajouter l\'entrée">
    </form>
    
    
    
    </div></body></html>';


    if(isset($_POST['title']) AND isset($_POST['desc'])){

        $title=$_POST['title'];
        $desc=$_POST['desc'];
        $date=$_POST['date'];


        $query=$db->prepare('INSERT INTO posts (title, description, date_creation) VALUES (:title, :desc, :date)');
//        $query->bindValue(':title', $title, PDO::PARAM_STR);
//        $query->bindValue(':desc', $desc, PDO::PARAM_STR);
//        $query->bindValue(':date', $date, PDO::PARAM_STR);
        if($query->execute(array(
            'title' => $title,
            'desc' => $desc,
            'date' => $date
        )))
        {
            echo 'Validé ! <script>  window.location.href = "index.php";</script> <a href="index.php">Cliquez-ici pour valider</a>';


        }else{

            echo 'Erreur <script>  window.location.href = "index.php";</script>';


        };



    }else{

    $title = NULL;
    $desc = NULL;
    $date = NULL;

}
}
?>
