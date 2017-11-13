 
 
 
 $.ajax({
     url:"php/getClientes.php",
     dataType: "json",
     success: function (pData) {
         
         var jsonObj = {};
         
         for (var i=0; i< pData.length; i++){

             jsonObj[pData[i]["intCodigo"]+" - "+pData[i]["strNome"]] = null;
         }
         
         $('#autocomplete-input').autocomplete({
             data: jsonObj,
             limit: 5,
              onAutocomplete: function(val) {
                  var id_cliente =val.substr(0,val.indexOf(' '));
                  
                    $.ajax({
                        
                            type: "POST",
                            data: { id_cliente : id_cliente },
                            url:'php/getInfoCliente.php',
                             success: function (response) {

                                var arr = $.parseJSON(response);
                                $("#morada").val(arr[0].strMorada_lin1);
                                $("#localidade").val(arr[0].strLocalidade);
                                $("#cod_postal").val(arr[0].strPostal);
                                $("#contribuinte").val(arr[0].strNumContrib);
                                $("#telefone").val(arr[0].strTelefone);


                            },
                            error: function () {
                               alert("nao deu");
                            }
                    });
                  
             }
         });
     }
 });
 