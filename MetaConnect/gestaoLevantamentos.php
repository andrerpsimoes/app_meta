<?php
include("restrito.php");

//caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
//iniciada, como ve que nao tem este e redirecionado para a pagina incial
if (isset($_GET['logout'])) {
    session_destroy();
    header("Refresh:0");
}
include 'configs/config2.php'; // eticadata DB
include 'configs/config.php'; //meta DB

$sql_areas = $conn_meta->prepare("select id, descricao from area where id_parent is NULL and is_active=1");
$sql_areas->execute();
$areas = $sql_areas->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'php/infogeral/header.php'; ?>
    </head>
    <body>
        <?php include 'php/infogeral/navSuperior.php'; ?>

        <?php include 'php/infogeral/navEsquerda.php'; ?>
        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">
                <!-- START CONTENT -->
                <section id="content" style="margin-bottom: 70px;">
                    <h3 class="center" style="margin-bottom: 50px;">Gestão de Levantamentos</h3>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="input-field col s4">
                                <i class="material-icons prefix">search</i>
                                <input type="text" class="form-control" id="search">
                                <label for="icon_prefix">Procurar</label>

                            </div>
                            <div class="row" style="float: center;">
                                <div class="input-field col s3">
                                    <select id="area">
                                        <option disabled selected>Escolha uma área</option>
                                        <?php
                                        foreach ($areas as $area) {
                                            echo '<option value=' . $area['id'] . '>' . $area['descricao'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <label>Ordenar por Área</label>
                                </div>
                                <div class="input-field col s3">
                                    <div class="select_subarea" id="select_subarea"> 
                                        <!-- multiselect subareas-->
                                    </div>
                                </div>
                                <div class="input-field col s1 center">
                                    <a class="btn-floating waves-effect waves-light green darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ordenar" name="BtnOrder" id="BtnOrder" style="display: none;"><i class="material-icons">format_list_bulleted</i></a>
                                </div>
                                <div class="input-field col s1">
                                    <a class="btn-floating waves-effect waves-light black darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Limpar" name="BtnClear" id="BtnClear" style="display: none;"><i class="material-icons">clear</i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="tableContainer">
                        <!-- tableLev --> 
                    </div>
            </div>
        </section>

        <?php include 'php/infogeral/navDireita.php'; ?>
    </div>
</div>



<!-- Modal Eliminar -->
<div id="delete_modal" class="modal">
    <div class="modal-content" id="content_delete">
        <h4>Eliminar Levantamento</h4>
        <p>Tem a certeza que pretende eliminar este levantamento?</p>
    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelarButton">Cancelar</a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="simButton">Sim</a>
    </div>
</div>

<!-- Modal Editar -->
<div id="edit_modal" class="modal" style="width: 80%; height: 80%;">
    <div class="modal-content" id="content_edit">

    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelarButton">Cancelar</a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="guardarButton">Guardar</a>
    </div>
</div>

<!-- Modal Info -->
<div id="info_modal" class="modal" style="width: 80%; height: 80%;">
    <div class="modal-content" id="content_info">

    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelarButton">Cancelar</a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="guardarInfoButton">Guardar</a>
    </div>
</div>

<!-- Modal Atribuir Servico -->
<div id="assign_modal" class="modal" style="width: 80%; height: 100%; max-height: 80%;">
    <div class="modal-content" id="content_assign">

    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="cancelarButton">Cancelar</a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat" id="guardarAssignButton">Guardar</a>
    </div>
</div>


<?php include 'php/infogeral/footer.php'; ?>

<!-- ================================================
                       Scripts
================================================ -->
<?php include 'php/infogeral/js.php'; ?>

<script>

    var gestaoLevantamento = {

        //********variaveis globais********

        MensagemErro: "Ocorreu um erro, por favor contacte o administrador do sistema.",
        idservico: 0,
        //********Fim variaveis globais********

        editButton: function (this_row) {
            gestaoLevantamento.idservico = this_row.closest('tr').attr('id');
            $.ajax({
                type: "POST",
                data: {id_servico: gestaoLevantamento.idservico},
                url: 'php/Levantamentos/modaleditLev.php',
                success: function (response) {
                    $('#content_edit').html(response);
                },
                error: function () {
                    alert(gestaoLevantamento.MensagemErro);
                }
            });
            $('#edit_modal').modal('open');
        },
        guardarModalEdit: function () {

            data_to_edit = {
                id_servico: gestaoLevantamento.idservico,
                prioridade: $("#edit_modal #prioridade").val(),
                observacoes: $("#edit_modal #observacoes").val()
            };
            $.ajax({
                type: "POST",
                data: data_to_edit,
                url: 'php/Levantamentos/editLevantamento.php',
                success: function (response) {
                    $.ajax({
                        url: 'php/Levantamentos/tableLev.php',
                        success: function (response) {
                            debugger;
                            $('#tableContainer').html(response);
                            Materialize.toast('Levantamento editado com sucesso!', 3000, 'rounded');
                        },
                        error: function () {
                            alert(gestaoLevantamento.MensagemErro);
                        }
                    });
                },
                error: function () {
                    alert(gestaoLevantamento.MensagemErro);
                }
            });
        },
        deleteButton: function (del_this) {
            gestaoLevantamento.idservico = del_this.closest('tr').attr('id');
            $('#delete_modal').modal('open');
        },
        simModal: function () {
            $.ajax({
                type: "POST",
                data: {id_servico: gestaoLevantamento.idservico},
                url: 'php/Levantamentos/deleteLev.php',
                success: function (response) {
                    $.ajax({
                        url: 'php/Levantamentos/tableLev.php',
                        success: function (response) {
                            debugger;
                            $('#tableContainer').html(response);
                            Materialize.toast('Levantamento eliminado com sucesso!', 3000, 'rounded');
                        },
                        error: function () {
                            alert(gestaoLevantamento.MensagemErro);
                        }
                    });
                },
                error: function () {
                    alert(gestaoLevantamento.MensagemErro);
                }
            });
        },
        cancelarModal: function () {
            $('#delete_modal').modal('close');
            $('#edit_modal').modal('close');
            $('#info_modal').modal('close');
            $('#assign_modal').modal('close');
        },
        infoButton: function (info_this) {
            gestaoLevantamento.idservico = info_this.closest('tr').attr('id');
            $.ajax({
                type: "POST",
                data: {id_servico: gestaoLevantamento.idservico},
                url: 'php/Levantamentos/infoModalLev.php',
                success: function (response) {
                    $('#content_info').html(response);
                },
                error: function () {
                    alert(gestaoLevantamento.MensagemErro);
                }
            });
            $('#info_modal').modal('open');
        },

        guardarModalInfo: function () {
            var idservico = gestaoLevantamento.idservico;
            var check = $('#checkLev').is(':checked');
            if (check == true) {

                $.ajax({
                    type: "POST",
                    data: {id_servico: idservico},
                    url: 'php/Levantamentos/concludedLev.php',
                    success: function (response) {
                        $.ajax({
                            url: 'php/Levantamentos/tableLev.php',
                            success: function (response) {
                                $('#tableContainer').html(response);
                                Materialize.toast('Levantamento concluído!', 3000, 'rounded');
                            },
                            error: function () {
                                alert(gestaoLevantamento.MensagemErro);
                            }
                        });
                    },
                    error: function () {
                        alert(gestaoLevantamento.MensagemErro);
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    data: {id_servico: idservico},
                    url: 'php/Levantamentos/notConcludedLev.php',
                    success: function (response) {
                        $.ajax({
                            url: 'php/Levantamentos/tableLev.php',
                            success: function (response) {
                                $('#tableContainer').html(response);
                                Materialize.toast('Levantamento atualizado!', 3000, 'rounded');
                            },
                            error: function () {
                                alert(gestaoLevantamento.MensagemErro);
                            }
                        });
                    },
                    error: function () {
                        alert(gestaoLevantamento.MensagemErro);
                    }
                });
            }
        },

        atribuirServico: function (id_this) {
            gestaoLevantamento.idservico = id_this.closest('tr').attr('id');
            $.ajax({
                type: "POST",
                data: {id_servico: gestaoLevantamento.idservico},
                url: 'php/Levantamentos/assignModalLev.php',
                success: function (response) {
                    $('#content_assign').html(response);
                },
                error: function () {
                    alert(gestaoLevantamento.MensagemErro);
                }
            });
            $('#assign_modal').modal('open');
        },
        guardarModalAssign: function () {
            var selected = [];
            $('#assign_modal #tecnicos option:checked').each(function () {
                selected.push($(this).attr('value'));
            });
            var dia_ini = $("#assign_modal #day_ini").val();
            var hora_ini = $("#assign_modal #hour_ini").val();
            var dia_fin = $("#assign_modal #day_fin").val();
            var hora_fin = $("#assign_modal #hour_fin").val();

            dados_serv_tec = {
                id_servico: gestaoLevantamento.idservico,
                tecnicos_selecionados: selected,
                dia_ini: dia_ini,
                hora_ini: hora_ini,
                dia_fin: dia_fin,
                hora_fin: hora_fin
            };
            $.ajax({
                type: "POST",
                data: dados_serv_tec,
                url: 'php/Levantamentos/insertTecnicoLev.php',
                success: function (response) {
                    alert(response);
                    //Materialize.toast('Técnico(s) atribuidos!', 3000, 'rounded');
                },
                error: function () {
                    alert(gestaoLevantamento.MensagemErro);
                }
            });
        },

        orderButton: function () {
            var subareas = $('#multiple_filhos').val();
            //alert(subareas);

            $.ajax({
                type: "POST",
                data: {subareas: subareas},
                url: 'php/Levantamentos/tableOrder.php',
                success: function (response) {
                    $('#tableContainer').html(response);

                    //alert(response);
                },
                error: function () {
                    alert(gestaoAssistencia.MensagemErro);
                }
            });

        },

        selectArea: function () {
            var id_area_mae = $("#area").val();
            //alert(id_area);

            $.ajax({
                type: "POST",
                data: {id_area_mae: id_area_mae},
                url: 'php/infogeral/selectSubareas.php',
                success: function (response) {
                    $('#select_subarea').html(response);
                    $('#BtnOrder').show();
                    $('#BtnClear').show();
                    //alert(response);
                },
                error: function () {
                    alert(gestaoAssistencia.MensagemErro);
                }
            });
        },

        clearButton: function () {
            location.reload(true);
        },

        init: function () {

            $('.tooltipped').tooltip({delay: 50});
            $('select').material_select();
            $('.modal').modal();
            $.ajax({
                url: 'php/Levantamentos/tableLev.php',
                success: function (response) {
                    $('#tableContainer').html(response);
                },
                error: function () {
                    alert(gestaoLevantamento.MensagemErro);
                }
            });
        }
    };
    $(document).ready(function () {

        gestaoLevantamento.init();
        $(document).on("click", "a[name='BtnEdit']", function () {
            var this_row = $(this);
            gestaoLevantamento.editButton(this_row);
        });
        $(document).on("click", "a[name='BtnDelete']", function () {
            var del_this = $(this);
            gestaoLevantamento.deleteButton(del_this);
        });
        $("#guardarButton").click(function () {
            gestaoLevantamento.guardarModalEdit();
        });
        $("#simButton").click(function () {
            gestaoLevantamento.simModal();
        });
        $("#cancelarButton").click(function () {
            gestaoLevantamento.cancelarModal();
        });
        $("#guardarAssignButton").click(function () {
            gestaoLevantamento.guardarModalAssign();
        });
        $("#guardarInfoButton").click(function () {
            gestaoLevantamento.guardarModalInfo();
        });

        $("#BtnOrder").click(function () {
            gestaoLevantamento.orderButton();
        });

        $("#area").change(function () {
            gestaoLevantamento.selectArea();
        });

        $("#BtnClear").click(function () {
            gestaoLevantamento.clearButton();
        });

        $(document).on("click", "a[name='BtnInfo']", function () {
            var info_this = $(this);
            gestaoLevantamento.infoButton(info_this);
        });
        $(document).on("click", "td:first-child", function () {
            var id_this = $(this);
            gestaoLevantamento.atribuirServico(id_this);
        });

        //procura em toda a tabela digitando no input search
        $("#search").keyup(function () {
            var searchTerm = $("#search").val(),
                    searchSplit = searchTerm.replace(/ /g, "'):containsi('");

            $.extend($.expr[':'], {'containsi': function (elem, i, match, array) {
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
            });

            $("#tableLev tbody tr").not(":containsi('" + searchSplit + "')").each(function (e) {
                $(this).hide();
            });
            $("#tableOrder tbody tr").not(":containsi('" + searchSplit + "')").each(function (e) {
                $(this).hide();
            });

            $("#tableLev tbody tr:containsi('" + searchSplit + "')").each(function (e) {
                $(this).show();
            });
            $("#tableOrder tbody tr:containsi('" + searchSplit + "')").each(function (e) {
                $(this).show();
            });

        });

    });

</script>

</body>
</html>