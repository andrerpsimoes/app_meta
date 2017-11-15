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

                </section>




                <!-- END CONTENT -->

                <!-- Floating Action Button -->
                <div class="fixed-action-btn " style="bottom: 50px; right: 19px;">
                    <a class="btn-floating btn-large">
                        <i class="material-icons">add</i>
                    </a>
                    <ul>
                        <li>
                            <a href="css-helpers.html" class="btn-floating blue">
                                <i class="material-icons">help_outline</i>
                            </a>
                        </li>
                        <li>
                            <a href="cards-extended.html" class="btn-floating green">
                                <i class="material-icons">widgets</i>
                            </a>
                        </li>
                        <li>
                            <a href="app-calendar.html" class="btn-floating amber">
                                <i class="material-icons">today</i>
                            </a>
                        </li>
                        <li>
                            <a href="app-email.html" class="btn-floating red">
                                <i class="material-icons">mail_outline</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Floating Action Button -->

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