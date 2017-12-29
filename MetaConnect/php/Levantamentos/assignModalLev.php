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

$sql_tec_assist = $conn_meta->prepare("select id_tecnico, data_inicio, data_fim from tecnico_servico where id_servico='" . $id_servico . "'");
$sql_tec_assist->execute();
$tecnicos_assistencia = $sql_tec_assist->fetchAll();

//se já existir algum tecn atribuido e datas
if (!empty($tecnicos_assistencia)) {

//Data BD
    foreach ($tecnicos_assistencia as $tecnicos_assist) {
        $tecnicos_assist['data_inicio'] . '<br>';
        $tecnicos_assist['data_fim'];
    }

    $datetimeFromSql_ini = $tecnicos_assist['data_inicio'];
    $time_ini = strtotime($datetimeFromSql_ini);
    $myFormatForView_ini = date("Y/m/d H:i", $time_ini);

    $data_ini = explode(' ', $myFormatForView_ini);
    $dia_ini = $data_ini[0];
    $hora_ini = $data_ini[1];

    $datetimeFromSql_fin = $tecnicos_assist['data_fim'];
    $time_fin = strtotime($datetimeFromSql_fin);
    $myFormatForView_fin = date("Y/m/d H:i", $time_fin);

    $data_fin = explode(' ', $myFormatForView_fin);
    $dia_fin = $data_fin[0];
    $hora_fin = $data_fin[1];
} else {// se nao existir tec atribuido e datas
    $dia_ini = '';
    $hora_ini = '';
    $dia_fin = '';
    $hora_fin = '';
}

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
    <h4>Atribuir Levantamento</h4><br>
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">person_add</i>
            <select multiple name="tecnicos" id="tecnicos">
                <option disabled>Escolha o(s) Técnico(s)</option>
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
            <label for="icon_prefix">Dia Inicial</label>
            <input type="text" class="datepicker" id="day_ini" value="<?php echo $dia_ini; ?>">
        </div>
        <div class="col s6">
            <label for="icon_prefix">Hora Inicial</label>
            <input type="text" class="timepicker" id="hour_ini" value="<?php echo $hora_ini; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col s6">
            <label for="icon_prefix">Dia Final</label>
            <input type="text" class="datepicker" id="day_fin" value="<?php echo $dia_fin; ?>">
        </div>
        <div class="col s6">
            <label for="icon_prefix">Hora Final</label>
            <input type="text" class="timepicker" id="hour_fin" value="<?php echo $hora_fin; ?>">
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
            //format: 'd !de mmmm !de yyyy',
            format: 'yyyy/mm/dd',
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