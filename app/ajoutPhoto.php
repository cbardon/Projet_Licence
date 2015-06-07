<?php
    require('Config.php');
    $nomModele = $_POST['nomModele'];
    
        if (isset($_FILES['photo']) && isset($_POST['largeur']) && isset($_POST['format1']) && isset($_POST['format2']) && isset($_POST['coef']))
        {
            $id =  $_POST['idModele'];
            
            $extensionP_upload = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
            $extensionsPhoto_valides = array( 'jpg' , 'png' );
            if (!in_array($extensionP_upload,$extensionsPhoto_valides))
            {
                header('Location: http://clementbardon.com/test/web/index.php/erreur/12');	 
            }
            else
            {
                
                    $sqlMaxId ="SELECT MAX(idPhoto) as max FROM photo";
                    $maxId = mysql_query($sqlMaxId) or die($sqlMaxId);
                    $row1 = mysql_fetch_array($maxId); 
                    //$sqlId = "SELECT idModele FROM modele where nomModele = ".$nomModele;
                    //$id = mysql_query($sqlId) or die($sqlId);
                    $idPhoto = $row1["max"] + 1;
                    mysql_free_result($maxId);
                    $query = "SELECT `nomModele` as name FROM modele where idModele = " . $id;
                	$result = mysql_query($query) or die($query);
                    $row = mysql_fetch_assoc($result);
                    $nom = $row['name'];
                    $myNewFolderPath = '../web/media/modele/photos/'.$nomModele;
                    
                    $myNewFolderPathBDD = "media/modele/photos/".$nomModele."/";
                    if(is_dir($myNewFolderPath)){
                    } else{
                        $oldumask = umask(0000);
                       mkdir($myNewFolderPath, 0777,true);
                       umask($oldumask);
                    }
                  
                    $largeur = $_POST['largeur'];
                    $Format = $_POST['format1']."X".$_POST['format2'];
                    $coef = $_POST['coef'];
                    $name = $_FILES['photo']['name'];
                	
                    $nomPhotoServeur = "../web/media/modele/photos/".$nomModele."/".$name;
                    $resultat = move_uploaded_file($_FILES['photo']['tmp_name'],$nomPhotoServeur);
                  
                    if ($resultat) 
                    {
                            $nomPhoto = $myNewFolderPathBDD.$name;
                          //  $nomTexte = $myNewFolderPathBDD.$nom."_".$idPhoto.".txt";
                     	$sqlInsertion = "INSERT INTO photo VALUES ('$idPhoto','$id', '$nomPhoto', '$largeur','$Format','$coef','0')";
                            mysql_query($sqlInsertion) or die($sqlInsertion);
                            header('Location: http://clementbardon.com/test/web/index.php/ajoutPhoto/'.$id);
                    }
                        else
                        {
                            header('Location: http://clementbardon.com/test/web/index.php/erreur/7');
                        }
                
                	//$result = mysql_query($sqlInsertion) or die($sqlInsertion);
                   
            }
                
                
        }
        
        else
    	{
    		header('Location: http://clementbardon.com/test/web/index.php/erreur/1');	 
    	}
?>