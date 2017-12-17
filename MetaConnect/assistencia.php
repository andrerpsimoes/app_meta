<?php
  include("restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  }


include 'configs/config2.php'; // eticadata DB
include 'configs/config.php'; //meta DB

 
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'php/infogeral/header.php'; ?>
    </head>
    <body>
        <?php include 'php/infogeral/navSuperior.php'; ?>

 <?php include 'php/infogeral/navEsquerda.php'; ?>
        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">

               

                <!-- START CONTENT -->
                <section id="content">
                    <div class="container">


                        <div class="row">
                            
                            <h3 class="center">Assistência</h3>
                            
                            <form class="col s12" method="POST" id="formId" style=" margin-bottom: 50px;">

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
                                    <div class="col s12">
                                        <div class="switch col s4">
                                            <i class="material-icons prefix">build</i>
                                            <label for="first_name" style="font-size: 17px;color: black;">Projeto</label>
                                            <label style="font-size: 17px;color: black;">
                                                Não
                                                <input type="checkbox" name="checkboxproj" id="proj_check" value="sim">
                                                <span class="lever"></span>
                                                Sim
                                            </label>
                                        </div>
                                        <div class="col s4">
                                            <div class="form-select" id="selectproj" style="display: none;">
                                            </div>
                                        </div>

                                        <div class="col s4">
                                            <a class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-delay="5" data-tooltip="Criar Projeto" id="BtnProj" style="display: none;">
                                                <i class="material-icons">add</i></a>
                                        </div>
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

                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">textsms</i>
                                        <textarea id="observacoes" class="materialize-textarea" maxlength="500" data-length="500"></textarea>
                                        <label for="observacoes">Observações</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <a class="btn waves-effect waves-light right" id="BtnAssist">Criar Assistencia
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

        <!-- Modal Structure -->
        <section id="content">
            <div class="container">


                <div class="row">
                    <div id="modal1" class="modal ">
                        <div class="modal-content">
                            <form class="form_modal" method="POST">
                                <h4>Novo Projeto</h4>
                                <div class="row">
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">build</i>
                                                <input type="text" name="descricao" id="descricao" class="validate" required>
                                                <label for="first_name">Descrição</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">perm_identity</i>
                                                <input type="text" name="pessoa_responsavel" id="pessoa_responsavel" class="validate" required>
                                                <label for="first_name">Pessoa Responsável</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">perm_identity</i>
                                                <input type="text" name="local" id="local" class="validate" required>
                                                <label for="first_name">Local</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s6">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">perm_identity</i>
                                                <input type="text" name="contacto_responsavel" id="contacto_responsavel" class="validate" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                                <label for="first_name">Contacto Responsável</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" type="submit" name="BtnModal" id="BtnModal">Criar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>

        <script>

            var assistencia={
                
              //********variaveis globais********
                
              MensagemErro:"Ocorreu um erro, por favor contacte o administrador do sistema.",  
                
                
              //********Fim variaveis globais********
                
              atualizaProjetos: function (){
                  
                    if ($('#proj_check:checkbox:checked').length>0) {
                        var cliente = $("#autocomplete-input").val(),
                            data_to_select = {
                                id_cliente: cliente.substr(0, cliente.indexOf(' '))
                            };

                        $.ajax({
                            type: "POST",
                            data: data_to_select,
                            url: 'php/Projetos/selectProjeto.php',
                            success: function (response) {
                                $('#selectproj').html(response);
                            },
                            error: function () {
                                alert(assistencia.MensagemErro);
                            }
                        });
                    }
                  
                  
              },
              
              
              //botao de submit
                butaoSubmit: function(){
                    var selected = [],
                        cliente = $("#autocomplete-input").val();
                    $('#accordion input:checked').each(function() {
                        selected.push($(this).attr('value'));
                    });
                    
                    var dados = {
                        id_cliente: cliente.substr(0, cliente.indexOf(' ')),
                        pedido_por: $("#pedidopor").val(),
                        prioridade: $("#prioridade").val(),
                        observacoes: $("#observacoes").val()
                    };


                    if (!dados.id_cliente || !dados.pedido_por || !dados.prioridade || !dados.observacoes) {
                        Materialize.toast('Preencha todos os campos!', 3000, 'rounded');

                    } else {

                        var valortextCliente = $("#autocomplete-input").val(),
                                data = {
                                    id_cliente: valortextCliente.substr(0, valortextCliente.indexOf(' ')),
                                    id_projeto: $("#select").val(),
                                    pedido_por: $("#pedidopor").val(),
                                    prioridade: $("#prioridade").val(),
                                    observacoes: $("#observacoes").val(),
                                    selecionados: selected
                                };
                        
                        $.ajax({

                            type: "POST",
                            data: data,
                            url: 'php/Assistencias/insertAssist.php',
                            success: function (response) {
                                var arr = $.parseJSON(response);
                                window.open('http://localhost:82/1904/MetaConnect/php/assistencias/pdfAssistencia.php?a=' + arr.id_assistencia, '_blank');
                            },
                            error: function () {
                                alert(assistencia.MensagemErro);
                            }
                        });
                        $("#formId")[0].reset();
                    }
                    
                },
                
                inputChange:function() {
                    
                   if ($('#proj_check:checkbox:checked').length>0) {
                        $('#selectproj').toggle(this.checked);
                        $('#BtnProj').toggle();
                    } else {
                        $('#selectproj').toggle();
                        $('#BtnProj').toggle();
                    }

                    assistencia.atualizaProjetos(); //chamamos a funcao de atualizar projetos

                },
                
                botaoModal: function() {
                      var dados_modal = {
                        descricao: $("#descricao").val(),
                        pessoa_responsavel: $("#pessoa_responsavel").val(),
                        contacto_responsavel: $("#contacto_responsavel").val(),
                        local: $("#local").val()
                    };

                    if (!dados_modal.descricao || !dados_modal.pessoa_responsavel || !dados_modal.contacto_responsavel || !dados_modal.local) {
                        Materialize.toast('Preencha todos os campos!', 3000, 'rounded');
                    } else {

                        var cliente = $("#autocomplete-input").val(),
                            info_modal = {
                                id_cliente: cliente.substr(0, cliente.indexOf(' ')),
                                descricao: $("#descricao").val(),
                                pessoa_responsavel: $('#pessoa_responsavel').val(),
                                contacto_responsavel: $('#contacto_responsavel').val(),
                                local: $('#local').val()
                            };
                        
                        $.ajax({
                            type: "POST",
                            data: info_modal,
                            url: 'php/Projetos/insertProj_modal.php',
                            success: function (response) {
                                var state = $.parseJSON(response);

                                if (state.success == true) {
                                    Materialize.toast('Projeto criado com sucesso!', 3000, 'rounded');

                                    assistencia.atualizaProjetos();

                                } else {
                                    Materialize.toast('Não foi possível criar projeto!', 3000, 'rounded');
                                }
                            },
                            error: function () {
                                alert(assistencia.MensagemErro);
                            }
                        });
                    }
                },
                
                botaoProjeto: function (){
                    
                    var valortextCliente = $("#autocomplete-input").val(),
                        idcliente=valortextCliente.substr(0, valortextCliente.indexOf(' '));
                   
                    if (!idcliente) {
                        Materialize.toast('Preencha corretamento o campo cliente!', 3000, 'rounded');
                    } else {
                        $('#modal1').modal('open');
                    }
                },
                
                
                init:function (){
                    
                    $('select').material_select();
                    $('#modal1').modal();
                    $('#BtnProj').tooltip({delay: 50});
                    $('.collapsible').collapsible();
                    $('textarea').characterCounter();

                
                    $.ajax({
                        url:"php/getClientes.php",
                        dataType: "json",
                        success: function (pData) {

                            var jsonObj = {};

                            for (var i=0; i< pData.length; i++){

                                jsonObj[pData[i]["intCodigo"]+" - "+pData[i]["strNome"]] = null;
                            }

                            $('#autocomplete-input').autocomplete({
                                data: jsonObj,
                                limit: 5,
                                 onAutocomplete: function(val) {
                                     var id_cliente =val.substr(0,val.indexOf(' '));
                                      
                                       $.ajax({

                                               type: "POST",
                                               data: { id_cliente : id_cliente },
                                               url:'php/getInfoCliente.php',
                                                success: function (response) {
                                                   
                                                   var arr = $.parseJSON(response);
                                                   $("#morada").val(arr[0].strMorada_lin1);
                                                   $("#localidade").val(arr[0].strLocalidade);
                                                   $("#cod_postal").val(arr[0].strPostal);
                                                   $("#contribuinte").val(arr[0].strNumContrib);
                                                   $("#telefone").val(arr[0].strTelefone);
                                                   assistencia.atualizaProjetos();
                                               },
                                               error: function () {
                                                  alert(assistencia.MensagemErro);
                                               }
                                       });

                                }
                            });
                        }
                    });

                }
                
            };




            $(document).ready(function () {

                assistencia.init();
           
                $('#BtnProj').click(function (){
                    assistencia.botaoProjeto();
                });

                $('input[name=checkboxproj]:checkbox').change(function (e) {
                    assistencia.inputChange(e);
                });

                $("#BtnModal").click(function () {
                   assistencia.botaoModal();
                });

                $("#BtnAssist").click(function () {
                   assistencia.butaoSubmit();
                });
            });
        </script>
    </body>
</html>