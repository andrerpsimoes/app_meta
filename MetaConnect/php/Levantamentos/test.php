<?php

include '../../configs/config.php'; // MetaveiroAppTestes

$array_existente = array("7", "13", "15", "14");
$array_novos = array("13", "14", "20");


echo "<pre>";
print_r($array_existente);
echo "</pre>";

echo "<pre>";
print_r($array_novos);
echo "</pre>";

$diff_to_remove = array_diff($array_existente, $array_novos);
echo "Remover" . "<br>";
print_r($diff_to_remove);
echo "<br>";
echo "Inserir" . "<br>";
$diff_to_insert = array_diff($array_novos, $array_existente);
print_r($diff_to_insert);

?>