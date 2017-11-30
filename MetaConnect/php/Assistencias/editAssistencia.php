<?php
include("../../restrito.php");
include '../../configs/config.php'; // MetaveiroAppTestes

?>

<!-- Modal Structure -->
        <section id="content">
            <div class="container">
                <div class="row">
                    <div id="modal1" class="modal ">
                        <div class="modal-content">
                            <form class="form_modal" method="POST">
                                <h4>Assistência</h4>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">perm_identity</i>
                                        <input type="text" name="descricao" id="descricao" class="validate" required>
                                        <label for="first_name">Cliente</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">person</i>
                                        <input type="text" name="local" id="local" class="validate" required>
                                        <label for="first_name">Recebido por</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">person</i>
                                        <input type="text" name="contacto_responsavel" id="contacto_responsavel" class="validate" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                        <label for="first_name">Pedido por</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">date_range</i>
                                        <input type="text" name="local" id="local" class="validate" required>
                                        <label for="first_name">Data</label>
                                    </div>


                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">priority_high</i>
                                        <input type="text" name="contacto_responsavel" id="contacto_responsavel" class="validate" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                        <label for="first_name">Prioridade</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">build</i>
                                        <input type="text" name="pessoa_responsavel" id="pessoa_responsavel" class="validate" required>
                                        <label for="first_name">Projeto</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">cached</i>
                                        <input type="text" name="pessoa_responsavel" id="pessoa_responsavel" class="validate" required>
                                        <label for="first_name">Estado</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">textsms</i>
                                        <textarea id="observacoes" class="materialize-textarea" maxlength="500"></textarea>
                                        <label for="textarea1">Observações</label>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" type="submit" name="BtnModal" id="BtnModal">Criar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>