<?php
include 'configs/config2.php'; // eticadata DB
include 'configs/config.php'; //meta DB
/*
  include("restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  }
 */
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
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">build</i>
                                        <input id="descricao" type="text" class="validate" required>
                                        <label for="first_name">Descrição</label>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">person</i>
                                        <input id="responsavel" type="text" class="validate">
                                        <label for="first_name">Pessoa Responsável</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">contact_phone</i>
                                        <input id="contacto_responsavel" type="text" class="validate">
                                        <label for="first_name">Contacto Responsável</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <i class="material-icons prefix">place</i>
                                        <input id="local" type="text" class="validate">
                                        <label for="first_name">Local</label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="input-field col s12">
                                        <a class="btn waves-effect waves-light right" id="BtnProj">Criar Projeto
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

                $("#BtnProj").click(function () {
                    debugger;
                    var cliente = $("#autocomplete-input").val();
                    var info_proj = {
                        id_cliente: cliente.substr(0, cliente.indexOf(' ')), 
                        descricao: $("#descricao").val(),
                        pessoa_responsavel: $('#responsavel').val(),
                        contacto_responsavel: $('#contacto_responsavel').val(),
                        local: $('#local').val()
                    };
                    $.ajax({

                        type: "POST",
                        data: info_proj,
                        url: 'php/Projetos/insertProjeto.php',
                        success: function (response) {
                            debugger;
                            var state = $.parseJSON(response);
                            

                            if (state.success == true) {
                                Materialize.toast('Projeto criado com sucesso!', 3000, 'rounded');
                            } else {
                                Materialize.toast('Não foi possível criar projeto!', 3000, 'rounded');
                            }
                            ;

                        },
                        error: function () {
                            alert("nao deu");
                        }
                    });
                    $("#formId")[0].reset();

                });




            });
        </script>

    </body>
</html>