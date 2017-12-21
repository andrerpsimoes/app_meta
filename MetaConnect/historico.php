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

                            <h3 class="center">Histórico</h3>

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
                                    <div id="data_container">
                                        <!-- dados cliente -->
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <div id="bar_info">
                                        <!-- dados analise/projetos/levantamentos/assistencias -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <?php include 'php/infogeral/navDireita.php'; ?>
            </div>
        </div>


        <!-- Modal Info Assistencia-->
        <div id="infoAssist_modal" class="modal" style="width: 80%; height: 80%;">
            <div class="modal-content" id="content_infoAssist">
            </div>
        </div>
        
        <!-- Modal Info Levantamento-->
        <div id="infoLev_modal" class="modal" style="width: 80%; height: 80%;">
            <div class="modal-content" id="content_infoLev">
            </div>
        </div>
        
        <!-- Modal Info Projeto -->
        <div id="infoProj_modal" class="modal" style="width: 80%; height: 80%;">
            <div class="modal-content" id="content_infoProj">
            </div>
        </div>

        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>

        <script>

            var historico = {

                //********variaveis globais********

                MensagemErro: "Ocorreu um erro, por favor contacte o administrador do sistema.",
                idservico: 0,
                //********Fim variaveis globais********


                analise: function () {
                    //alert("analise");
                    //graficos
                    $('#bar_info').html('Dashboard');
                },

                projetos: function () {

                    var cliente = $("#autocomplete-input").val();
                    var id_cliente = cliente.substr(0, cliente.indexOf(' '));
                    //alert(id_cliente);
                    $.ajax({

                        type: "POST",
                        data: {id_cliente: id_cliente},
                        url: 'php/Historico/projetos.php',
                        success: function (response) {

                            $('#bar_info').html(response);

                        },
                        error: function () {
                            alert(historico.MensagemErro);
                        }
                    });

                },

                levantamentos: function () {
                    //alert("levantamentos");
                    var cliente = $("#autocomplete-input").val();
                    var id_cliente = cliente.substr(0, cliente.indexOf(' '));
                    //alert(id_cliente);
                    $.ajax({

                        type: "POST",
                        data: {id_cliente: id_cliente},
                        url: 'php/Historico/levantamentos.php',
                        success: function (response) {

                            $('#bar_info').html(response);

                        },
                        error: function () {
                            alert(historico.MensagemErro);
                        }
                    });
                },

                assistencias: function () {
                    //alert("asssistencias");
                    var cliente = $("#autocomplete-input").val();
                    var id_cliente = cliente.substr(0, cliente.indexOf(' '));
                    //alert(id_cliente);
                    $.ajax({

                        type: "POST",
                        data: {id_cliente: id_cliente},
                        url: 'php/Historico/assistencias.php',
                        success: function (response) {

                            $('#bar_info').html(response);

                        },
                        error: function () {
                            alert(historico.MensagemErro);
                        }
                    });
                },

                infoAssist: function (id_assist) {
                    historico.idservico = id_assist.closest('tr').attr('id');

                    $.ajax({
                        type: "POST",
                        data: {id_servico: historico.idservico},
                        url: 'php/Historico/infoAssist.php',
                        success: function (response) {
                            $('#content_infoAssist').html(response);
                        },
                        error: function () {
                            alert(gestaoAssistencia.MensagemErro);
                        }
                    });
                    $('#infoAssist_modal').modal('open');

                },

                infoLev: function (id_lev) {
                    historico.idservico = id_lev.closest('tr').attr('id');
                    
                    $.ajax({
                        type: "POST",
                        data: {id_servico: historico.idservico},
                        url: 'php/Historico/infoLev.php',
                        success: function (response) {
                            $('#content_infoAssist').html(response);
                        },
                        error: function () {
                            alert(gestaoAssistencia.MensagemErro);
                        }
                    });
                    $('#infoLev_modal').modal('open');
                },

                infoProj: function (id_proj) {
                    historico.idservico = id_proj.closest('tr').attr('id');
                    
                    $.ajax({
                        type: "POST",
                        data: {id_servico: historico.idservico},
                        url: 'php/Historico/infoProj.php',
                        success: function (response) {
                            $('#content_infoAssist').html(response);
                        },
                        error: function () {
                            alert(gestaoAssistencia.MensagemErro);
                        }
                    });
                    $('#infoProj_modal').modal('open');
                },

                init: function () {

                    $('select').material_select();
                    $('.modal').modal();
                    $('#BtnProj').tooltip({delay: 50});
                    $('.collapsible').collapsible();
                    $('textarea').characterCounter();
                    $('ul.tabs').tabs();


                    $.ajax({
                        url: "php/getClientes.php",
                        dataType: "json",
                        success: function (pData) {

                            var jsonObj = {};

                            for (var i = 0; i < pData.length; i++) {

                                jsonObj[pData[i]["intCodigo"] + " - " + pData[i]["strNome"]] = null;
                            }

                            $('#autocomplete-input').autocomplete({
                                data: jsonObj,
                                limit: 5,
                                onAutocomplete: function (val) {

                                    var id_cliente = val.substr(0, val.indexOf(' '));
                                    $.ajax({

                                        type: "POST",
                                        data: {id_cliente: id_cliente},
                                        url: 'php/getInfoCliente.php',
                                        success: function (response) {

                                            var arr = $.parseJSON(response);
                                            var obj = {
                                                morada: arr[0].strMorada_lin1,
                                                localidade: arr[0].strLocalidade,
                                                codPostal: arr[0].strPostal,
                                                numContrib: arr[0].strNumContrib,
                                                telefone: arr[0].strTelefone
                                            };

                                            $.ajax({

                                                type: "POST",
                                                data: obj,
                                                url: 'php/Historico/dadosCliente.php',
                                                success: function (response) {
                                                    $('#bar_info').html('');
                                                    $('#data_container').html(response);

                                                },
                                                error: function () {
                                                    alert(historico.MensagemErro);
                                                }
                                            });

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

                historico.init();
                /*
                 $('#autocomplete-input').change(function () {
                 historico.inputChange();
                 });*/

                $(document).on("click", "#analise", function () {
                    historico.analise();
                });

                $(document).on("click", "#projetos", function () {
                    historico.projetos();
                });

                $(document).on("click", "#levantamentos", function () {
                    historico.levantamentos();
                });

                $(document).on("click", "#assistencias", function () {
                    historico.assistencias();
                });

                $(document).on("click", "a[name='BtnInfoAssist']", function () {
                    var id_assist = $(this);
                    historico.infoAssist(id_assist);
                });

                $(document).on("click", "a[name='BtnInfoLev']", function () {
                    var id_lev = $(this);
                    historico.infoLev(id_lev);
                });

                $(document).on("click", "a[name='BtnInfoProj']", function () {
                    var id_proj = $(this);
                    historico.infoProj(id_proj);
                });

            });
        </script>
    </body>
</html>