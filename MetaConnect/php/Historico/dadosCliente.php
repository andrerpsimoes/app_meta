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


$morada = $_POST['morada'];
$localidade = $_POST['localidade'];
$codPostal = $_POST['codPostal'];
$numContrib = $_POST['numContrib'];
$telefone = $_POST['telefone'];
?>

<div class="row">
    <div class="input-field col s6">
        <i class="material-icons prefix" style="color: lightgray;">home</i>
        <input id="morada" name="morada" placeholder="" value="<?php echo $morada; ?>" type="text" readonly>
        <label class="active" for="first_name">Morada</label>
    </div>

    <div class="input-field col s6">
        <i class="material-icons prefix" style="color: lightgray;">gps_fixed</i>
        <input id="localidade" name="localidade" placeholder="" value="<?php echo $localidade; ?>" type="text" readonly>
        <label class="active" for="first_name">Localidade</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s4">
        <i class="material-icons prefix" style="color: lightgray;">call</i>
        <input id="telefone" name="telefone" type="text" value="<?php echo $telefone; ?>" placeholder="" readonly>
        <label class="active" for="first_name">Telefone</label>
    </div>
    <div class="input-field col s4">
        <i class="material-icons prefix" style="color: lightgray;">label_outline</i>
        <input id="cod_postal" name="cod_postal" type="text" value="<?php echo $codPostal; ?>" placeholder="" readonly>
        <label class="active" for="first_name">Código Postal</label>
    </div>
    <div class="input-field col s4">
        <i class="material-icons prefix" style="color: lightgray;">assignment_ind</i>
        <input id="contribuinte" name="contribuinte" type="text" value="<?php echo $numContrib; ?>" placeholder="" readonly>
        <label class="active" for="first_name">Contribuinte</label>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <ul class="tabs" id="tabs"  style="background-color: #e0e0e0; border-radius: 15px;">
            <li class="tab col s3" id="analise" style="cursor:pointer;"><a class="active">Análise</a></li>
            <li class="tab col s3" id="projetos" style="cursor:pointer;"><a>Projetos</a></li>
            <li class="tab col s3" id="levantamentos" style="cursor:pointer;"><a>Levantamentos</a></li>
            <li class="tab col s3" id="assistencias" style="cursor:pointer;"><a>Assistências</a></li>
        </ul>
    </div>
</div>

<div class="row" id="rowsearch">
    <div class="input-field col s4">
        <i class="material-icons prefix">search</i>
        <input type="text" class="form-control" id="search">
        <label for="icon_prefix">Procurar</label>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('ul.tabs').tabs();
        historico.analise();
    });
</script>

