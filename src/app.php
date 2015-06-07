<?php

require('../app/Config.php');

$app->match('/', function () use ($app) {
    session_start();
    return $app['twig']->render('index.twig',
	array('title' => "PH3D",'img' => chercherPhotos(),
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
	'admin' => getAdminSession(),
	'id' => getIdSession(),
	'chemin' => ''));
})->bind('index');
 
 //redirection page Ajout.twig
$app->match('/ajout', function () use ($app) {
    session_start();
    if (session_status() == PHP_SESSION_NONE) {
		return $app->redirect('/test/web/index.php/authentification');
	}
    else if(!isset($_SESSION['idUtilisateur']))
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else if ($_SESSION['idUtilisateur'] == NULL)
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else
    {
        return $app['twig']->render('Ajout.twig',
    	array('title' => "Ajouter un modèle 3D",'action' => 'Ajouter',
    	'nom' => getNomSession(),
    	'prenom' => getPrenomSession(),
    	'idUtilisateur' => getIdSession(),
    	'id' => getIdSession(),
    	'admin' => getAdminSession(),
    	'types' => typeDropdown(),
	    'chemin' => '' ));
    }
})->bind('ajout');


 //redirection page Presentation.twig
$app->match('/presentation', function () use ($app) {
    session_start();
    return $app['twig']->render('Presentation.twig',
	array('title' => "Présentation des modèles 3D",
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'admin' => getAdminSession(),
	'modeles' => modeleDropdown("0"),
	'chemin' => ''));
})->bind('presentation');

//redirection page Inscription.twig
$app->match('/inscription', function () use ($app) {
    session_start();
    return $app['twig']->render('Inscription.twig',
	array('title' => "Inscription",
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
	'admin' => getAdminSession(),
	'id' => getIdSession(),
	'chemin' => ''));
})->bind('inscription');

 //redirection page documentation.twig
$app->match('/documentation', function () use ($app) {
    session_start();
    return $app['twig']->render('documentation.twig',
	array('title' => "Documentation",
	'nom' => getNomSession(),
	'admin' => getAdminSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'chemin' => ''));
})->bind('doc');

 //redirection page Authentification.twig
$app->match('/authentification', function () use ($app) {
    session_start();
    return $app['twig']->render('Authentification.twig',
	array('title' => "authentification",
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
	'admin' => getAdminSession(),
	'id' => getIdSession(),
	'chemin' => ''));
})->bind('authentification');

 //redirection page Contact.twig
$app->match('/contact', function () use ($app) {
    session_start();
    return $app['twig']->render('Contact.twig',
	array('title' => "contact",
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
	'admin' => getAdminSession(),
	'id' => getIdSession(),
	'chemin' => ''));
})->bind('contact');

//redirection page test.twig
$app->match('/test', function () use ($app) {
    session_start();
    return $app['twig']->render('test.twig',
	array('title' => "test",
	'nom' => getNomSession(),
	'admin' => getAdminSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'chemin' => ''));
})->bind('test');

//redirection page administration.twig
$app->match('/admin', function () use ($app) {
    session_start();
    if (session_status() == PHP_SESSION_NONE) {
		return $app->redirect('/test/web/index.php/authentification');
	}
    else if(!isset($_SESSION['idUtilisateur']))
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else if ($_SESSION['idUtilisateur'] == NULL)
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else
    {
        return $app['twig']->render('administration.twig',
    	array('title' => "Administration",
    	'nom' => getNomSession(),
    	'prenom' => getPrenomSession(),
    	'admin' => getAdminSession(),
    	'id' => getIdSession(),
        'modeles' => modeleDropdown("1"),
        'modeles2' => modeleDropdown("0"),
	    'chemin' => ''));
    }
})->bind('admin');

//redirection page adminValid.twig
$app->match('/adminValid/{idModele}', function ($idModele) use ($app) {
    session_start();
    if (session_status() == PHP_SESSION_NONE) {
		return $app->redirect('/test/web/index.php/authentification');
	}
    else if(!isset($_SESSION['idUtilisateur']))
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else if ($_SESSION['idUtilisateur'] == NULL)
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else
    {
        return $app['twig']->render('adminValid.twig',
        array('title' => "Validation",
        'nom' => getNomSession(),
    	'prenom' => getPrenomSession(),
    	'id' => getIdSession(),
    	'admin' => getAdminSession(),
    	'coms' => getComs($idModele),
    	'infos' => getInfo($idModele),
	    'photos' => getPhotoAndText($idModele),
    	'chemin' => '../'));
    }
  
})->bind('adminValid');

//redirection page validModele pour exécuter la fonction valider($idModele)
$app->match('/validModele/{idModele}', function ($idModele) use ($app) {
    session_start();
    valider($idModele);
    return $app->redirect('/test/web/index.php/presentation');
})->bind('validModele');

//redirection page refuseModele pour exécuter la fonction refuser($idModele)
$app->match('/refuseModele/{idModele}', function ($idModele) use ($app) {
    session_start();
    refuser($idModele);
    return $app->redirect('/test/web/index.php/presentation');
})->bind('refuseModele');

//redirection page SupprimerDonnee pour exécuter la fonction SupprimerDonnee($idModele)
$app->match('/SupprimerDonnee/{idModele}', function ($idModele) use ($app) {
    session_start();
    SupprimerDonnee($idModele);
    return $app->redirect('/test/web/index.php/ajoutPhoto/'.$idModele);
})->bind('SupprimerDonnee');

//redirection page SupprimerPhoto pour exécuter la fonction SupprimerPhoto($idModele)
$app->match('/SupprimerPhoto/{idModele}', function ($idModele) use ($app) {
    session_start();
    SupprimerPhoto($idModele);
    return $app->redirect('/test/web/index.php/ajoutPhoto/'.$idModele);
})->bind('SupprimerPhoto');


//redirection page Modification.twig
$app->match('/modification', function () use ($app) {
    session_start();
    if (session_status() == PHP_SESSION_NONE) {
		return $app->redirect('/test/web/index.php/authentification');
	}
    else if(!isset($_SESSION['idUtilisateur']))
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else if ($_SESSION['idUtilisateur'] == NULL)
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else
    {
        return $app['twig']->render('Modification.twig',
    	array('title' => "modification",
    	'nom' => getNomSession(),
    	'prenom' => getPrenomSession(),
    	'id' => getIdSession(),
    	'admin' => getAdminSession(),
    	'mail'=> getMailSession(),
	    'chemin' => ''));
    }
})->bind('modification');

//redirection page index.twig
$app->match('/deconnexion', function()  use ($app){
    session_start();
    deco();
    return $app['twig']->render('index.twig',
	array('title' => "PH3D",'img' => chercherPhotos(),
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
    'admin' => getAdminSession(),
	'id' => getIdSession(),
	'chemin' => ''));
})->bind('deconnexion');

//redirection page validAdmin.twig
$app->match('/validAdmin/{idModele}',  function ($idModele) use ($app) {
	session_start();
	session_start();
	return $app['twig']->render('validAdmin.twig',
	array('title' => "validAdmin",
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'admin' => getAdminSession(),
	'coms' => getComs($idModele),
	'infos' => getInfo($idModele),
	'chemin' => ''));
})->bind('validAdmin');

//redirection page Visualisation.twig
$app->match('/visualisation/{idModele}', function ($idModele) use ($app) {
	session_start();
	return $app['twig']->render('Visualisation.twig',
	array('title' => "Modele 3D",
	'nom' => getNomSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'admin' => getAdminSession(),
	'coms' => getComs($idModele),
	'infos' => getInfo($idModele),
	'photos' => getPhotoAndText($idModele),
//	'donnee' => getDonnee($idModele),
	'chemin' => '../'));
})->bind('visualisation');


//redirection page AjoutPhoto.twig
$app->match('/ajoutPhoto/{idModele}', function ($idModele) use ($app) {
	session_start();
	if (session_status() == PHP_SESSION_NONE) {
		return $app->redirect('/test/web/index.php/authentification');
	}
    else if(!isset($_SESSION['idUtilisateur']))
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else if ($_SESSION['idUtilisateur'] == NULL)
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else
    {
    	return $app['twig']->render('AjoutPhoto.twig',
    	array('title' => "Ajouter photo",'action' => 'Ajouter',
    	'nom' => getNomSession(),
    	'admin' => getAdminSession(),
    	'prenom' => getPrenomSession(),
    	'id' => getIdSession(),
    	'infos' => getInfo($idModele),
    	'statu' => getStatuModele($idModele),
	    'chemin' => '../'));
    }
})->bind('ajoutPhoto');

//redirection page visualisationPhoto.twig
$app->match('/visualisationPhoto/{idModele}', function ($idModele) use ($app) {
	session_start();
	return $app['twig']->render('visualisationPhoto.twig',
	array('title' => "Visualisation photos", 'redirection' =>  RetourEnArriere(),
	'nom' => getNomSession(),
	'admin' => getAdminSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'infos' => getInfo($idModele),
	'photos' => getPhoto($idModele),
    'chemin' => '../'));
})->bind('visualisationPhoto');

//redirection page visualisationDonnee.twig
$app->match('/visualisationDonnee/{idModele}', function ($idModele) use ($app) {
	session_start();
	return $app['twig']->render('visualisationDonnee.twig',
	array('title' => "Visualisation photos", 'redirection' =>  RetourEnArriere(),
	'nom' => getNomSession(),
	'admin' => getAdminSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'infos' => getInfo($idModele),
	'cheminXML' => getCheminXML($idModele),
    'chemin' => '../'));
})->bind('visualisationDonnee');

//redirection page visualisationUtilisateur.twig
$app->match('/visualisationUtilisateur/{idU}', function ($idU) use ($app) {
	session_start();
	return $app['twig']->render('visualisationUtilisateur.twig',
	array('title' => "Utilisateur",'redirection' =>  RetourEnArriere(),
	'nom' => getNomSession(),
	'admin' => getAdminSession(),
	'prenom' => getPrenomSession(),
	'id' => getIdSession(),
	'infos' => getInfoUtilisateur($idU),
    'chemin' => '../'));
})->bind('visualisationUtilisateur');

//redirection page suppr pour exécuter la fonction supprimerModele($modele)
$app->match('/suppr/{modele}', function () use ($app) {
	session_start();
	if (session_status() == PHP_SESSION_NONE) {
		return $app->redirect('/test/web/index.php/authentification');
	}
    else if(!isset($_SESSION['idUtilisateur']))
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else if ($_SESSION['idUtilisateur'] == NULL)
    {
        return $app->redirect('/test/web/index.php/authentification');
    }
    else
    {
        supprimerModele($modele);
    	return $app->redirect('/test/web/index.php/presentation');
    }
})->bind('supprimerModele');

//redirection page Erreur.twig
$app->match('/erreur/{NUM_ERR}', function ($NUM_ERR) use ($app){
    session_start();
	return $app['twig']->render('Erreur.twig',
	array('title' => "Erreur",'message' => getMessage($NUM_ERR), 'redirection' => getRedirection($NUM_ERR),
	'nom' => getNomSession(),
	'admin' => getAdminSession(),
	'id' => getIdSession(),
	'prenom' => getPrenomSession(),
	'chemin' => '../'
	));
});

//redirection vers les differentes types d'erreurs possibles
$app->error(function (\Exception $e, $code) use ($app){
    session_start();
    switch ($code) {
        case 404:
            return $app->redirect('/test/web/index.php/erreur/404');
        	break;
        default:
            return $app->redirect('/test/web/index.php/erreur/-1');
    }
});

$app->match('testParse', function(){
   session_start();
   parseTxt('../web/media/cameras_v2.txt');
   return '';
});
/*
function supprimerModele($idModele)
{
    mysql_connect("clementbardon.com.mysql", "clementbardon_c", "projetweb");
	mysql_select_db("clementbardon_c");
	$query = "DELETE FROM `modele` WHERE idModele = " . $idModele;
	$result = mysql_query($query) or die(mysql_error());
	$result = mysql_query($query) or die(mysql_error());
}*/

// fonction pour afficher les commentaires
function getComs($idModele)
{
    $com = array(
	'nom' => '',
	'prenom' => '',
	'idU' => 0,
	'prof' => '',
	'lieu' => '',
	'comment' => '');
	$retour = array();
	if(session_status() == PHP_SESSION_NONE || !isset($_SESSION['idUtilisateur']) || $_SESSION['idUtilisateur'] == NULL)
	{
	    $query = "SELECT * FROM commentaire WHERE idModele = " . $idModele . ' and visibilite = 0';
	}
	else
	{
	    $query = "SELECT * FROM commentaire WHERE idModele = " . $idModele;
	}
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
    {
        $com['idU'] = $row['idUtilisateur'];
        $query2 = "SELECT nom,prenom,profession,lieuTravail FROM utilisateur WHERE idUtilisateur = " . $row['idUtilisateur'];
	    $result2 = mysql_query($query2) or die(mysql_error());
	    while($row2 = mysql_fetch_assoc($result2))
        {
	        $com['nom'] = $row2['nom'];
	        $com['prenom'] = $row2['prenom'];
	        $com['prof'] = $row2['profession'];
	        $com['lieu'] = $row2['lieuTravail'];
	        
        }
        $com['comment'] = $row['message'];
        array_push($retour,$com);
    }
	return $retour;
}



// recupere la session NOM actuelle
function getNomSession() {
	if (session_status() == PHP_SESSION_NONE) {
		return 'null';
	}
	else if (!isset($_SESSION['nom'])) {
		return 'null';
	}
	else {
		return $_SESSION['nom'];
	}
}

// recupere la session Prenom actuelle		
function getPrenomSession() {
	if (session_status() == PHP_SESSION_NONE) {
		return 'null';
	}
	else if (!isset($_SESSION['prenom'])) {
		return 'null';
	}
	else {
		return $_SESSION['prenom'];
	}
}

// recupere la session Id actuelle
function getIdSession() {
	if (session_status() == PHP_SESSION_NONE) {
		return 'null';
	}
	else if (!isset($_SESSION['idUtilisateur'])) {
		return 'null';
	}
	else {
		return $_SESSION['idUtilisateur'];
	}
}

// recupere la session Mail actuelle
function getMailSession() {
	if (session_status() == PHP_SESSION_NONE) {
		return 'null';
	}
	else if (!isset($_SESSION['mail'])) {
		return 'null';
	}
	else {
		return $_SESSION['mail'];
	}
}

// recupere la session Admin actuelle
function getAdminSession() {
	if (session_status() == PHP_SESSION_NONE) {
		return 'null';
	}
	else if (!isset($_SESSION['admin'])) {
		return 'null';
	}
	else {
		return $_SESSION['admin'];
	}
}

// Remet à zero les variables de sessions 
function deco()
{
    $_SESSION["nom"] = NULL;
    $_SESSION["prenom"] = NULL;
    $_SESSION["id"] = NULL;
    $_SESSION["admin"] = NULL;
    session_destroy();
}


// retoune les différents messages d'erreurs possibles
function getMessage($num)
{
    switch($num)
    {
        case '1':
            return 'Attention erreur, veuillez verifier que tout les champs soient correctement remplis !';
            break;
        case '2':
            return 'Les deux mots de passe que vous avez rentrés ne correspondent pas…';
            break;
        case '3':
            return 'Le formulaire n\'est pas correctement remplie !';
            break;
        case '4':
            return "Ce login n'existe pas !" ;
            break;
        case '5':
            return 'Vous avez atteint le quota de tentative, essayez demain !';
            break;
        case '6':
            return 'Le mot de passe et/ou le login sont incorrectes ';
            break;
        case '7':
            return 'Erreur lors de l\'upload du fichier.';
            break;
        case '8':
            return 'Le modèle 3D n\'est pas correct vérifiez qu\'il est au bon format (.obj).';
            break;
        case '9':
            return 'Vous avez utilisé un/des caractère(s) incorrectes (\\, /, ", <, >, :).';
            break;
        case '10':
            return 'Ce nom de modèle est déjà utilisé';
            break;
        case '11':
            return 'Mot de passe incorect';
            break;
        case '12':
            return 'L\'image n\'est pas correcte vérifiez qu\'elle est au bon format (.png ou .jpg).';
            break;
        case '13':
            return 'Les données doivent être dans un fichier au format xml.';
            break;
        case '14':    
            return 'Le fichier de paramètre n\'est pas au bon format (.txt)';
            break;
        case '404':
            return '404 : La page demandée n\'existe pas !';
            break;
        default:
            return 'Une erreur est survenue ! Merci de bien vouloir retourner sur la page d\'accueil';
            break;
    }
}

// Retour à la page arriere
function RetourEnArriere()
{
        return $_SERVER['HTTP_REFERER'];
  
}

// Pour la page Erreur.twig retour page arriere ou retour index
function getRedirection($num)
{
    if ($num == '404') {
        return 'http://clementbardon.com/test/web/index.php/';
    }
    else {
        return $_SERVER['HTTP_REFERER'];
    }
}

// genere le carrousel
function chercherPhotos()
{
	$nb = 0;
	$chemin = "../media/img/carrousel/";
	$images = array();
	
	if($dossier = opendir('media/img/carrousel'))
	{
		while(($fichier = readdir($dossier)) !== false)
		{
			if($fichier != '.' && $fichier != '..')
			{
				array_push($images,$chemin . $fichier);
				$nb++;
			}
		}
		closedir($dossier);
	}
	while (count($images)>4)
	{
			unset($images[rand(0,count($images))]);
			$images = array_values($images);
	}
	return $images;
}

// fonction pour le DropDownn pour une liste de modele soit en attentes soit confirmées
function modeleDropdown($type){
    $retour = array();
    $modele = array(
        'name' => '',
        'id' => '');
	$query = "SELECT idModele,nomModele FROM modele WHERE enAttente = " . $type;
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_assoc($result)) {
	    $modele['name'] = $row['nomModele'];
	    $modele['id'] = $row['idModele'];
        array_push($retour,$modele);
	}
	return $retour;
}

// fonction pour choisir le type d'objet du modele
function typeDropdown(){
    $retour = array();
    $type = array(
        'id' => '',
        'name' => '');
	$query = "SELECT * FROM type";
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_assoc($result)) {
	    $type['id'] = $row['idType'];
	    $type['name'] = $row['nomType'];
        array_push($retour,$type);
	}
	return $retour;
}

// retourne les informations concernant le modele affichée
function getInfo($idModele)
{
    $infos = array(
        'id' => $idModele,
        'name' => '',
        'date' => '',
        'type' => '',
        'latitude' => null,
        'longitude' => null,
        'cheminM' => '',
        'cheminT' => '',
        'idU' => '',
        'nom' => '',
        'prenom' => '');

	$query = "SELECT * FROM modele where idModele = ".$idModele;
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
    {
        $infos['name'] = $row['nomModele'];
        $infos['date'] = $row['dateModele'];
        $infos['cheminM'] = $row['cheminM'];
        $infos['cheminT'] = $row['cheminT'];
        $infos['latitude'] = $row['latitude'];
        $infos['longitude'] = $row['longitude'];
        $infos['idU'] = $row['idUtilisateur'];
        break;
    }
    
    $query = "SELECT nomType FROM type where idtype = ( SELECT idtype FROM modele where idModele = ".$idModele." )";
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
    {
        $infos['type'] = $row['nomType'];
        break;
    }
    
    $query = "SELECT nom,prenom FROM utilisateur where idUtilisateur = " . $infos['idU'];
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
    {
        $infos['nom'] = $row['nom'];
        $infos['prenom'] = $row['prenom'];
        break;
    }
    
    
	return $infos;
}

// retourne les infos d'un utilisateur
function getInfoUtilisateur($idU)
{
    $infos = array(
        'id' => $idU,
        'nom' => '',
        'prenom' => '',
        'prof' => '',
        'lieu' => '');

	$query = "SELECT * FROM utilisateur where idUtilisateur = ".$idU . " limit 1";
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
    {
        $infos['nom'] = $row['nom'];
        $infos['prenom'] = $row['prenom'];
        $infos['prof'] = $row['profession'];
        $infos['lieu'] = $row['lieuTravail'];
    }
    
	return $infos;
}

// Permet de valider un modele 
function valider($idModele)
{
    mysql_connect("clementbardon.com.mysql", "clementbardon_c", "projetweb");
		mysql_select_db("clementbardon_c");
        $sql = "UPDATE modele SET enAttente ='0' WHERE idModele = " .$idModele;
        $requete_1 = mysql_query($sql) or die ( mysql_error() );
}

// Permet de refuser et donc supprimer un modele de la BDD et serveur
function refuser($idModele)
{
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

}

// Supprime les données de la BDD et serveur
function SupprimerDonnee($idModele)
{
        $sqlCheminDonnee = "SELECT cheminD FROM donnee WHERE idModele = '".$idModele."'";
        $reqCheminDonnee = mysql_query($sqlCheminDonnee) or die('Erreur SQL !<br />'.$sqlCheminDonnee.'<br />'.mysql_error());
        $dataCheminDonnee = mysql_fetch_array($reqCheminDonnee);
        $efface_Donnee = unlink ("../web/".$dataCheminDonnee['cheminD']);
        $sqlDonnee = "DELETE FROM `donnee` WHERE idModele = '".$idModele."'";
        $requete_Donnee = mysql_query($sqlDonnee) or die ( mysql_error() );
        mssql_free_result($requete_Donnee);
}

// Supprime toutes les photos correspondant à un modele sur la BDD et serveur
function SupprimerPhoto($idModele)
{
    $sqlNom = "SELECT nomModele FROM modele WHERE  idModele = ".$idModele."";
    $nomModele = mysql_fetch_array($sqlNom) or die('Erreur SQL !<br />'.$sqlNom.'<br />'.mysql_error());
       $cheminPhotoSupp = "../web/media/modele/photos/".$nomModele;
        rmdir_recursive($cheminPhotoSupp);
         $sqlPhoto = "DELETE FROM `photo` WHERE idModele = '".$idModele."'";
             $requete_Photo = mysql_query($sqlPhoto) or die ( mysql_error() );
}

// permet de signifier la presence d'une photo ou d'un modele
function getStatuModele($idModele)
{
    $statu = array(
        'nbPhoto' => 0,
        'xml' => false
        );
    
    $requete = "SELECT COUNT(*) as total FROM photo where idModele = ".$idModele;
    $result = mysql_query($requete);
    $resultat = mysql_fetch_assoc($result);
    $statu['nbPhoto'] = $resultat['total'];
    
    $requete = "SELECT COUNT(*) as total FROM donnee where idModele = ".$idModele;
    $result = mysql_query($requete);
    $resultat = mysql_fetch_assoc($result);
    if ($resultat['total'] != '0')
    {
         $statu['xml'] = true;
    }
    return $statu;
}

// Recupere les photos correspondant à l'id du modele
function getPhoto($idModele)
{
    $photos = array();
    $query = "SELECT cheminP FROM photo where idModele = ".$idModele;
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
    {
        array_push($photos,$row['cheminP']);
    }
    return $photos;
}

// Recupere les photos et les fichiers de coordonnées correspondant à l'id du modele
function getPhotoAndText($idModele)
{
    $photos = array();
    $unePhoto = array(
        'cheminP' => '',
        'largeur' => 0,
        'format' => '',
        'coefConv' => 1.0,
        'infos' => array());
    $query = "SELECT cheminParametre FROM modele where idModele = ".$idModele . " limit 1";
	$result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $param = $row['cheminParametre'];
        
    $query = "SELECT cheminP,largeurCapteur,format,coefficientConversion FROM photo where idModele = ".$idModele;
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($result))
    {
        $unePhoto['cheminP'] = '../../'.$row['cheminP'];
        $unePhoto['largeur'] = $row['largeurCapteur'];
        $unePhoto['format'] = $row['format'];
        $unePhoto['coefConv'] = floatval($row['coefficientConversion']);
        
        $temp = explode("/", $unePhoto['cheminP']);
        $nomPhoto = $temp[sizeof($temp)-1];
        $unePhoto['infos'] = getInfoPhoto($nomPhoto,$param);
        
        array_push($photos,$unePhoto);
    }
    return $photos;
}

// recupere les informations d'une photo (renvoi -1 si la photo n'est pas dans le fichier de parametre)
function getInfoPhoto($name,$fichier){
    $curseur = 16;
    $file = file($fichier);
    $nbPhoto = (int)$file[$curseur];
    $curseur +=2;
    
    $retour = array(
        'focal' => 1.0,
        'pos' => array(),
        'matrice' => array()
        );
    
    for($i=0;$i<$nbPhoto;$i++)
    {
        if( trim($file[$curseur]) == trim($name) )
        {
            $photo = parsePhoto($file,$curseur);
            $retour['focal'] = $photo['focal'];
            $retour['pos']['x'] = $photo['pos']['x'];
            $retour['pos']['y'] = $photo['pos']['y'];
            $retour['pos']['z'] = $photo['pos']['z'];
            $retour['matrice'] = parseMatrice($file,$curseur + 8);
            break;
        }
        else
        {
            $curseur+=14;
        }
    }
    return $retour;
}


// retourn le chemin XML de la donnée
function getCheminXML($idModele)
{
    $query = "SELECT cheminD FROM donnee where idModele = ".$idModele." limit 1";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	return $row['cheminD'];
}

function getDonnee($idModele)
{
    $query = "SELECT cheminD FROM donnee where idModele = ".$idModele." limit 1";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
    $fichier = $row['cheminD'];
    


    if (file_exists($fichier)) {
        
$carareWrap = simplexml_load_file($fichier);

$id = $carareWrap->carare->collectionInformation-> id;


	$contenu = array(
     'id' => $id,
     
  );
	
	return $contenu;
} 
    
}

// parse un fichier pour recuperer des informations sur les photos
function parsePhoto($file, $line)
{
    $nom = $file[$line];
    $focal = (float)$file[$line + 2];
    $pos = array('x' => 0, 'y' => 0, 'z' => 0);
    $linePose = $file[$line + 4];

    $part = explode(" ", $linePose);
    $pos['x'] = (float)$part[0];
    $pos['y'] = (float)$part[1];
    $pos['z'] = (float)$part[2];

    $retour = array(
        'nom' => $nom,
        'focal' => $focal,
        'pos' => $pos
        );
    return $retour;
}

//parse un fichier pour realiser une matrice de rotation
function parseMatrice($file,$line){
    $matrice = array();
    for ($i = 0; $i<4; $i++){
        $matrice[i] = array(
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0
            );
    }
    $m1 = $file[$line];
    $m2 = $file[$line + 1];
    $m3 = $file[$line + 2];

    $matrice[0] = ligneMatrice($m1);
    $matrice[1] = ligneMatrice($m2);
    $matrice[2] = ligneMatrice($m3);
    
    $matrice[3][0] = 0;
    $matrice[3][1] = 0;
    $matrice[3][2] = 0;
    $matrice[3][3] = 1;
    
    return $matrice;
}

// creer un tableau[4] et le remplie des valeurs contenues dans la ligne m et de 0 dans la derniere case
function ligneMatrice($m){
    $mA = explode(" ", $m);
    $retour = array();
    $retour[0] = (float)$mA[0];
    $retour[1] = (float)$mA[1];
    $retour[2] = (float)$mA[2];
    $retour[3] = 0;
    return $retour;
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

