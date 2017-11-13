
<?php

$user = $_POST['user'];
$cont=0;


try{ 

    include('../bdd.php');
    $query=$conn->prepare("select id from login where username='".$user."'");

    $query->execute();
    $result = $query;

    foreach($result as $row)
     {
      $cont=1;
     }
    
    echo $cont;
}catch(PDOException  $e ){
echo "Error: ".$e;
}

?>



