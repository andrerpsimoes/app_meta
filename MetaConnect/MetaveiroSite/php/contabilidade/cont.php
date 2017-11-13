
<?php
include('bdd.php');

$dataatual = date("Y-m-d");
$final=$dataatual;
$final=date('Y-m-d', strtotime("-2 month"));



try{ 

    include('../bdd.php');
    $query=$conn->prepare("select contador, nomecliente, zona, avaria from assistencias order by contador desc ");

    $query->execute();
    $result = $query;
    
    
    
    foreach($result as $row)
     {
      echo "<tr><td  data-toggle=\"modal\" data-target=\"#exampleModal\">"; 
      echo $row['contador'];
      echo "</td><td  data-toggle=\"modal\" data-target=\"#exampleModal\">";   
      echo $row['nomecliente'];
      echo "</td><td  data-toggle=\"modal\" data-target=\"#exampleModal\">";   
      echo $row['zona'];
      echo "</td><td  data-toggle=\"modal\" data-target=\"#exampleModal\">";   
      echo $row['avaria'];
      echo "</td></tr>"; 
     }

}catch(PDOException  $e ){
echo "Error: ".$e;
}
