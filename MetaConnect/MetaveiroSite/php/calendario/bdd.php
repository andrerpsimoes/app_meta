<?php
try
{
   
$bdd = new PDO('sqlsrv:server=metasede1.dyndns.org;Database=MetaveiroApp;', 'sa', 'Platinum01');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
