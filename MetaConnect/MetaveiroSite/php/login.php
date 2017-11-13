<?php
include("restrito.php");
$user = $_POST['user'];
$pass = $_POST['pass'];

try{
include('bdd.php');
$query=$conn->prepare("select id, nome , tipoconta, mail, cor from login where username='".$user."' and pass='".md5($pass)."'");
   
$query->execute();
$result = $query;
    
foreach($result as $row)
 {
  @session_start();  
  $_SESSION["id"]= $row["id"];
  $_SESSION["nome"]= $row["nome"];
  $_SESSION["tipoconta"]= $row["tipoconta"];
  $_SESSION["mail"]= $row["mail"];
  $_SESSION["cor"]= $row["cor"];
  $_SESSION['CREATED'] = time();
  header("Location: ../principal.php");
 }

}catch(PDOException  $e ){
echo "Error: ".$e;
}

?>



