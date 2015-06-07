<?php
    require('Config.php');
//////////////////////////////////////////////////////////// on verifie si rien n'est vide /////////////////////////////////////////

	if(!empty($_POST['nomModele']) && !empty($_POST['dateModele']) && isset($_FILES['modeleFile']) && isset($_FILES['modeleTexture']) &&!empty($_FILES['parametreFile']))
	{
	    if(detecteCar($_POST['nomModele']))
        {
            header('Location: http://clementbardon.com/test/web/index.php/erreur/9');
        }
	    else
	    {
    	    $nomModele = $_POST['nomModele'];
    	    //vérification du fichier
    	    if ($_FILES['modeleFile']['error'] > 0 || $_FILES['modeleTexture']['error'] > 0) 
    	    {
    	        header('Location: http://clementbardon.com/test/web/index.php/erreur/7');
    	    }
    	    else
    	    {
  //////////////////////////////////////////////////// on verifie si le nom n'est pas deja pris ////////////////////////////
  
        		$sqlTestNom = "SELECT COUNT(*) FROM modele WHERE nomModele like '".mysql_escape_string($nomModele)."'";
                // $sql = 'SELECT COUNT(*) FROM table_utilisateurs WHERE pseudo_utilisateur="'.$_POST['pseudo_formulaire'].'" ';
                $requete_TestNom = mysql_query($sqlTestNom) or die(mysql_error() );
                $exist = mysql_result($requete_TestNom, 0);
                if ($exist != '0') 
                {
                    header('Location: http://clementbardon.com/test/web/index.php/erreur/10');
                }
                else
                {
        	        //1. strrchr renvoie l'extension avec le point (« . »).
                    //2. substr(chaine,1) ignore le premier caractère de chaine.
                    //3. strtolower met l'extension en minuscules.
                    $extensionM_upload = strtolower(  substr(  strrchr($_FILES['modeleFile']['name'], '.')  ,1)  );
                    if ( $extensionM_upload != 'obj')
                    {
                        header('Location: http://clementbardon.com/test/web/index.php/erreur/8');
                    }
                    else
                    {
                        $extensionT_upload = strtolower(  substr(  strrchr($_FILES['modeleTexture']['name'], '.')  ,1)  );
                        $extensionsText_valides = array( 'jpg' , 'png' );
                        if (!in_array($extensionT_upload,$extensionsText_valides))
                        {
                            header('Location: http://clementbardon.com/test/web/index.php/erreur/12');
                        }
                        else
                        {
                             $extensionParametre_upload = strtolower(  substr(  strrchr($_FILES['parametreFile']['name'], '.')  ,1)  );
                             if ( $extensionParametre_upload != 'txt')
                            {
                                header('Location: http://clementbardon.com/test/web/index.php/erreur/14');
                            }
                            else
                            {
 //////////////////////////////////////////////////// on rajoute le modèle sur le serveur /////////////////////////////////
 
                            $nomMServeur = "../web/media/modele/modeles/{$_POST['nomModele']}.obj";
                            $nomMBDD = "media/modele/modeles/{$_POST['nomModele']}.obj";
                            $resultat = move_uploaded_file($_FILES['modeleFile']['tmp_name'],$nomMServeur);
                            if (!$resultat)
                            {
                                header('Location: http://clementbardon.com/test/web/index.php/erreur/7');
                            }
                            else
                            {
  //////////////////////////////////////////////////// on rajoute la texture sur le serveur /////////////////////////////////                               
                                $nomTServeur = "../web/media/modele/modeles/{$_POST['nomModele']}.{$extensionT_upload}";
                                 $nomTBDD = "media/modele/modeles/{$_POST['nomModele']}.{$extensionT_upload}";
                                $resultat = move_uploaded_file($_FILES['modeleTexture']['tmp_name'],$nomTServeur);
                                if (!$resultat)
                                {
                                    header('Location: http://clementbardon.com/test/web/index.php/erreur/7');
                                }
                                    else
                                    { 
  //////////////////////////////////////////////////// on rajoute le parametre sur le serveur /////////////////////////////////                                         
                                    $nomParametreServeur = "../web/media/modele/parametres/{$_POST['nomModele']}.{$extensionParametre_upload}";
                                    $nomParametreBDD = "media/modele/parametres/{$_POST['nomModele']}.{$extensionParametre_upload}";
                                    $resultat = move_uploaded_file($_FILES['parametreFile']['tmp_name'],$nomParametreServeur);
                                     
                                    }
                                        if (!$resultat)
                                    {
                                        header('Location: ../../web/index.php/erreur/7');
                                  
                                    }
                            		else
                            		{
                            		$idUtilisateur = $_POST['id'];
                            		$nomModele = $_POST['nomModele'];
                            	    $date = $_POST['dateModele'];
                            	    $type = $_POST['typeModele'];
                            	    $description = $_POST['description'];
                            		$latitude = null;
                            		$longitude = null;
                                		if (!empty($_POST['lat']) && !empty($_POST['lon']))
                                		{
                                			$latitude = $_POST['lat'];	
                                			$longitude = $_POST['lon'];
                                		}
                                		
   ///////////////////////// on crée la requete SQL pour l'insertion d'un nouveau modele dans la BDD ///////////////////////////////                                    
                            		mysql_query("INSERT INTO modele VALUES('','$nomModele', '$nomMBDD', '$nomTBDD', '$nomParametreBDD', '$latitude', '$longitude', 1, '$idUtilisateur','$date','$type','$description')")  or die('Erreur SQL !<br />'.$description.'<br />'.mysql_error());
                            		$selectID = "SELECT idModele FROM modele where nomModele = '" . $nomModele . "' limit 1";
                                    $retourSelect = mysql_query($selectID);
                                    $data = mysql_fetch_array($retourSelect);
                                    $idDuModele = $data['idModele'];
                            		header('Location: http://clementbardon.com/test/web/index.php/ajoutPhoto/' . $idDuModele);
                                    }
                            }
                        }
                	}
                }
    	    }
	    }
	   
    }
 

	}
	else
	{
	    header('Location: http://clementbardon.com/test/web/index.php/erreur/1');
	}
	
  ////////////////////////////////////////////////////fonction qui specifie les caractères interdits ///////////////////////////////// 
	function detecteCar($chaine)
	{
	    $caracNonValides = array('/','.','\\','<','>',':','"',' ');
	    $length = strlen($chaine);
	    $i = 0;
	    
	    while($i<$length)
	    {
	        if(in_array($chaine[$i],$caracNonValides))
	        {
	            return true;
	        }
	        $i++;
	    }
	    return false;
	}