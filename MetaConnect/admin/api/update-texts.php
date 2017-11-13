<?php
include '../snippets/session.php';

include '../snippets/config.php';

$dataID = $_POST["textid"];
$newText = $_POST["text"];


$sql = "UPDATE texts SET text = '$newText' WHERE idtexts = '$dataID'";

if (mysqli_query($db, $sql)) {
    $doneStatus = "SQL OK";
} else {
    $doneStatus = ("SQL error: " . mysqli_error($db));
}

//close DB
mysqli_close($db);

//return type
header('Content-Type: application/json');

//return string 
echo json_encode("{ status : $doneStatus}");
?>

