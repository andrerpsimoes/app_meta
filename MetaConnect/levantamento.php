<?php
include 'configs/config2.php'; // eticadata DB
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
                            <form class="col s12" method="POST" style="margin-top: 50px; margin-bottom: 50px;">


                                <div class="row">
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">perm_identity</i>
                                                <input type="text" name="nome_cliente" id="autocomplete-input" class="autocomplete">
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
                                        <input id="pedidopor" type="text" class="validate">
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
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <ul class="collapsible" data-collapsible="accordion">
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons">security</i>Segurança Eletrónica</div>
                                                <div class="collapsible-body"><span>Segurança Eletrónica</span></div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons">place</i>Segurança contra Incêndios SCIE</div>
                                                <div class="collapsible-body"><span></span>filhos</div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Telecomunicações</div>
                                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Redes</div>
                                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Informática</div>
                                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons">whatshot</i>AudioVisuais</div>
                                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                                            </li>
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons">whatshot</i>Equipamento Escritório</div>
                                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                                            </li>
                                        </ul>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">map</i>
                                        <select name="area" id="zona">
                                            <option value="" disabled selected>Escolha a zona</option>
                                            <option value="1">Norte</option>
                                            <option value="2">Centro</option>
                                            <option value="3">Sul</option>
                                        </select>
                                        <label for="icon_prefix">Zona</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">location_on</i>
                                        <input id="local" type="text" class="validate">
                                        <label for="icon_prefix">Local</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">smartphone</i>
                                        <input id="contacto_levantamento" type="text" class="validate">
                                        <label for="icon_prefix">Contacto Levantamento</label>
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

            $(document).ready(function () {
<?php include 'js/getclientes.js'; ?>;
                $('.collapsible').collapsible();


                $("#BtnAssist").click(function () {

                    var valortextCliente = $("#autocomplete-input").val(),
                            data = {
                                id_cliente: valortextCliente.substr(0, valortextCliente.indexOf(' ')),
                                pedido_por: $("#pedidopor").val(),
                                prioridade: $("#prioridade").val(),
                                zona: $("#zona").val(),
                                local: $("#local").val(),
                                contacto_levantamento: $("#contacto_levantamento").val(),
                                observacoes: $("#observacoes").val()
                            };
                    alert(JSON.stringify(data));
                    $.ajax({

                        type: "POST",
                        data: data,
                        url: 'php/assistencias/insertAssist.php',
                        success: function (response) {
                            alert(response);
                        },
                        error: function () {
                            alert("nao deu");
                        }
                    });
                });



            });
        </script>

    </body>
</html>