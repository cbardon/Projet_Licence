<?php
session_start();
$mail = $_SESSION['mail'];
$nomModele = $_POST['nomModele'];

	mysql_connect("clementbardon.com.mysql", "clementbardon_c", "projetweb");
		mysql_select_db("clementbardon_c");
		
		 $sqlModele = "SELECT * FROM modele WHERE nomModele = "."'".$nomModele."'";