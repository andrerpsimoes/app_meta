<?php

// conecção à base de dados
require_once('bdd.php');

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['fim']) && isset($_POST['color'] )){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['fim'];
	$color = $_POST['color'];
	$tec2 = $_POST['tecnico2'];
	$tec3 = $_POST['tecnico3'];
	$tec4 = $_POST['tecnico4'];

  
    
	$sql = "INSERT INTO events(title, start, fim, color) values ('$title', '$start', '$end', '$color')";
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
   if($tec2!="Técnico")
  {
	$sql = "INSERT INTO events(title, start, fim, color) values ('$title', '$start', '$end','$tec2')";
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
  }if($tec3!="Técnico")
  {
	$sql = "INSERT INTO events(title, start, fim, color) values ('$title', '$start', '$end','$tec3')";
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
  }if($tec4!="Técnico")
  {
	$sql = "INSERT INTO events(title, start, fim, color) values ('$title', '$start', '$end','$tec4')";
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
  }

}
header('Location: '.$_SERVER['HTTP_REFERER']);	
?>
