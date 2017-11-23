<?php
include 'configs/config2.php'; // eticadata DB

include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
     session_destroy();
     header("Refresh:0");
  }

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'php/infogeral/header.php'; ?>
    </head>
    <body>
        <?php include 'php/infogeral/navSuperior.php'; ?>


        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">

                <?php include 'php/infogeral/navEsquerda.php'; ?>

                <!-- START CONTENT -->
                <section id="content">
                    <div class="container">


                        <div class="row">
                            <form class="col s12" method="POST" id="formId" style="margin-top: 50px; margin-bottom: 50px;">


                                <div class="row">
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">perm_identity</i>
                                                <input type="text" name="nome_cliente" id="autocomplete-input" class="autocomplete" required>
                                                <label for="autocomplete-input">Cliente</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix" style="color: lightgray;">home</i>
                                        <input id="morada" name="morada" placeholder="" type="text" readonly>
                                        <label for="first_name">Morada</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix" style="color: lightgray;">gps_fixed</i>
                                        <input id="localidade" name="localidade" placeholder="" type="text" readonly>
                                        <label for="first_name">Localidade</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix" style="color: lightgray;">call</i>
                                        <input id="telefone" name="telefone" type="text" placeholder="" class="validate" readonly>
                                        <label for="first_name">Telefone</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix" style="color: lightgray;">label_outline</i>
                                        <input id="cod_postal" name="cod_postal" type="text" placeholder="" class="validate" readonly>
                                        <label for="first_name">Código Postal</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix" style="color: lightgray;">assignment_ind</i>
                                        <input id="contribuinte" name="contribuinte" type="text" placeholder="" class="validate" readonly>
                                        <label for="first_name">Contribuinte</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">perm_identity</i>
                                        <input id="pedidopor" type="text" class="validate" required>
                                        <label for="icon_prefix">Pedido por:</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">priority_high</i>
                                        <select name="area" id="prioridade">
                                            <option value="" disabled selected>Escolha a prioridade</option>
                                            <option value="1">Baixa</option>
                                            <option value="2">Média</option>
                                            <option value="3">Alta</option>
                                        </select>
                                        <label for="icon_prefix">Prioridade</label>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col s4">
                                        <div class="switch">
                                            <i class="material-icons prefix">build</i>
                                            <label for="first_name" style="font-size: 20px;color: black;">Projeto</label>
                                            <label style="font-size: 20px;color: black;">
                                                Não
                                                <input type="checkbox">
                                                <span class="lever"></span>
                                                Sim
                                            </label>
                                        </div>
                                    </div>
                                </div><br>

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
                                        <textarea id="observacoes" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Observações</label>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <a class="btn waves-effect waves-light right"  id="BtnAssist">Criar Assistencia
                                            <i class="material-icons right">send</i>
                                        </a>
                                    </div>
                                </div>

                            </form> 
                        </div>
                    </div>

                </section>

                <?php include 'php/infogeral/navDireita.php'; ?>
            </div>
        </div>

        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>

        <script>
            var levantamento={
              
                butaoSubmit: function(){
                  debugger;
                  var selected = [];
                    $('#accordion input:checked').each(function() {
                        selected.push($(this).attr('value'));
                    });
                    
                    
                    
                     var dados = {
                        id_cliente: valortextCliente.substr(0, valortextCliente.indexOf(' ')),
                        pedido_por: $("#pedidopor").val(),
                        prioridade: $("#prioridade").val(),
                        zona: $("#zona").val(),
                        local: $("#local").val(),
                        contacto_responsavel: $("#contacto_responsavel").val(),
                        observacoes: $("#observacoes").val(),
                        selecionados: selected
                    };

                    if (!dados.pedido_por || !dados.prioridade || !dados.zona || !dados.local || !dados.contacto_responsavel || !dados.observacoes) {
                        alert("Preencha todos os campos! Toast!!");

                    } else {

                        $.ajax({

                            type: "POST",
                            data: dados,
                            url: 'php/Levantamentos/insertLevant.php',
                            success: function (response) {
                                debugger;
                                var arr = $.parseJSON(response);

                                var id_lastLevantamento = arr.id_levantamento;
                                var id_cliente = arr.id_cliente;

                                var ids_pdf = {
                                    id_lastLevantamento: id_lastLevantamento,
                                    id_cliente: id_cliente
                                };

                                window.open('http://localhost:82/1904/MetaConnect/php/levantamentos/levantamentopdf.php?a=' + id_lastLevantamento + '&b=' + id_cliente, '_blank');




                            },
                            error: function () {
                                alert("nao deu");
                            }
                        });
                        $("#formId")[0].reset()

                    }
                    
                    alert(selected);
                    /*
                    var mobiliario = $('#mobiliario').is(":checked") ? mobiliario = $('#mobiliario').val() : mobiliario = null;
                    var copia_imp = $('#copia_imp').is(":checked") ? copia_imp = $('#copia_imp').val() : copia_imp = null;
                    var video_proj = $('#video_proj').is(":checked") ? video_proj = $('#video_proj').val() : video_proj = null;
                    var video_conf = $('#video_conf').is(":checked") ? video_conf = $('#video_conf').val() : video_conf = null;
                    var audio = $('#audio').is(":checked") ? audio = $('#audio').val() : audio = null;
                    var equipamento = $('#equipamento').is(":checked") ? equipamento = $('#equipamento').val() : equipamento = null;
                    var relogio_ponto = $('#relogio_ponto').is(":checked") ? relogio_ponto = $('#relogio_ponto').val() : relogio_ponto = null;
                    var erp = $('#erp').is(":checked") ? erp = $('#erp').val() : erp = null;
                    var ups = $('#ups').is(":checked") ? ups = $('#ups').val() : ups = null;
                    var servidor = $('#servidor').is(":checked") ? servidor = $('#servidor').val() : servidor = null;
                    var switch_r = $('#switch').is(":checked") ? switch_r = $('#switch').val() : switch_r = null;
                    var router = $('#router').is(":checked") ? router = $('#router').val() : router = null;
                    var wifi = $('#wifi').is(":checked") ? wifi = $('#wifi').val() : wifi = null;
                    var radio_comun = $('#radio_comun').is(":checked") ? radio_comun = $('#radio_comun').val() : radio_comun = null;
                    var central_tel = $('#central_tel').is(":checked") ? central_tel = $('#central_tel').val() : central_tel = null;
                    var coaxial = $('#coaxial').is(":checked") ? coaxial = $('#coaxial').val() : coaxial = null;
                    var cobre = $('#cobre').is(":checked") ? cobre = $('#cobre').val() : cobre = null;
                    var fibra_otica = $('#fibra_otica').is(":checked") ? fibra_otica = $('#fibra_otica').val() : fibra_otica = null;
                    var bastidores = $('#bastidores').is(":checked") ? bastidores = $('#bastidores').val() : bastidores = null;
                    var medidas_auto = $('#medidas_auto').is(":checked") ? medidas_auto = $('#medidas_auto').val() : medidas_auto = null;
                    var portas_cf = $('#portas_cf').is(":checked") ? portas_cf = $('#portas_cf').val() : portas_cf = null;
                    var compartimentacao = $('#compartimentacao').is(":checked") ? compartimentacao = $('#compartimentacao').val() : compartimentacao = null;
                    var desenfumagem = $('#desenfumagem').is(":checked") ? desenfumagem = $('#desenfumagem').val() : desenfumagem = null;
                    var extincao_agua = $('#extincao_agua').is(":checked") ? extincao_agua = $('#extincao_agua').val() : extincao_agua = null;
                    var extincao_auto = $('#extincao_auto').is(":checked") ? extincao_auto = $('#extincao_auto').val() : extincao_auto = null;
                    var sinalizacao_seg = $('#sinalizacao_seg').is(":checked") ? sinalizacao_seg = $('#sinalizacao_seg').val() : sinalizacao_seg = null;
                    var extintores = $('#extintores').is(":checked") ? extintores = $('#extintores').val() : extintores = null;
                    var sadg = $('#sadg').is(":checked") ? sadg = $('#sadg').val() : sadg = null;
                    var sadir = $('#sadir').is(":checked") ? sadir = $('#sadir').val() : sadir = null;
                    var sadi = $('#sadi').is(":checked") ? sadi = $('#sadi').val() : sadi = null;
                    var cctv = $('#cctv').is(":checked") ? cctv = $('#cctv').val() : cctv = null;
                    var controlo_acesso = $('#controlo_acesso').is(":checked") ? controlo_acesso = $('#controlo_acesso').val() : controlo_acesso = null;


                    var dados = {
                        pedido_por: $("#pedidopor").val(),
                        prioridade: $("#prioridade").val(),
                        zona: $("#zona").val(),
                        local: $("#local").val(),
                        contacto_responsavel: $("#contacto_responsavel").val(),
                        observacoes: $("#observacoes").val()
                    };


                    if (!dados.pedido_por || !dados.prioridade || !dados.zona || !dados.local || !dados.contacto_responsavel || !dados.observacoes) {
                        alert("Preencha todos os campos! Toast!!");

                    } else {

                        var valortextCliente = $("#autocomplete-input").val(),
                                data = {
                                    id_cliente: valortextCliente.substr(0, valortextCliente.indexOf(' ')),
                                    pedido_por: $("#pedidopor").val(),
                                    prioridade: $("#prioridade").val(),
                                    zona: $("#zona").val(),
                                    local: $("#local").val(),
                                    contacto_responsavel: $("#contacto_responsavel").val(),
                                    observacoes: $("#observacoes").val(),
                                    mobiliario: mobiliario,
                                    copia_imp: copia_imp,
                                    video_proj: video_proj,
                                    video_conf: video_conf,
                                    audio: audio,
                                    equipamento: equipamento,
                                    relogio_ponto: relogio_ponto,
                                    erp: erp,
                                    ups: ups,
                                    servidor: servidor,
                                    switch_r: switch_r,
                                    router: router,
                                    wifi: wifi,
                                    radio_comun: radio_comun,
                                    central_tel: central_tel,
                                    coaxial: coaxial,
                                    cobre: cobre,
                                    fibra_otica: fibra_otica,
                                    bastidores: bastidores,
                                    medidas_auto: medidas_auto,
                                    portas_cf: portas_cf,
                                    compartimentacao: compartimentacao,
                                    desenfumagem: desenfumagem,
                                    extincao_agua: extincao_agua,
                                    extincao_auto: extincao_auto,
                                    sinalizacao_seg: sinalizacao_seg,
                                    extintores: extintores,
                                    sadg: sadg,
                                    sadir: sadir,
                                    sadi: sadi,
                                    cctv: cctv,
                                    controlo_acesso: controlo_acesso
                                };

                        $.ajax({

                            type: "POST",
                            data: data,
                            url: 'php/Levantamentos/insertLevant.php',
                            success: function (response) {
                                debugger;
                                var arr = $.parseJSON(response);

                                var id_lastLevantamento = arr.id_levantamento;
                                var id_cliente = arr.id_cliente;

                                var ids_pdf = {
                                    id_lastLevantamento: id_lastLevantamento,
                                    id_cliente: id_cliente
                                };

                                window.open('http://localhost:82/1904/MetaConnect/php/levantamentos/levantamentopdf.php?a=' + id_lastLevantamento + '&b=' + id_cliente, '_blank');




                            },
                            error: function () {
                                alert("nao deu");
                            }
                        });
                        $("#formId")[0].reset()

                    }*/
                }
              
            };
            $(document).ready(function () {
<?php include 'js/getclientes.js'; ?>;
                $('.collapsible').collapsible();
               

                $("#BtnAssist").click(function () {
                     levantamento.butaoSubmit();

                });




            });
        </script>

    </body>
</html>