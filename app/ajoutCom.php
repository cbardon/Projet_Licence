<?php
    
    if (isset($_GET['idU']) && isset($_GET['idModele']) &&  isset($_GET['msg'])  && !empty($_GET['idU']) && !empty($_GET['msg'])) {
    
        require('Config.php');
        $idModele = $_GET['idModele'];
        $idU = $_GET['idU'];
        $msg = $_GET['msg'];
        $visibilite = $_GET['visibilite'];
        $test = addslashes($msg);
        $requete = "INSERT INTO commentaire VALUES('',$idModele,'$idU','$test',NOW(),'$visibilite')";
        $result = mysql_query($requete) or die($requete);
        //echo "it's work !";
    }
    else{
       
         if(!empty($_GET['msg']))
        { 
            $id = $_GET['idModele'];
            echo "l'id du modele ici est : ".$id;
            $test= $_GET['idU'];
            echo " l'id de l'user :". $test;
            echo "      ";
            $visibilite = $_GET['visibilite'];
            echo " la visibilite :".$visibilite;
            echo "           ";
            echo"il manque le message  !";
        }
        if(!empty($_GET['visibilite']))
        {
           
            echo"il manque la visibilite  !";
        }
        
        //	echo"ça marche pas connard";
    }
?>