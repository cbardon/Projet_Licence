<?php

        $idModele = $_GET['idModele'];

   
        mysql_connect("clementbardon.com.mysql", "clementbardon_c", "projetweb");
	    mysql_select_db("clementbardon_c");
		
		//////////////////////////////// Partie MODELE ///////////////////////////////////////
		
        $sql = "SELECT nomModele FROM modele WHERE idModele = '".$idModele."'";
        $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $data = mysql_fetch_array($req);
       // mysql_free_result ($req);
         if(mysql_num_rows($req)!=0)
        {
        $sqlCHeminModele = "SELECT cheminM FROM modele WHERE idModele = '".$idModele."'";
        $reqCHeminModele = mysql_query($sqlCHeminModele) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $dataCHeminModele = mysql_fetch_array($reqCHeminModele);
        mysql_free_result ($reqCHeminModele);
        
        $sqlCHeminTexture = "SELECT cheminT FROM modele WHERE idModele = '".$idModele."'";
        $reqCheminTexture = mysql_query($sqlCHeminTexture) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $dataCheminTexture = mysql_fetch_array($reqCheminTexture);
        mysql_free_result ($reqCheminTexture);
        
        $nomModele = $data['nomModele']; 
        $cheminTexture = $dataCheminTexture['cheminT'];
        $CheminModele =  $dataCHeminModele['cheminM']; 
        $efface_Modele = unlink ("../web/".$CheminModele);
        $efface_Modele = unlink ("../web/".$cheminTexture);
        
        $sqlModele = "DELETE FROM `modele` WHERE idModele = '".$idModele."'";
        $reqModele = mysql_query($sqlModele) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        
        //////////////////////////////// Partie PHOTOS ///////////////////////////////////////
        
        $sqlnbPhoto = "SELECT * FROM photo WHERE idModele = '".$idModele."'";
        $reqnbPhoto = mysql_query($sqlnbPhoto) or die('Erreur SQL !<br />'.$sqlnbPhoto.'<br />'.mysql_error());
        
         if(mysql_num_rows($reqnbPhoto)!=0)
        {
                $cheminPhotoSupp = "../web/media/modele/photos/".$nomModele;
                rmdir_recursive($cheminPhotoSupp);
                $sqlPhoto = "DELETE FROM `photo` WHERE idModele = '".$idModele."'";
                $requete_Photo = mysql_query($sqlPhoto) or die ( mysql_error() );
        }
        
        //////////////////////////////// Partie DONNEES ///////////////////////////////////////
         
        $sqlCheminDonnee = "SELECT cheminD FROM donnee WHERE idModele = '".$idModele."'";
        $reqCheminDonnee = mysql_query($sqlCheminDonnee) or die('Erreur SQL !<br />'.$sqlCheminDonnee.'<br />'.mysql_error());
        $dataCheminDonnee = mysql_fetch_array($reqCheminDonnee);
        
         if(mysql_num_rows($reqCheminDonnee)!=0)
        {
            $efface_Donnee = unlink ("../web/".$dataCheminDonnee['cheminD']);
            $sqlDonnee = "DELETE FROM `donnee` WHERE idModele = '".$idModele."'";
            $requete_Donnee = mysql_query($sqlDonnee) or die ( mysql_error() );
        }
      
       
        //////////////////////////////// Partie COMMENTAIRES ///////////////////////////////////////
      
        $sqlCommentaire = "SELECT * FROM commentaire WHERE idModele like ".$idModele;
        $requete_Commentaire = mysql_query($sqlCommentaire) or die ( mysql_error() );

        if(mysql_num_rows($requete_Commentaire)==0)
        {
           header('Location: http://clementbardon.com/test/web/index.php/');
        }
        else
        {
            $sqlSupprComment = "DELETE FROM `commentaire` WHERE idModele like ".$idModele;
            $requete_SupprComment = mysql_query($sqlSupprComment) or die ( mysql_error() );
            header('Location: http://clementbardon.com/test/web/index.php/');
        }
        }
        else
        {
            header("http://clementbardon.com/test/web/index.php/erreur/-1");
        }
        
             function rmdir_recursive($dir)
{
 //Liste le contenu du répertoire dans un tableau
 $dir_content = scandir($dir);
 //Est-ce bien un répertoire?
 if($dir_content !== FALSE){
  //Pour chaque entrée du répertoire
  foreach ($dir_content as $entry)
  {
   //Raccourcis symboliques sous Unix, on passe
   if(!in_array($entry, array('.','..'))){
    //On retrouve le chemin par rapport au début
    $entry = $dir . '/' . $entry;
    //Cette entrée n'est pas un dossier: on l'efface
    if(!is_dir($entry)){
     unlink($entry);
    }
    //Cette entrée est un dossier, on recommence sur ce dossier
    else{
     rmdir_recursive($entry);
    }
   }
  }
 }
 //On a bien effacé toutes les entrées du dossier, on peut à présent l'effacer
 rmdir($dir);
}
?>