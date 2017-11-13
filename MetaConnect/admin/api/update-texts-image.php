<?php

	$doneStatus = "OK";

	include '../snippets/session.php';

	include '../snippets/config.php';

	$doneStatus = "None";

	if (isset($_FILES['file']['name'])) {

		//save file name original
		$fileName = $_FILES['file']['name'];
		//id da entrada a alterar
		$lineID = $_POST['id'];

		//caminho de origem
		$origem = $_POST['origem'];
		$origemPath = implode('/', explode('/', $origem, -1)) . "/";

		//new file name (md5 with timestamp for uniqueness)
		$newFile = ($origemPath . md5(time() . $origem) . ".jpg");

	    if (0 < $_FILES['file']['error']) {
	        $doneStatus = 'Error during file upload' . $_FILES['file']['error'];
	    } else {
	        if (file_exists('../../' . $newFile)) {
	            $doneStatus = 'File already exists';
	        } else {
	            move_uploaded_file($_FILES['file']['tmp_name'], '../../' . "$newFile"); 
	        }
	    }


	    //delete original
	    unlink("../../" . $origem);

	    //upload database field
	    $sql = "UPDATE texts SET photo = '$newFile' WHERE idtexts = '$lineID'";

		if (!(mysqli_query($db, $sql))) {
    		$doneStatus = "SQL Error";
		}

		//close DB
		mysqli_close($db);

	} else {
    	$doneStatus = "File not Shoosen";
	}

	//return type
	header('Content-Type: application/json');

	//return string 
	echo json_encode('{ "status" : "'.$doneStatus.'" , "newpath" : "'.$newFile.'"}');

?>