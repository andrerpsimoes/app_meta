<?php

    /*
        vai ver se ja tem sessão iniciada
        se não tiver redireciona para a pagina inicial (index.html)
    
    */
    @session_start();
    if(isset($_SESSION['id'])){
         
           /* if (isset($_SESSION['CREATED']) && (time() - $_SESSION['CREATED'] > 900)) {
                // last request was more than 30 minutes ago
                session_unset();     // unset $_SESSION variable for the run-time 
                session_destroy();   // destroy session data in storage
                  header("Location: index.html");
            }*/
            $_SESSION['CREATED'] = time(); // update last activity time stamp
    }
    else{
        header("Location:index.php");
    }
?>