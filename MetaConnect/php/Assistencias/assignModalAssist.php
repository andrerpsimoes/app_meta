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

$sql_servicoInfo = $conn_meta->prepare("select prioridade, observacoes from servico where id='" . $id_servico . "'");
$sql_servicoInfo->execute();
$servicoInfo = $sql_servicoInfo->fetch();

$sql_tecnicos = $conn_etica->prepare("SELECT Tbl_Grh_Funcionarios.intCodigo AS codigo, Tbl_Funcionarios.strNome AS nome "
        . " FROM Tbl_Grh_Funcionarios WITH (NOLOCK) "
        . "INNER JOIN Tbl_Funcionarios WITH (NOLOCK) ON (Tbl_Grh_Funcionarios.intCodigo=Tbl_Funcionarios.intCodigo)"
        . " where Tbl_Grh_Funcionarios.strCodExercicio = 'EX 2017'"
        . " and Tbl_Grh_Funcionarios.bitInactivo=0 and Tbl_Funcionarios.strCodDepartamento='2' "
        . "ORDER BY Tbl_Grh_Funcionarios.intCodigo");
$sql_tecnicos->execute();
$tecnicos = $sql_tecnicos->fetchAll();

$sql_tec_assist = $conn_meta->prepare("select id_tecnico from tecnico_servico where id_servico='" . $id_servico . "'");
$sql_tec_assist->execute();
$tecnicos_assistencia = $sql_tec_assist->fetchAll();

$todos_ids_tec = array();
$todos_ids_assi = array();

foreach ($tecnicos as $tecnico) {
    $todos_ids_tec[] = $tecnico['codigo'];
}

foreach ($tecnicos_assistencia as $tec_assist) {
    $todos_ids_assi[] = $tec_assist['id_tecnico'];
}

$ids_tecnicos_escolhidos = array_intersect($todos_ids_tec, $todos_ids_assi); //dá os valores iguais dos arrays
/* echo "<pre>";
  print_r($ids_tecnicos_escolhidos);
  echo "</pre>";

  foreach ($tecnicos as $tecnico) { //verificar se id é o mesmo
  if (in_array($tecnico['codigo'], $ids_tecnicos_escolhidos)) {
  echo 'sim';
  }
  } */
?>
<form class="form_modalAssign" method="POST">
    <h4>Atribuir Asistência</h4><br>
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">person_add</i>
            <select multiple name="tecnicos" id="tecnicos">
                <option disabled>Choose your option</option>
                <?php
                foreach ($tecnicos as $tecnico) {
                    echo '<option value="' . $tecnico['codigo'] . '"' . (in_array($tecnico['codigo'], $ids_tecnicos_escolhidos) ? 'selected="selected"' : '') . '>' . $tecnico['nome'] . '</option>';
                }
                ?>
            </select>
            <label for="icon_prefix">Técnico</label>
        </div>

    </div>

    <div class="row">
        <div class="col s6">
            <label for="icon_prefix">Dia</label>
            <input type="text" class="datepicker">
        </div>
        <div class="col s6">
            <label for="icon_prefix">Hora</label>
            <input type="text" class="timepicker">
        </div>
    </div>

</form>
<script> $(document).ready(function () {
        $("select").material_select();
        Materialize.updateTextFields();
        $('.collapsible').collapsible();

        $('.datepicker').pickadate({
            monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'],
            weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            weekdaysShort: ['dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab'],
            weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            format: 'd !de mmmm !de yyyy',
            formatSubmit: 'yyyy/mm/dd',

            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Hoje',
            clear: 'Apagar',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
        });

        $('.timepicker').pickatime({

            default: 'now', // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Apagar', // text for clear-button
            canceltext: 'Cancelar', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function () {} //Function for after opening timepicker
        });

    });
</script>