<?php
    session_start();
    
    if(!isset($_GET['login']) && !isset($_GET['motdepasse']))
    {
        header('Location: http://clementbardon.com/test/web/index.php/');
    }
    else
    {
        require('Config.php'); // On réclame le fichier

        $login = $_GET['login'];
        $motdepasse = $_GET['motdepasse'];

        $sql = "SELECT * FROM utilisateur WHERE mail='".mysql_escape_string($login)."'";
        
        
       
        
        // On vérifie si ce login existe
        $requete_1 = mysql_query($sql) or die ( mysql_error() );

        if(mysql_num_rows($requete_1)==0)
        {
           header('Location: http://clementbardon.com/test/web/index.php/erreur/1');
        }
        else
        {
            $motdepasse = sha1($motdepasse);
            // On vérifie si le login et le mot de passe correspondent au compte utilisateur
            $requete_2 = mysql_query($sql." AND password='".mysql_escape_string($motdepasse)."'")
or die ( mysql_error() );

            if(mysql_num_rows($requete_2)==0)
            {
                 header('Location: http://clementbardon.com/test/web/index.php/erreur/6');
                   
            }
            else
            {
                // On va récupérer les résultats
                $result = mysql_fetch_array($requete_2, MYSQL_ASSOC);

                $nbr_essai = 0;
                $update = "UPDATE utilisateur SET nbr_connect='".$nbr_essai."', dates=NOW()
WHERE idUtilisateur='".$result["idUtilisateur"]."'";

                mysql_query($update) or die ( mysql_error() );
                
            $sqlNom ="SELECT nom FROM utilisateur WHERE mail='".mysql_escape_string($login)."'";
            $sqlPrenom ="SELECT prenom FROM utilisateur WHERE mail='".mysql_escape_string($login)."'";
            $sqlId ="SELECT idUtilisateur FROM utilisateur WHERE mail='".mysql_escape_string($login)."'";
            $sqlMail ="SELECT mail FROM utilisateur WHERE mail='".mysql_escape_string($login)."'";
            $sqlAdmin ="SELECT admin FROM utilisateur WHERE mail='".mysql_escape_string($login)."'";
               
                $requete_sqlNom = mysql_query($sqlNom);
                $requete_sqlPrenom = mysql_query($sqlPrenom);
                $requete_sqId = mysql_query($sqlId);
                $requete_sqlMail = mysql_query($sqlMail);
                 $requete_sqlAdmin = mysql_query($sqlAdmin);
                
                $resultNom =  mysql_fetch_array($requete_sqlNom, MYSQL_ASSOC);
                $resultPrenom =  mysql_fetch_array($requete_sqlPrenom, MYSQL_ASSOC);
                $resultId =  mysql_fetch_array($requete_sqId, MYSQL_ASSOC);
                $resultMail =  mysql_fetch_array($requete_sqlMail, MYSQL_ASSOC);
                 $resultAdmin =  mysql_fetch_array($requete_sqlAdmin, MYSQL_ASSOC);
              
                $_SESSION['nom'] = $resultNom["nom"];
                $_SESSION['prenom'] = $resultPrenom["prenom"];
                $_SESSION['idUtilisateur'] = $resultId["idUtilisateur"];
                $_SESSION['mail'] = $resultMail["mail"];
                $_SESSION['admin'] = $resultAdmin["admin"];
                // On redirige vers la partie membre
                header('Location: http://clementbardon.com/test/web/index.php/');
            }
        }
    }

?>