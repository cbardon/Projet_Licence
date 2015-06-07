<?php
session_start();
$mail = $_SESSION['mail'];
$idModele = $_POST['idModele'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
		// D'abord, je me connecte à la base de données.
		mysql_connect("clementbardon.com.mysql", "clementbardon_c", "projetweb");
		mysql_select_db("clementbardon_c");
		 
       

       // $sql = "SELECT * FROM utilisateur WHERE id='".mysql_escape_string($id)."'";
    
        $sqlModele = "DELETE FROM `modele` WHERE `idModele` = ".$idModele;
        $sqlPhoto = "DELETE FROM `photo` WHERE `idModele` = ".$idModele;
        $sqlDonnee = "DELETE FROM `donnee` WHERE `idModele` = ".$idModele;
        
        // On vérifie si ce login existe
        $requete_Modele = mysql_query($sqlModele) or die ( mysql_error() );
          $requete_Photo = mysql_query($sqlPhoto) or die ( mysql_error() );
            $requete_Donnee = mysql_query($sqlDonnee) or die ( mysql_error() );
        if(mysql_num_rows($requete_Modele)==0)
        {
           header('Location: http://clementbardon.com/test/web/index.php/erreur/1');
        }
        else
        {	 
            $sqlCommentaire = "SELECT * FROM commentaire WHERE idModele = ".$idModele;
            
             $requete_Commentaire = mysql_query($sqlCommentaire) or die ( mysql_error() );

        if(mysql_num_rows($requete_Commentaire)==0)
        {
         require('mailValidation.php'); // On réclame le fichier
           header('Location: http://clementbardon.com/test/web/index.php/');
        }
        else
        {
    $sqlSupprComment = "DELETE FROM `commentaire` WHERE `idModele` = ".$idModele;
           $requete_SupprComment = mysql_query($sqlSupprComment) or die ( mysql_error() );
           require('mailValidation.php'); // On réclame le fichier
            header('Location: http://clementbardon.com/test/web/index.php/');
        }
        }

?>
