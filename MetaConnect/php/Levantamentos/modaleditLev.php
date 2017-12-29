<?php

  include("../../restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  } 

include '../../configs/config.php'; // MetaveiroAppTestes
include '../../configs/config2.php'; // eticadata DB


$id_servico = $_POST['id_servico'];

$sql_servicoInfo = $conn_meta->prepare("select prioridade, observacoes from servico where id='" . $id_servico . "'");
$sql_servicoInfo->execute();
$servicoInfo = $sql_servicoInfo->fetch();
?>
<form class="form_modalEdit" method="POST">
    <h4>Editar Levantamento</h4><br>
    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">priority_high</i>
            <select name="area" id="prioridade">
                <option value="1" <?php echo $servicoInfo['prioridade'] == "1" ? "selected" : ""; ?>>Baixa</option>
                <option value="2" <?php echo $servicoInfo['prioridade'] == "2" ? "selected" : ""; ?>>Média</option>
                <option value="3" <?php echo $servicoInfo['prioridade'] == "3" ? "selected" : ""; ?>>Alta</option>
            </select>
            <label for="icon_prefix">Prioridade</label>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <ul class="collapsible" data-collapsible="accordion" id="accordion">
                <li>
                    <div class="collapsible-header"><i class="material-icons">videocam</i>Segurança Eletrónica</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="col s4">
                                <input type="checkbox" id="controlo_acesso" value="23">
                                <label for="controlo_acesso">Controlo de Acesso</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="cctv" value="25">
                                <label for="cctv">CCTV</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="sadi" value="26">
                                <label for="sadi">SADI</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="sadir" value="27">
                                <label for="sadir">SADIR</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="sadg" value="24">
                                <label for="sadg">SADG</label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">security</i>Segurança contra Incêndios SCIE</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="col s4">
                                <input type="checkbox" id="extintores" value="28">
                                <label for="extintores">Extintores</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="sinalizacao_seg" value="30">
                                <label for="sinalizacao_seg">Sinalização de Segurança</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="extincao_auto" value="29">
                                <label for="extincao_auto">Extinção Automática</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="extincao_agua" value="31">
                                <label for="extincao_agua">Extinção por Água</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="desenfumagem" value="32">
                                <label for="desenfumagem">Desenfumagem</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="compartimentacao" value="33">
                                <label for="compartimentacao">Compartimentação</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="portas_cf" value="34">
                                <label for="portas_cf">Portas corta-fogo</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="medidas_auto" value="35">
                                <label for="medidas_auto">Medidas de Autoproteção</label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">device_hub</i>Telecomunicações</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="col s4">
                                <input type="checkbox" id="bastidores" value="36">
                                <label for="bastidores">Bastidores de Rede</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="fibra_otica" value="37">
                                <label for="fibra_otica">Fibra Ótica</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="cobre" value="38">
                                <label for="cobre">Cobre</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="coaxial" value="39">
                                <label for="coaxial">Coaxial</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="central_tel" value="40">
                                <label for="central_tel">Central Telefónica</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="radio_comun" value="41">
                                <label for="radio_comun">Rádio Comunicações</label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">router</i>Redes</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="col s4">
                                <input type="checkbox" id="wifi" value="42">
                                <label for="wifi">WiFi</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="router" value="43">
                                <label for="router">Router</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="switch" value="44">
                                <label for="switch">Switch</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="servidor" value="45">
                                <label for="servidor">Servidor</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="ups" value="46">
                                <label for="ups">UPS</label>
                            </div>
                        </div>

                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">devices</i>Informática</div>
                    <div class="collapsible-body">

                        <div class="row">
                            <div class="col s4">
                                <input type="checkbox" id="erp" value="47">
                                <label for="erp">ERP</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="relogio_ponto" value="48">
                                <label for="relogio_ponto">Relógio de Ponto</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="equipamento" value="49">
                                <label for="equipamento">Equipamento</label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">music_video</i>AudioVisuais</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="col s4">
                                <input type="checkbox" id="audio" value="50">
                                <label for="audio">Audio</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="video_conf" value="51">
                                <label for="video_conf">Video Conferência</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="video_proj" value="52">
                                <label for="video_proj">Video Projeção</label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">desktop_windows</i>Equipamento Escritório</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="col s4">
                                <input type="checkbox" id="copia_imp" value="53">
                                <label for="copia_imp">Cópia/Impressão</label>
                            </div>
                            <div class="col s4">
                                <input type="checkbox" id="mobiliario" value="54">
                                <label for="mobiliario">Mobiliário</label>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">textsms</i>
            <textarea id="observacoes" class="materialize-textarea active validate" maxlength="500"><?php echo htmlspecialchars($servicoInfo['observacoes']); ?></textarea>
            <label for="first_name2">Observações</label>
        </div>
    </div>

</form>
<script> $(document).ready(function () {
        $("select").material_select();
        Materialize.updateTextFields();
        $('.collapsible').collapsible();
    });
</script>