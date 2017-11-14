<?php
 $conn_meta = new PDO("sqlsrv:Server=metasede1.dyndns.org ; Database=MetaveiroAppTestes", "servpro", "Platinum11");
 $conn_meta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
?>