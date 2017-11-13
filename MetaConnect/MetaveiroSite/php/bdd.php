<?php
$serverName = "metasede1.dyndns.org";
 $conn = new PDO("sqlsrv:Server=$servername ; Database=MetaveiroApp", "sa", "Platinum01");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
?>