
<?php
include("../restrito.php");
$nome = $_POST['nome'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$tipoconta = $_POST['tipoconta'];
$cor = $_POST['valorcor'];
$qcriou = $_SESSION["nome"];

try{
    include('../bdd.php');
    $query=$conn->prepare(" INSERT INTO login (nome,username,pass,mail,cor,tipoconta, qcriou) 
    VALUES ('".$nome."','".$user."','".md5($pass)."','".$email."','".$cor."','".$tipoconta."','".$qcriou."')");

    $query->execute();
 
  echo "Registo gravado com sucesso";
 }catch(PDOException  $e ){
echo "Error: ".$e;
}
   

?>
