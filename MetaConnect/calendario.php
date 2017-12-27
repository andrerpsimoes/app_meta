<?php

include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
if (isset($_GET['logout'])) {
    session_destroy();
    header("Refresh:0");
}

$mail = $_SESSION["mail_gmail"];

$init_mail = explode('@', $mail);
//$init_mail[0];

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
                        <div class="row center">

                            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;hl=pt_PT&amp;bgcolor=%23FFFFFF&amp;src=<?php echo $init_mail[0];?>%40gmail.com&amp;color=%230e61b9&amp;src=pt.portuguese%23holiday%40group.v.calendar.google.com&amp;color=%230F4B38&amp;ctz=Europe%2FLisbon" style="border-width:0; margin-top: 25px;" width="800" height="525" frameborder="0" scrolling="no"></iframe>
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