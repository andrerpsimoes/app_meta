<?php
include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
if (isset($_GET['logout'])) {
    session_destroy();
    header("Refresh:0");
}

include 'configs/config.php'; //meta DB

//total serviços
$servico = $conn_meta->prepare("select count(id) from servico");
$servico->execute();
$n_servico = $servico->fetch();
$total_servicos = $n_servico[0];

//total projetos
$projeto = $conn_meta->prepare("select count(id) from projeto");
$projeto->execute();
$n_projeto = $projeto->fetch();
$total_projetos = $n_projeto[0];

//total levantamentos
$levantamento = $conn_meta->prepare("select count(id) from servico where tipo_servico = 1");
$levantamento->execute();
$n_levantamento = $levantamento->fetch();
$total_levantamentos = $n_levantamento[0];

//total assistencias
$assistencia = $conn_meta->prepare("select count(id) from servico where tipo_servico = 2");
$assistencia->execute();
$n_assistencia = $assistencia->fetch();
$total_assistencia = $n_assistencia[0];

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

                    <div class="row">
                        <div class="col s4 offset-s4">
                            <div class="card red darken-3">
                                <div class="card-content white-text">
                                    <span class="card-title" style="color: black;text-align: center;"><b>Guias de Serviço</b></span>
                                    <h4 class="card-stats-number center"><?php echo $total_servicos;?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s4 offset-s1">
                            <div class="card orange darken-3">
                                <div class="card-content white-text">
                                    <span class="card-title" style="color: black;text-align: center;"><b>Guias de Levantamento</b></span>
                                    <h4 class="card-stats-number center"><?php echo $total_levantamentos;?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col s4 offset-s2">
                            <div class="card yellow darken-3">
                                <div class="card-content white-text">
                                    <span class="card-title" style="color: black;text-align: center;"><b>Guias de Assistência</b></span>
                                    <h4 class="card-stats-number center"><?php echo $total_assistencia;?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col s4 offset-s4">
                            <div class="card green darken-3">
                                <div class="card-content white-text">
                                    <span class="card-title" style="color: black;text-align: center;"><b>Projetos</b></span>
                                    <h4 class="card-stats-number center"><?php echo $total_projetos;?></h4>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
                <!-- END CONTENT -->


                <?php include 'php/infogeral/navDireita.php'; ?>
            </div>
        </div>

        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>
    </body>
</html>