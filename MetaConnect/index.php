<?php
include 'configs/config.php'; //meta DB
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

    //md5 conversion
    $mypassword = md5($mypassword);

    // database query

    $query = $conn_meta->prepare("select id, nome , tipoconta, mail_gmail, mail_metaveiro, foto, departamento, telemovel from login where username='" . $myusername . "' and pass='" . $mypassword . "'");

    $query->execute();
    $result = $query;
    $num_rows = $query->rowCount();

    if ($num_rows == -1) {
        foreach ($result as $row) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["nome"] = $row["nome"];
            $_SESSION["tipoconta"] = $row["tipoconta"];
            $_SESSION["mail_gmail"] = $row["mail_gmail"];
            $_SESSION["mail_metaveiro"] = $row["mail_metaveiro"];
            $_SESSION["foto"] = $row["foto"];
            $_SESSION["departamento"] = $row["departamento"];
            $_SESSION["telemovel"] = $row["telemovel"];
            $SESSION['CREATED'] = time();
            header("Location: page-principal.php");
        }
    } else {
        $error = "Utilizador ou Palavra-Passe incorreta!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>ServPro</title>
        <!-- Favicons-->
        <link rel="icon" href="images/favicon/servpro_favicon.png" sizes="390x390">
        <!-- Favicons-->
        <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
        <!-- For iPhone -->
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
        <!-- For Windows Phone -->
        <!-- CORE CSS-->
        <link href="css/themes/fixed-menu/materialize.css" type="text/css" rel="stylesheet">
        <link href="css/themes/fixed-menu/style.css" type="text/css" rel="stylesheet">
        <!-- Custome CSS-->
        <link href="css/custom/custom.css" type="text/css" rel="stylesheet">
        <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet">
        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
        <link href="vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    </head>
    <body class="grey lighten-4">
        <!-- Start Page Loading -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!-- End Page Loading -->
        <div id="login-page" class="row">
            <div class="col s12 z-depth-4 card-panel">
                <form class="login-form" method="POST">
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="images/logo/servpro.png" alt="" class="responsive-img">
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-5">person_outline</i>
                            <input class="validate" type="text" name="username" id="email" required>
                            <label for="username" class="center-align">Utilizador</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-5">lock_outline</i>
                            <input class="validate" type="password" name="password" id="password" required>
                            <label for="password">Palavra-passe</label>
                        </div>
                    </div>
                    <label style="color: red; float: right;"><?php echo $error; ?></label>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" name="btn_login" class="btn waves-effect waves-light col s12">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- ================================================
        Scripts
        ================================================ -->
        <!-- jQuery Library -->
        <?php include 'php/infogeral/js.php'; ?>
    </body>
</html>