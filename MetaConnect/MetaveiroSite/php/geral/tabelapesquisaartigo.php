


<?php
header('Content-type: text/plain; charset=utf-8');

    $codartigo= $_POST['codartigo'];
    $codcliente=  $_POST['codcliente'];
    $datainicio=  $_POST['datainicio'];
    $datafim=  $_POST['datafim'];
    $pesquisarpor =$_POST['pesquisarpor'];

        if($datafim=='')
        { 
           $datafim= date("Y-m-d");
        }


try{ 

   $serverName = "metasede1.dyndns.org";
 $conn = new PDO("sqlsrv:Server=$servername ; Database=Emp_001", "sa", "Platinum01");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
    
    
    $query= "   select cab.intNumero as num, cab.strCVDNome as nome, COUNT(linha.strCodArtigo) as countartigo  from Mov_Venda_Lin linha, Mov_Venda_Cab cab
where linha.intNumero= cab.intNumero
and cab.strAbrevTpDoc = 'FCTR'
and linha.strAbrevTpDoc = 'FCTR'
and bitAnulado=0 ";
    

    if($datainicio != '')
        $query.="and cab.dtmData >= '".$datainicio."' and cab.dtmData <= '".$datafim."'";
    else
        $query.="and linha.strCodExercicio= 'EX 2017'";
        
    if($codartigo!=''){
        $query.="and linha.strCodArtigo= '".$codartigo."' ";
    }else{
         switch($pesquisarpor){
            case 'extintores':

                $query.=" and ( linha.strCodArtigo= '10205000002'
                          or linha.strCodArtigo= '10205000005'
                          or linha.strCodArtigo= '10205000010'
                          or linha.strCodArtigo= '10205000062'
                          or linha.strCodArtigo= '10205000206'
                          or linha.strCodArtigo= '10205000212'
                          or linha.strCodArtigo= '10205000225'
                          or linha.strCodArtigo= '10205000253'
                          or linha.strCodArtigo= '10205000254'
                          or linha.strCodArtigo= '10205000256'
                          or linha.strCodArtigo= '10205001000'
                          or linha.strCodArtigo= '10205002751'
                          or linha.strCodArtigo= '10205006000'
                          or linha.strCodArtigo= '10205009000'
                          or linha.strCodArtigo= '10205009009'
                          or linha.strCodArtigo= '10205010250'
                          or linha.strCodArtigo= '10205051010'
                          or linha.strCodArtigo= '10205051014')


                        ";

                break;
                default:

                    break;
         }
    
    }
    
    if($codcliente!='')
       $query.=" and cab.intCodEntidade= ".$codcliente."";
    
    
    
$query.="group by cab.intNumero, cab.strcvdnome
order by cab.intNumero";
    
    
    echo $query;
   
     $query2=$conn->prepare($query);

    
    $query2->execute();
    $result = $query2;
    
  echo " <table>";
  echo " <thead>";
    echo " <th  data-field=\"intNumero\" >Número</th>
                              <th data-field=\"strCVDNome\">Cliente</th>
                              <th data-field=\"countstrcodartigo\">Quantidade</th>
                              <th ></th>
         </thead>";
    
    
    
  foreach($result as $row)
     {
        echo "<tr> <td>"; 
      echo $row['num'];
     echo "</td> <td>";   
      echo $row['nome'];
     echo "</td> <td>"; 
    echo $row['countartigo'];;
    echo "</td> <td> <a style='cursor:pointer;' class='detalhes' num='".$row['num']."'>Detalhes</a> </td> </tr>"; 
     }
    
    
    echo  "</table>";
}catch(PDOException  $e ){
echo "Error: ".$e;
}

?>