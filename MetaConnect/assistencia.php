<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'php/infogeral/header.php'; ?>
    </head>
    <body>
      
        <?php include 'php/infogeral/navSuperior.php'; ?>


        <div id="main" >
            <!-- START WRAPPER -->
            <div class="wrapper">

                <?php include 'php/infogeral/navEsquerda.php'; ?>

              
                <!-- START CONTENT -->
                <section id="content">
                    <div class="container">

                        


                            <div class="row">
                                <form class="col s12"  method = "POST">
                                <div class="input-field col s6 l12">
                                    <i class="material-icons prefix"  >perm_identity</i>
                                    <input  name="nomecliente" id="nomecliente" type="text"  class="validate" >
                                    <label for="icon_prefix" style="color: black;">Cliente</label>
                                </div>


                                <div id="infosCliente"  class="hide-on-small-only">

                                    <div class="input-field col s12">
                                        <i class="material-icons prefix" style="color: lightgray;"  >location_on</i>
                                        <input name="moradacliente"id="moradacliente" type="text" value="morada"  style="color: gray;" readonly >
                                        <label for="icon_prefix"  style="color: lightgray;">Morada</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix" style="color: lightgray;">label_outline</i>
                                        <input id="codpostcliente" type="text" value="Codigo Postal" style="color: gray;" readonly >
                                        <label for="icon_telephone"  style="color: lightgray;">Código Postal</label>
                                    </div>


                                    <div class="input-field col s3">
                                        <i class="material-icons prefix" style="color: lightgray;">my_location</i>
                                        <input name="loccliente"id="loccliente" type="text" value="Localidade" style="color: gray;" readonly>
                                        <label for="icon_prefix"  style="color: lightgray;">Localidade</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix" style="color: lightgray;">call</i>
                                        <input name="telcliente"id="telcliente" type="tel" value="Telefone" style="color: gray;" readonly>
                                        <label for="icon_telephone"  style="color: lightgray;">Telefone</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix" style="color: lightgray;">assignment_ind</i>
                                        <input name="contribcliente" id="contribcliente" type="text" value="Contrib" style="color:gray;" readonly >
                                        <label for="icon_telephone"  style="color: lightgray;">Nº Contrib</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s11 m11 l6">
                                    <i class="material-icons prefix">perm_identity</i>
                                    <input name="qpediu" id="qpediu" type="text" class="validate" >
                                    <label for="icon_prefix" style="color: black;">Quem pediu</label>
                                </div>
                                <div class="input-field col s11 m11 l3">

                                    <i class="material-icons prefix">navigation</i>
                                    <select name="prioridade" id="prioridade">
                                        <option value="0" selected>Normal</option>
                                        <option value="1">Média</option>
                                        <option value="2">Urgente</option>
                                    </select>
                                    <label for="icon_telephone"  style="color: black;">Prioridade</label>
                                </div>

                                <div class="input-field col s11 m11 l2" >
                                    <i class="material-icons prefix">perm_identity</i>
                                    <input name="qrecebeu" id="qrecebeu" type="text"   value="<?php echo $_SESSION["nome"] ?>" style="color: gray;" readonly >
                                    <label for="icon_prefix" >Quem recebeu</label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <h5>Informações Obra</h5>
                            <div class="row">
                                <div class="input-field col s11 m11 l3">
                                    <i class="material-icons prefix">navigation</i>
                                    <select name="zona" id="zona">
                                        <option value="" disabled selected>Zona</option>
                                        <option value="norte">Norte</option>
                                        <option value="centro">Centro</option>
                                        <option value="sul">Sul</option>
                                    </select>
                                </div>

                                <div class="input-field col s11 m11 l8">
                                    <i class="material-icons prefix">location_on</i>
                                    <input name="moradaobra" id="moradaobra" type="tel"  class="validate">
                                    <label for="icon_telephone" style="color: black;">Morada</label>
                                </div>

                            </div>

                            <div class="row">
                                <div class="input-field col s11 m11 l11">
                                    <textarea name="avaria" id="avaria" class="materialize-textarea"></textarea>
                                    <label for="textarea1" style="color: black;">Natureza da Avaria</label>
                                </div>
                            </div>


                            <div>

                                <input type="checkbox" value="asd">

                            </div>

                            <div class="row">
                                <div class="input-field col s11 m5 l2">

                                    <p>
                                        <input type="checkbox" id="CCTV" name="cctv" />
                                        <label for="CCTV">CCTV</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="SADI" name="sadi" />
                                        <label for="SADI">SADI</label>
                                    </p>

                                    <p>
                                        <input type="checkbox" id="RIA" name="ria" />
                                        <label for="RIA">RIA</label>
                                    </p>
                                </div>
                                <div class="input-field col s11 m5 l3">

                                    <p>
                                        <input type="checkbox" id="sadir" name="sadir" />
                                        <label for="sadir">SADIR</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="levantamentos" name="levantamentos" />
                                        <label for="levantamentos">Levantamentos</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="telecomunicacoes" name="telecomunicacoes"/>
                                        <label for="telecomunicacoes">Telecomunicações</label>
                                    </p>
                                </div> 
                                <div class="input-field col s11 m5 l3">

                                    <p>
                                        <input type="checkbox" id="informatica" name="informatica" />
                                        <label for="informatica">Informática/ERP</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="sadg" name="sadg" />
                                        <label for="sadg">SADG</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="certificacoes" name="certificacoes" />
                                        <label for="certificacoes">Certificações</label>
                                    </p>
                                </div> 
                                <div class="input-field col s11 m5 l3">
                                    <p>
                                        <input type="checkbox" id="rPonto" name="rponto" />
                                        <label for="rPonto">Relógio Ponto/Controlo Acesssos</label>
                                    </p>

                                    <p>
                                        <input type="checkbox" id="mSADI" name="msadi" />
                                        <label for="mSADI">Manutenção SADI</label>
                                    </p>
                                    <p>
                                        <input type="checkbox" id="mExtintores" name="mextintores"/>
                                        <label for="mExtintores">Manutenção Extintores</label>
                                    </p>
                                </div>
                            </div>
                            <br>

                            <button class="btn waves-effect waves-light " type="submit" name="action" style="width:100%;" >Criar  </button>


                        </form>
                    




                    </div>
                </section>




                <!-- END CONTENT -->

                <!-- Floating Action Button -->
                <div class="fixed-action-btn " style="bottom: 50px; right: 19px;">
                    <a class="btn-floating btn-large">
                        <i class="material-icons">add</i>
                    </a>
                    <ul>
                        <li>
                            <a href="css-helpers.html" class="btn-floating blue">
                                <i class="material-icons">help_outline</i>
                            </a>
                        </li>
                        <li>
                            <a href="cards-extended.html" class="btn-floating green">
                                <i class="material-icons">widgets</i>
                            </a>
                        </li>
                        <li>
                            <a href="app-calendar.html" class="btn-floating amber">
                                <i class="material-icons">today</i>
                            </a>
                        </li>
                        <li>
                            <a href="app-email.html" class="btn-floating red">
                                <i class="material-icons">mail_outline</i>
                            </a>
                        </li>
                    </ul>
                </div>
               </div>
                <!-- Floating Action Button -->

                <?php include 'php/infogeral/navDireita.php'; ?>
            </div>
        </div>

        <?php include 'php/infogeral/footer.php'; ?>

        <!-- ================================================
                               Scripts
      ================================================ -->
        <?php include 'php/infogeral/js.php'; ?>
    </body>
</html>