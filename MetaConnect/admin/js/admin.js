//init of the side bar
$('.button-collapse').sideNav();

//init of all editors
tinymce.init({ 
	selector:'textarea',
	height: 150,
  	menubar: false,
	toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist'
});

//update text click
$( ".text-update" ).click(function() {
	tinyMCE.triggerSave();
	$dataID = $(this).attr("data-textid");
	$newData = $('#editor-' + $dataID).val();
	$newData = $newData.substring(3,$newData.length-4);

	//mensagem a enviar json
    messageToBackend = {textid : $dataID , text : $newData}
                    
    //ajax call
    $.ajax({
        url: 'api/update-texts.php',
        type: 'POST',
        data: messageToBackend,
        success: function(response){
        	console.log(response);
        	//notification card
			new PNotify({
			title: 'Sucesso!',
			text: 'Texto atualizado!\nVerifique as alterações na <a target="_blanc" href="../">página</a>.',
			type: 'success'
			});
        },
        error: function (response) {
            console.log(response);

            new PNotify({
			title: 'Erro!',
			text: 'Por favor contacte o administrador do sistema.',
			type: 'error'
			});
        }
    });

  	console.log( "Updated text with id: " + $dataID + "\nNew data: " + $newData );
});

//end of windows load code
$(window).load(function() {

		//hide the spinner after page load and two adiitions seconds
		setTimeout(function() {
			$(".se-pre-con").fadeOut("slow");
		}, 2000);
		
});


//on new pic load
$(".picinputs").change(function() {

	//data from preloaded page
	$dataID = $(this).attr("data-textid");
	$imgOrigem = $(this).attr("data-originalpicpath");

	//file inserted
	var $file_data = this.files[0];

	var $form_data = new FormData();
	$form_data.append('file', $file_data);
	$form_data.append('id', $dataID);
	$form_data.append('origem', $imgOrigem);

	$.ajax({
        url: 'api/update-texts-image.php',
        cache: false,
        contentType: false,
        processData: false,
        data: $form_data,
        type: 'post',
        success: function (response) {
        	
        	var received_data = JSON.parse(response);

        	$("#photo-" + $dataID).attr("src", ("../" + received_data['newpath'])) ;

        	//notification card
			new PNotify({
			title: 'Sucesso!',
			text: 'Imagem atualizada!\nVerifique as alterações na <a target="_blanc" href="../">página</a>.',
			type: 'success'
			});
        },
        error: function (response) {
            console.log(response);

            new PNotify({
			title: 'Erro!',
			text: 'Por favor contacte o administrador do sistema.',
			type: 'error'
			});
        }
    });
    
});

