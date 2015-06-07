<?php
    require('Config.php');
    
  //////////////////////////////////////////////////// on verifie que le champs ne soit pas vide ///////////////////////////////// 
  
    if (isset($_FILES['donnee']))
    {
        $id =  $_POST['idDonnee'];
        $extensionM_upload = strtolower(  substr(  strrchr($_FILES['donnee']['name'], '.')  ,1)  );
        if ( $extensionM_upload != 'xml')
        {
            header('Location: http://clementbardon.com/test/web/index.php/erreur/13');	 
        }
        else
        {
            
  //////////////////////////////////////////////////// on recupere le nom du modele /////////////////////////////////////       
  
            $query = "SELECT nomModele FROM modele where idModele = " . $id;
        	$result = mysql_query($query) or die(mysql_error());
        	$nom='';
        	while($row = mysql_fetch_assoc($result))
            {
                $nom = $row['nomModele'];
                break;
            }
            
 //////////////////////////////////////////////////// on insere la donnée sur le serveur  //////////////////////////////////// 
 
            $nomXMLBDD = "media/modele/donnees/".$nom.".xml";
             $nomXMLServeur = "../web/media/modele/donnees/".$nom.".xml";
            $resultat = move_uploaded_file($_FILES['donnee']['tmp_name'],$nomXMLServeur);
            if (!$resultat)
            {
                header('Location: http://clementbardon.com/test/web/index.php/erreur/7');
            }
            else
            {
                
    //////////////////////////////////////////////////// on rajoute la donnée dans la BDD  /////////////////////////////////               
                mysql_query("INSERT INTO donnee VALUES('','$id', '$nomXMLBDD')");
                header('Location: http://clementbardon.com/test/web/index.php/ajoutPhoto/'.$id);
            }
        }
    }
    else
	{
		header('Location: http://clementbardon.com/test/web/index.php/erreur/1');	 
	}
?>