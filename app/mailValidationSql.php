<?php
session_start();

$idModele = $_GET['idModele'];
		// D'abord, je me connecte à la base de données.
		mysql_connect("clementbardon.com.mysql", "clementbardon_c", "projetweb");
		mysql_select_db("clementbardon_c");
		 
       

       // $sql = "SELECT * FROM utilisateur WHERE id='".mysql_escape_string($id)."'";
    
        $sql = "UPDATE modele SET enAttente ='0' WHERE idModele = " .$idModele;
        // On vérifie si ce login existe
        $requete_1 = mysql_query($sql) or die ( mysql_error() );

        if(mysql_num_rows($requete_1)==0)
        {
           header('Location: http://clementbardon.com/test/web/index.php/erreur/1');
        }
        else
        {	 
       require('mailValidation.php'); // On réclame le fichier
         header('Location: http://clementbardon.com/test/web/index.php/');
       
}
?>