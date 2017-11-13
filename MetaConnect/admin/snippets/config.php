<?php
   define('DB_SERVER', '81.4.109.196');
   define('DB_USERNAME', 'c10appacdm');
   define('DB_PASSWORD', 'coyQWK#22');
   define('DB_DATABASE', 'c10appacdmsite');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   mysqli_set_charset($db, "utf8"); //define a colation do mysqli
?>