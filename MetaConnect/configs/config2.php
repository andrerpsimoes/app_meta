<?php
 $conn = new PDO("sqlsrv:Server=metasede1.dyndns.org ; Database=Emp_999", "servpro", "Platinum11");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
date_default_timezone_set("Europe/Lisbon");
?>