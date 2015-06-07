<?php

    require('Config.php');
///////////////////////////////////////////////// on verifie que tout les champs soit remplies ////////////////////////////////////
	if(!empty($_GET['mail']) && !empty($_GET['nom']) && !empty($_GET['prenom']) && !empty($_GET['passe']))
	{
		$mail = $_GET['mail'];
		// Je mets aussi certaines sécurités ici…
		$passe = mysql_real_escape_string(htmlspecialchars($_GET['passe']));
		$passe2 = mysql_real_escape_string(htmlspecialchars($_GET['passe2']));
		if($passe == $passe2)
		{
			$mail = mysql_real_escape_string(htmlspecialchars($_GET['mail']));
			$nom = mysql_real_escape_string(htmlspecialchars($_GET['nom']));
			$prenom = mysql_real_escape_string(htmlspecialchars($_GET['prenom']));
			
///////////////////////////////////////////////// on crypte le mot de passe ////////////////////////////////////////////

			$passe = sha1($passe);

            $prof = $_GET['prof'];
            $lieu = $_GET['lieu'];

///////////////////////////////////////////////// on ajoute toutes les données dans la BDD ////////////////////////////////////

			mysql_query("INSERT INTO utilisateur VALUES('','$nom','$prenom','$mail','$passe','','',0,'$prof','$lieu')");
			header('Location: http://clementbardon.com/test/web/index.php/');
			
///////////////////////////////////////////////// on envoi un mail de confirmation ////////////////////////////////////////

			require('mail.php'); // On réclame le fichier
		}
		else
		{
			header('Location: http://clementbardon.com/test/web/index.php/erreur/2');
		}
	}
	else
	{
		header('Location: http://clementbardon.com/test/web/index.php/erreur/1');	 
	}
?>