<?php
session_start();
$titre="Connexion";
include("start.php");
include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");
if ($id!=0) erreur(ERR_IS_CO);

if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{

    echo '
    <h1>Site coiffeurben.fr</h1>
    <form method="post" action="connect.php">
	<p class="connect">
	<label for="pseudo"></label><input placeholder="pseudo" name="pseudo" type="text" id="pseudo" /><br />
	<label for="password"></label><input placeholder="mot de passe" type="password" name="password" id="password" />
	</p>
	<p class="connect-submit"><input type="submit" value="Connexion" /></p>
	</form>
	<a href="./register.php">Pas encore inscrit ?</a>
	 
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
	<p>Cliquez <a href="./connect.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$db->prepare('SELECT membre_mdp, membre_id, membre_rang, membre_pseudo
        FROM forum_membres WHERE membre_pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
        if ($data['membre_mdp'] == md5($_POST['password'])) // Acces OK !
        {
            $_SESSION['pseudo'] = $data['membre_pseudo'];
            $_SESSION['level'] = $data['membre_rang'];
            $_SESSION['id'] = $data['membre_id'];
            $message = '<p>Bienvenue '.$data['membre_pseudo'].', 
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="./index.php">ici</a> 
			pour revenir à la page d accueil</p>';
        }
        else // Acces pas OK !
        {
            $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correcte.</p><p>Cliquez <a href="./connect.php">ici</a> 
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="./index.php">ici</a> 
	    pour revenir à la page d accueil</p>';
        }
        $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
?>