<?php
//Cette fonction doit être appelée avant tout code html
session_start();

//On donne ensuite un titre à la page, puis on appelle notre fichier start.php
$titre = "Panneau d'administration ";
include("includes/config.php");
include("includes/start.php");

// Container blanc dans lequel se trouve le formulaire
echo'<div class="container">';
if ($id!=0){
//    erreur(ERR_IS_CO);
//    Si on est connecté, redirection vers dashboard
    echo'<script>window.location.href = "dashboard.php";</script>';
}



if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{

    $req = $db->prepare('SELECT * FROM posts');

    $req->execute();

    $row = $req->fetchAll();

    echo '
    <h1>Site .fr</h1>
    <form method="post" action="index.php">
	<p class="connect">
	<label for="pseudo"></label><input autofocus placeholder="pseudo" name="pseudo" type="text" id="pseudo" /><br />
	<label for="password"></label><input placeholder="mot de passe" type="password" name="password" id="password" />

	</p>
	<p class="connect-submit"><input type="submit" value="Connexion" /></p>
	</form>
	<a href="./register.php">Pas encore inscrit ?</a>
	 
	</div>
	
	
	<div class="container">';

    foreach($row as $rows){
        if($rows['code'] == 'WEL16'){
            echo '<h2>'.$rows['title'].'</h2><p class="align-left">'.$rows['description'].'</p>';
        }
    }
	echo'
	</div>
	
	<div class="container">';
    echo '<small class="align-left">Dernier message</small>';

    $last_post = end($row);

            echo '<h2>'.$last_post['title'].'</h2><p class="align-left">'.$last_post['description'].'</p>';

	echo'
	</div>
	
	</div>
	</body>
	</html>';
}

else
{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./index.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$db->prepare('SELECT id, useradmin, password FROM users WHERE useradmin = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
        if ($data['password'] == md5($_POST['password'])) // Acces OK !
        {
            $_SESSION['pseudo'] = $data['useradmin'];
            $_SESSION['id'] = $data['id'];
            $message = 'Bienvenue '.$data['useradmin'].', vous êtes maintenant connecté.</p>
			<p>Vous allez être redirigé vers la page d\'administration !</p>
			<img src=http://i.giphy.com/41KuZ0xnx7Bde.gif" height="50">';
            echo'<script>
                    window.setTimeout(function(){
                    
                            // Move to a new location or you can do something else
                            window.location.href = "dashboard.php";
                    
                        }, 2000);                
                    </script>';


        }
        else // Acces pas OK !
        {
            $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correcte.</p><p>Cliquez <a href="./index.php">ici</a> 
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="./index.php">ici</a> 
	    pour revenir à la page d accueil</p>';
        }
        $query->CloseCursor();
    }

    echo $message.'</div></body></html>';
    header("Location:dashboard.php");
    exit;
}



?>
