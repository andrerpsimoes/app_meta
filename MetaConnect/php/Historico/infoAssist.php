<?php
/*
  include("restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  } */

include '../../configs/config.php'; // MetaveiroAppTestes
include '../../configs/config2.php'; // eticadata DB


$id_servico = $_POST['id_servico'];


/*
 * ********** Inicio Querys **************
 */

$servicoDetails = $conn_meta->prepare("select s.data_hora, s.recebido_por, s.pedido_por, s.prioridade, s.observacoes, s.id_cliente, 
(select id_projeto from projeto_cliente where is_active=1 and id=s.id_proj_cliente) as projeto, s.counter, s.local_partida, s.local_chegada,
s.distancia, s.duracao, s.distanciaAestrada, s.duracaoAestrada
from servico s
where s.id=$id_servico");


$servicoDetails->execute();
$servicoDetailsResult = $servicoDetails->fetch();
/*
  echo "<pre>";
  print_r($servicoDetailsResult);
  echo "</pre>"; */

$datetimeFromSql = $servicoDetailsResult['data_hora'];
$time = strtotime($datetimeFromSql);
$data = date("d/m/Y H:i:s", $time);

$id_cliente = $servicoDetailsResult['id_cliente'];
$id_projeto = $servicoDetailsResult['projeto'];
$id_counter = $servicoDetailsResult['counter'];
$recebido_por = $servicoDetailsResult['recebido_por'];
$pedido_por = $servicoDetailsResult['pedido_por'];
$prioridade = $servicoDetailsResult['prioridade'];
$observacoes = $servicoDetailsResult['observacoes'];

$local_partida= $servicoDetailsResult['local_partida'];
$local_chegada= $servicoDetailsResult['local_chegada'];
 $distancia = $servicoDetailsResult['distancia'];
    $duracao = $servicoDetailsResult['duracao'];
    $distanciaAestrada = $servicoDetailsResult['distanciaAestrada'];
    $duracaoAestrada = $servicoDetailsResult['duracaoAestrada'];

//tipos de prioridade existentes
if ($servicoDetailsResult[3] == 1) {
    $prioridade = ' Baixa';
} elseif ($servicoDetailsResult[3] == 2) {
    $prioridade = ' Média';
} elseif ($servicoDetailsResult[3] == 3) {
    $prioridade = ' Alta';
}

$infoCliente = $conn_etica->prepare("select strNome, strMorada_lin1, strLocalidade, strPostal, strNumContrib, strTelefone from Tbl_Clientes where intCodigo = $id_cliente");
$infoCliente->execute();
$infoClienteResult = $infoCliente->fetch();

$nome_cliente = $infoClienteResult['strNome'];
$morada_cliente = $infoClienteResult['strMorada_lin1'];
$localidade = $infoClienteResult['strLocalidade'];
$cod_postal = $infoClienteResult['strPostal'];
$contribuinte = $infoClienteResult['strNumContrib'];
$telefone = $infoClienteResult['strTelefone'];

/*
 * ********** Fim Querys **************
 */
?>

<form class="form_modalInfo" method="POST">
    <h4>Informação Assistência</h4><br>
    <div class="row" style="margin-bottom: 7px;">
        <div class="input-field col s8">
            <?php
            echo "<b>Cliente: </b>" . $nome_cliente;
            ?>
        </div>
        <div class="input-field col s4">
            <?php
            echo "<b>Telefone: </b>" . $telefone;
            ?>
        </div>
    </div>

    <div class="row" style="margin-bottom: 7px;">
        <div class="input-field col s8">
            <?php
            echo "<b>Morada: </b>" . $morada_cliente;
            ?>
        </div>
        <div class="input-field col s4">
            <?php
            echo "<b>Localidade: </b>" . $localidade;
            ?>
        </div>
    </div>

    <div class="row" style="margin-bottom: 7px;">
        <div class="input-field col s4">
            <?php
            echo "<b>Recebido por: </b>" . $recebido_por;
            ?>
        </div>
        <div class="input-field col s4">
            <?php
            echo "<b>Pedido por: </b>" . $pedido_por;
            ?>
        </div>
        <div class="input-field col s4">
            <?php
            echo "<b>Prioridade : </b>" . $prioridade;
            ?>
        </div>
    </div>

    <div class="row" style="margin-bottom: 7px;">
        <div class="input-field col s12">
            <?php
            $stat = $conn_meta->prepare("select la.id_area, a.descricao, (select descricao from area where id=a.id_parent) as pai from servico_area as la, area as a where la.id_servico=$id_servico and a.id= la.id_area and la.is_active=1");
            $stat->execute();
            $results_meta = $stat->fetchAll(PDO::FETCH_ASSOC);

            echo "<b>Área(s) : </b>";
            if ($results_meta) {

                $seg_ele = array();
                $seg_inc = array();
                $telecom = array();
                $redes = array();
                $infor = array();
                $audiovisuais = array();
                $equi_esc = array();
                foreach ($results_meta as $area) {
                    if ($area['pai'] == 'Segurança Eletrónica') {
                        $seg_ele[] = $area['descricao'];
                    }
                    if ($area['pai'] == 'SCIE') {
                        $seg_inc[] = $area['descricao'];
                    }
                    if ($area['pai'] == 'Telecomunicações') {
                        $telecom[] = $area['descricao'];
                    }
                    if ($area['pai'] == 'Redes') {
                        $redes[] = $area['descricao'];
                    }
                    if ($area['pai'] == 'Informática') {
                        $infor[] = $area['descricao'];
                    }
                    if ($area['pai'] == 'AudioVisuais') {
                        $audiovisuais[] = $area['descricao'];
                    }
                    if ($area['pai'] == 'Equipamento Escritório') {
                        $equi_esc[] = $area['descricao'];
                    }
                }

                echo!empty($seg_ele) ? "<br><b><i>Segurança Eletrónica: </i></b>" . implode(", ", $seg_ele) . "<br>" : NULL;
                echo!empty($seg_inc) ? "<br><b><i>Segurança contra Incêndios: </i></b>" . implode(", ", $seg_inc) . "<br>" : NULL;
                echo!empty($telecom) ? "<br><b><i>Telecomunicações: </i></b>" . implode(", ", $telecom) . "<br>" : NULL;
                echo!empty($redes) ? "<br><b><i>Redes: </i></b>" . implode(", ", $redes) . "<br>" : NULL;
                echo!empty($infor) ? "<br><b><i>Informática: </i></b>" . implode(", ", $infor) . "<br>" : NULL;
                echo!empty($audiovisuais) ? "<br><b><i>AudioVisuais: </i></b>" . implode(", ", $audiovisuais) . "<br>" : NULL;
                echo!empty($equi_esc) ? "<br><b><i>Equipamento Escritório: </i></b>" . implode(", ", $equi_esc) . "<br>" : NULL;
            }
            ?>
        </div>
    </div>

    <div class = "row" style="margin-bottom: 7px;">
        <div class = "input-field col s12">
            <?php
            echo "<b>Observações : </b>" . $observacoes;
            ?>
        </div>
    </div>

    <?php
    if ($id_projeto) { //caso haja projeto
        $sql_proj = $conn_meta->prepare("select descricao, responsavel, contacto_responsavel, local from projeto where id=$id_projeto and is_active=1");
        $sql_proj->execute();
        $sql_projResult = $sql_proj->fetch();

        $descricao = $sql_projResult['descricao'];
        $responsavel = $sql_projResult['responsavel'];
        $contacto_responsavel = $sql_projResult['contacto_responsavel'];
        $local = $sql_projResult['local'];
        $div_projeto = '';


        $div_projeto .= '<div class = "row" style="margin-bottom: 7px;">
        <div class = "input-field col s12">
        <div class="input-field" style="width: 100%;float: left;margin-bottom: 7px;">
                <div class="pro" style="width: auto;height: 120px;padding: 1px;border: 2px solid black;">
                    <h5 style="margin-top:2px;margin-bottom: 10px;"><b>Projeto</b></h5>
                    <div class="descricao" style="width: 100%;float: left;margin-bottom: 1px;" ><i><b>Descricao: </b></i>' . $descricao . '</div>'
                . '<div  style="width: 100%;float: left;margin-bottom: 1px;" ><i><b>Responsável: </b></i>' . $responsavel . '</div>'
                . '<div  style="width: 60%;float: left;margin-bottom: 1px;" ><i><b>Contacto Responsável: </b></i>' . $contacto_responsavel . '</div>'
                . '<div style="width: 30%;float: left;margin-bottom: 1px;"><i><b>Local: </b></i>' . $local . '</div>'
                . '</div></div></div></div>';

        $morada = $local;
        echo $div_projeto;
    }    //fim caso nao haja projeto
    else {
        $morada = $localidade;
    }
    ?>
         <h5>Informações Sobre a Viagem</h5>
              
           
            <div class = "row" style="margin-bottom: 7px;">
                <div class = "input-field col s6">
                    <?php
                    echo "<b>Local Partida: </b>".$local_partida;
                    ?>
                </div>
                <div class = "input-field col s6">
                    <?php
                        echo "<b>Local Chegada: </b>" . $local_chegada;
                    ?>
                </div>
            </div>
            <div class = "row" style="margin-bottom: 7px;">
                <div class = "input-field col s6">
                    <b>Distância S/ Autoestrada:</b><?php echo $distancia; ?> 
                   
                </div>
                <div class = "input-field col s6">
                    <b>Distância C/ Autoestrada:</b><?php echo $distanciaAestrada; ?>
                   
                </div>
                <div class = "input-field col s6">
                    <b>Duração S/ Autoestrada:</b><?php echo $duracao; ?> 
                   
                </div>
                <div class = "input-field col s6">
                    <b>Duração C/ Autoestrada:</b><?php echo $duracaoAestrada; ?>
                   
                </div>

            </div>

</form>