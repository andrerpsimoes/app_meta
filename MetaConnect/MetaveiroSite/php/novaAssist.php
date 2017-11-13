
<?php


$nomeCliente = $_POST['nomecliente'];
$moradaCliente = $_POST['moradacliente'];
$codPostalCliente = $_POST['codpostalcliente'];
$locCliente = $_POST['loccliente'];
$ContribCliente = $_POST['contribcliente'];
$qpediu = $_POST['qpediu'];
$qrecebeu = $_POST['qrecebeu'];
$zona = $_POST['zona'];
$moradaObra = $_POST['moradaobra'];
$avaria = $_POST['avaria'];
$prioridade = $_POST['prioridade'];
$cctv=isset($_POST['cctv']);
$sadi=isset($_POST['sadi']);
$ria=isset($_POST['ria']);
$certificacoes=isset($_POST['certificacoes']);
$levantamentos=isset($_POST['levantamentos']);
$telecomunicacoes=isset($_POST['telecomunicacoes']);
$msadi=isset($_POST['msadi']);
$mextintores=isset($_POST['mextintores']);
$rponto=isset($_POST['rponto']);
$informatica=isset($_POST['informatica']);


try{ 

    include('bdd.php');
    
    $queryCont=$conn->prepare("select assistencias from contadores");

    $queryCont->execute();
    $result = $queryCont;

    $cont=0;
    foreach($result as $row)
     {
       $cont=$row['assistencias'];
     }

    
    
    $query=$conn->prepare(" INSERT INTO assistencias (nomecliente,estado,moradacliente,codpostalcliente,loccliente,contribcliente,qpediu,qrecebeu,zona,moradaobra, avaria, importancia, datacriada, cctv,sadi,ria,certificacoes,levantamentos,telecomunicacoes,msadi,mextintores,rponto,informatica,contador) 
    VALUES ('".$nomeCliente."','0','".$moradaCliente."','".$codPostalCliente."','".$locCliente."','".$ContribCliente."','".$qpediu."','".$qrecebeu."','".$zona."','".$moradaObra."','".$avaria."','".$prioridade."', '".date('Y-m-d H:i:s')."', '".$cctv."', '".$sadi."', '".$ria."', '".$certificacoes."', '".$levantamentos."','".$telecomunicacoes."', '".$msadi."', '".$mextintores."', '".$rponto."', '".$informatica."', '".$cont."')");

    $query->execute();
    
     $queryUpd=$conn->prepare("update contadores set assistencias=".($cont+1));

    $queryUpd->execute();
    
   echo "Registo guardado com sucesso!";
}catch(PDOException  $e ){
echo "Ocorreu um erro, não foi possivel guardar a assistência. Contacte o administrador do sistema.";
}


?>
