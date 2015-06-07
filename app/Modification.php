<?php
session_start();

///////////////////////////////////////////////// on se connecte a la BDD /////////////////////////////////////////

require('Config.php');
$mail = $_SESSION['mail'];

///////////////////////////////////////////////// on verifie que tout les champs soit remplies ////////////////////////////////////

	if(!empty($_GET['passe']) && !empty($_GET['newPasse']) && !empty($_GET['newPasse2']))
	{
        $motdepasse = $_GET['passe'];
        $id = $_SESSION['idUtilisateur'];
        $sql = "SELECT * FROM utilisateur WHERE idUtilisateur = " . $id;
        $requete_1 = mysql_query($sql) or die ( mysql_error() );
        
///////////////////////////////////////////////// on verifie que le login existe ///////////////////////////////////////////

        if(mysql_num_rows($requete_1)==0)
        {
           header('Location: http://clementbardon.com/test/web/index.php/erreur/4');
        }
        else
        {
 ///////////////////////////////////////////////// on crypte le mot de passe ////////////////////////////////////////
            
            $motdepasse = sha1($motdepasse);
            
/////////////////////////////// On vérifie si le login et le mot de passe correspondent au compte utilisateur ///////////////////////    

            $requete_2 = mysql_query($sql." AND password like '".mysql_escape_string($motdepasse)."'") or die ( mysql_error() );

            if(mysql_num_rows($requete_2)==0)
            {
                 header('Location: http://clementbardon.com/test/web/index.php/erreur/11');
            }
            else
            {
                $result = mysql_fetch_array($requete_2, MYSQL_ASSOC);
               	// Je mets aussi certaines sécurités ici…
        		$newPasse = sha1(mysql_real_escape_string(htmlspecialchars($_GET['newPasse'])));
        		$newPasse2 = sha1(mysql_real_escape_string(htmlspecialchars($_GET['newPasse2'])));
        		
 ///////////////////////////////  On verifie que les deux mots de passes correspondent ///////////////////////////////   
 
        		if($newPasse == $newPasse2)
        		{
 /////////////////////////////// On insere dans la BDD le nouveau mot de passe /////////////////////////////////////////////////////
 
        			$update = "UPDATE utilisateur SET password = '".$newPasse."'  WHERE idUtilisateur = " . $id;
        			mysql_query($update) or die ( mysql_error() );
        			header('Location: http://clementbardon.com/test/web/index.php/');
        		}
        		else
        		{
        			header('Location: http://clementbardon.com/test/web/index.php/erreur/6');
        		}
            }
        }
       
	}
    else
    {
        header('Location: http://clementbardon.com/test/web/index.php/erreur/1');
    }
?>