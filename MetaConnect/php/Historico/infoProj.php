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


$id_cliente = $_POST['id_cliente'];
$id_projeto = $_POST['id_projeto'];


/*
 * ********** Inicio Querys **************
 */
//Assistencas deste projeto
$projetoDetailsAssist = $conn_meta->prepare("select p.id, s.counter, s.observacoes, s.data_hora "
        . "from projeto_cliente as pc "
        . "inner join projeto as p on p.id = pc.id_projeto "
        . "inner join servico as s on s.id_proj_cliente = pc.id "
        . "where pc.id_cliente='" . $id_cliente . "' and s.tipo_servico=2 and p.id= '" . $id_projeto . "'");

$projetoDetailsAssist->execute();
$projetoDetailsAssistResult = $projetoDetailsAssist->fetchAll();

//Levantamentos deste projeto
$projetoDetailsLev = $conn_meta->prepare("select p.id, s.counter, s.observacoes, s.data_hora "
        . "from projeto_cliente as pc "
        . "inner join projeto as p on p.id = pc.id_projeto "
        . "inner join servico as s on s.id_proj_cliente = pc.id "
        . "where pc.id_cliente='" . $id_cliente . "' and s.tipo_servico=1 and p.id= '" . $id_projeto . "'");

$projetoDetailsLev->execute();
$projetoDetailsLevResult = $projetoDetailsLev->fetchAll();

//número de assistencias deste projeto
$countAssistencias = $conn_meta->prepare("select count(p.id) "
        . "from projeto_cliente as pc "
        . "inner join projeto as p on p.id = pc.id_projeto "
        . "inner join servico as s on s.id_proj_cliente = pc.id "
        . "where pc.id_cliente='" . $id_cliente . "' and s.tipo_servico=2 and p.id='" . $id_projeto . "'");
$countAssistencias->execute();
$countAssistenciasResult = $countAssistencias->fetch();

//número de levantamentos deste projeto
$countLevantamentos = $conn_meta->prepare("select count(p.id) "
        . "from projeto_cliente as pc "
        . "inner join projeto as p on p.id = pc.id_projeto "
        . "inner join servico as s on s.id_proj_cliente = pc.id "
        . "where pc.id_cliente='" . $id_cliente . "' and s.tipo_servico=1 and p.id='" . $id_projeto . "'");
$countLevantamentos->execute();
$countLevantamentosResult = $countLevantamentos->fetch();

/*
 * ********** Fim Querys **************
 */
?>
<h4>Informação Projeto</h4><br>

<div class="row" style="margin-bottom: 7px;">
    <div class="input-field col s6">
        <?php
        echo "<b>Número de Levantamentos: </b>" . $countLevantamentosResult[0];
        ?>
    </div>
    <div class="input-field col s6">
        <?php
        echo "<b>Número de Assistências: </b>" . $countAssistenciasResult[0];
        ?>
    </div>
</div>

<div class="row" style="margin-bottom: 7px;">
    <div class="input-field col s12">
        <h5>Levantamentos</h5>
        <?php
        if (empty($projetoDetailsLevResult)) {
            echo "<b><i>Este projeto não tem levantamentos associados!</i></b>";
        }
        ?>
    </div>
</div>
<?php
foreach ($projetoDetailsLevResult as $lev) {
    ?>

    <div class="row" style="margin-bottom: 7px;">
        <div class="input-field col s4">
            <?php
            echo "<b>Nº Levantamento : </b>" . $lev['counter'];
            ?>
        </div>

        <div class="input-field col s8">
            <?php
            echo "<b>Data : </b>";
            $datetimeFromSql = $lev['data_hora'];
            $time = strtotime($datetimeFromSql);
            echo $data = date("d/m/Y H:i:s", $time);
            ?>
        </div>
    </div>
    <?php
}
?>

<div class="row" style="margin-bottom: 7px;">
    <div class="input-field col s12">
        <h5>Assistências</h5>
        <?php
        if (empty($projetoDetailsAssistResult)) {
            echo "Este projeto não tem assistências associadas!";
        }
        ?>
    </div>
</div>
<?php
foreach ($projetoDetailsAssistResult as $assist) {
    ?>

    <div class="row" style="margin-bottom: 7px;">
        <div class="input-field col s4">
            <?php
            echo "<b>Nº Assistência : </b>" . $assist['counter'];
            ?>
        </div>

        <div class="input-field col s8">
            <?php
            echo "<b>Data : </b>";
            $datetimeFromSql = $assist['data_hora'];
            $time = strtotime($datetimeFromSql);
            echo $data = date("d/m/Y H:i:s", $time);
            ?>
        </div>
    </div>
    <?php
}
?>