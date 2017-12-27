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

                    <div class="container" style="width: 25%;margin-top: 3%;">
                        <div class="row">
                            <div class="col s12 z-depth-4 card-panel">
                                <div class="row">
                                    <div class="input-field col s12 center">
                                        <img src="images/fotos/<?php echo $_SESSION["foto"]; ?>" alt="" class="circle responsive-img valign profile-image-login">
                                        <p class="center login-form-text">ServPro</p>
                                    </div>

                                    <h4 class="header center">Perfil</h4>
                                    <div id="profile-card" class="card">
                                        <div class="card-content">
                                            <div class="input-field">
                                                <span class="card-title activator grey-text text-darken-4"><b><?php echo $_SESSION["nome"]; ?></b></span>
                                            </div>
                                            <h5> <?php echo $_SESSION["departamento"]; ?></h5>
                                            <h5> <?php echo $_SESSION["telemovel"]; ?></h5>
                                            <h5> <?php echo $_SESSION["mail_metaveiro"]; ?></h5>
                                            <h5> <?php echo $_SESSION["mail_gmail"]; ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <?php include 'php/infogeral/navDireita.php'; ?>




        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>

    </body>
</html>