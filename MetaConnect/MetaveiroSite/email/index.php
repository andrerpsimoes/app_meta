<?php
   
   session_start();
   //session_destroy();
?>


<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>TECLA 2017</title>
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="css/styles.css" rel="stylesheet">
      <!-- Custom Fonts -->
      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
   </head>
   <body id="page-top">

      <!-- Navigation -->
      <?php require("php/navbar.php");?>

      <!-- Header -->
      
      <header class="header" style="padding:50px;   color:white; "  >
         
             <div style="text-align: center; width: 100%; height:100%;  " >
                  <br/> <br/>
               <h4><b><span style=" font-size: 35px;">T</span>ORNEIO <span style=" font-size: 35px;">E</span>STUDANTIL DE <span style=" font-size: 35px;">C</span>OMPUTAÇÃO MULTI<span style=" font-size: 35px;">L</span>INGUAGEM DE <span style=" font-size: 35px;">A</span>VEIRO<br/>
               <span style=" font-size: 50px;">2017</span></b></h4><br/>
               ________________
               <h3><b>Escola Superior de Tecnologia e Gestão de Águeda</b></h3>
               <h4><b>Fase preliminar:</b> 8 de Fevereiro</h4>
               <h4><b>Fase final:</b> 8 de Março</h4>
               ________________
               <br/>
               
               <?php

                  if(isset($_SESSION['user']) && isset($_SESSION['pw'])){
                     
                     // tem sessao iniciada

                     echo
                     '<h3><b style="color:white;">Já tem alunos interessados?</b></h3>
                     <br/>
                     <form action="equipas_reg.php" method="POST">
                        <input type="submit" class="btn btn-primary btn-md" style="font-size: 20px; color:white; background-color: gb(44,111,174); font-weight: bold;" value=" Inscreva já as suas equipas!">
                     </form>';
                  } else {

                     // nao tem sessao iniciada

                     echo
                     '<h3><b style="color:white;">É professor? Tem equipas para participar?</b></h3>
                     <br/>
                     <form action="register.php" method="POST">
                        <b><input type="submit" class="btn btn-primary btn-md" style="font-size: 20px; color:white; background-color: rgb(44,111,174); font-weight: bold;" value="Inscreva-se!"></b>
                     </form>';
                  }
               ?>


               <br/>
               <br/>
               <br/>

            </div>
            <br>    
        
      </header>
     
      <!-- About -->
     
      <section id="about" class="about">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <h2><b>Sobre</b></h2>
                  <hr class="small">
                  <h4 class="titulo2">O Torneio Estudantil de Computação multiLinguagem de Aveiro (TECLA) é um torneio promovido e organizado pela Escola Superior de Tecnologia e Gestão de Águeda (ESTGA) da Universidade de Aveiro.<br><br>
                Podem concorrer todos os alunos que, no ano letivo correspondente até  data do Torneio, frequentem o ensino secundário ou equivalente, organizados em equipas de dois elementos.<br><br>
                  <b>O TECLA é composto por duas fases:</b>
                  <br><br>
                  &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;A <b>fase preliminar</b> que decorre no estabelecimento de ensino de origem dos alunos, sendo a participação efetuada através da Internet.
                  <br><br>
                  &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;A <b>fase final</b> que decorre nas instalações da ESTGA.<br><br>
                  Em cada uma das fases é realizada uma prova com duração máxima de 2 horas e 30 minutos, onde será apresentado, simultaneamente a todos os concorrentes, um conjunto de problemas de programação.<br><br>
                  Passam à fase final as 25 equipas melhor classificadas, sendo a participação limitada a três equipas por escola.<br><br><br>
                  <b>DATAS IMPORTANTES:</b>
                  <br><br>
                  &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;
                  <b>Inscrição de equipas:</b> Até 31 de Janeiro de 2017
                  <br><br>
                  &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;
                  <b>1ª fase:</b> 8 de Fevereiro de 2017
                  <br><br>
                  &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;
                    <b>2ª fase:</b> 8 de Março de 2017 </h4>
               </div>
            </div>
            </div>
       </section>
      
   
      <!-- Topics -->
      <!-- http://fontawesome.io/examples/ -->
      

      <section id="services" class="services bg-primary">
         <div class="container">
            <div class="row text-center">
               <div class="col-lg-10 col-lg-offset-1">
                  <h2><b>Organização</b></h2>
                  <hr class="small">
                  <div class="row">
                     <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                           <span class="fa-stack fa-4x">
                           <i class="fa fa-circle fa-stack-2x"></i>
                           <i class="fa fa-users fa-stack-1x text-primary"></i>
                           </span>
                           <h4>
                              <strong class="titleorg">Comissão organizadora</strong>
                           </h4>
                           <p class="comissao">Ana Rita Calvão<br>Ana Rita Santos<br>Ciro Martins<br>Cristina Guardado<br>Fábio Marques<br>Hélder Gomes<br>Magda Monteiro<br>Margarida Urbano</p>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                           <span class="fa-stack fa-4x">
                           <i class="fa fa-circle fa-stack-2x"></i>
                           <i class="fa fa-flask fa-stack-1x text-primary"></i>
                           </span>
                           <h4>
                              <strong class="titleorg">Comissão Científica</strong>
                           </h4>
                           <p class="comissao">Ana Rita Calvão<br>Ana Rita Santos<br>António Barbeito<br>Ciro Martins<br>Cristina Guardado<br>Fábio Marques<br>Hélder Gomes<br>Luís Jorge Gonçalves<br>Magda Monteiro<br>Mário Rodrigues<br>Margarida Urbano<br>Paulo Augusto<br>Valter Silva</p>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                           <span class="fa-stack fa-4x">
                           <i class="fa fa-circle fa-stack-2x"></i>
                           <i class="fa fa-flag-checkered fa-stack-1x text-primary"></i>
                           </span>
                           <h4>
                              <strong class="titleorg">Estundantes Voluntários</strong>
                           </h4>
                           <p class="comissao">André Simões (CTESP PSI)<br>Carlos Girão (CTESP PSI)<br>Cláudio Cruz (CTESP PSI)<br>David Duarte (CTESP PSI)<br>João Constantino (LIC. TI)<br>Pedro Geraldo (LIC. TI)<br>Rui Frazão (LIC. TI)<br>Rui Mourão (LIC. TI)<br>Vasco Maia (LIC. TI)<br>Yuliana Alich (LIC. TI)</p>
                        </div>
                     </div>
                  </div>
                 
               </div>
              
            </div>
      
         </div>
         
      </section>

      
      <!-- Galery -->
<!--
      <section id="portfolio" class="portfolio">
         <div class="container">
            <div class="row">
               <div class="col-lg-10 col-lg-offset-1 text-center">
                  <h2>Galeria</h2>
                  <hr class="small">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="#">
                           <img class="img-portfolio img-responsive" src="img/portfolio-1.jpg">
                           </a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="#">
                           <img class="img-portfolio img-responsive" src="img/portfolio-2.jpg">
                           </a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="#">
                           <img class="img-portfolio img-responsive" src="img/portfolio-3.jpg">
                           </a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="#">
                           <img class="img-portfolio img-responsive" src="img/portfolio-4.jpg">
                           </a>
                        </div>
                     </div>
                  </div>
                  
                  <a href="#" class="btn btn-dark">Ver Mais</a>
               </div>
               
            </div>
            
         </div>
         
      </section>
-->

      <!-- Premios -->

      <section id="premios" class="premios">
    <aside class="call-to-action bg-primary" style="background-color:white; color:black;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-trophy text-primary"></i>
                     </span>
                    <h2><b>Prémios</b></h2>
                    <hr class="small">
                   <!-- <p class="comissao">-->
                        <h4><b>1º Classificado</b></h4>Prémio Câmara Municipal de Águeda - 2 Portáteis
                        <br>
                        <br>
                        <h4><b>2º Classificado</b></h4>Prémio XXXXX - YYYYY
                        <br>
                        <br>
                        <h4><b>3º Classificado</b></h4>Prémio FCA - 2 Livros Técnicos
                    <!--</p> -->
                </div>
            </div>
        </div>
    </aside>
</section>
      <!-- Resultados -->

      <section id="resultados" class="resultados">
         <aside class="call-to-action bg-primary" style="background-color:white; color:black;">
            <div class="container">
            
               <div class="row">
                  <div class="col-lg-12 text-center">

                     <h2><b>Resultados</b></h2>
                     <hr class="small">
                     <p class="comissao">Disponível brevemente.</p>
                  </div>
               </div>
               
            </div>
         </aside>
      </section>

 <!-- ESCOLAS PARTICIPANTES--> 
 
<section id="escolas" class="services bg-primary" style="background-color:#404040;">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-10 col-lg-offset-1">
                <h2><b>Escolas Participantes</b></h2>
                <hr class="small">
                    <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-university text-primary" style="font-size:50px;color:#404040"></i>
                   </span>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-12 text-justify ">
                        <div class="service-item">
                            <p class="comissao">Agrupamento de Escolas Albergaria a Velha<br>Agrupamento de Escolas D. Afonso Sanches<br>Agrupamento de Escolas D. Dinis<br>Agrupamento de Escolas de Padre Benjamim Salgado<br>Agrupamento de Escolas de Penacova<br>Colégio Internato dos Carvalhos<br>Didáxis - Cooperativa de Ensino<br>
                            </p>
                            
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 text-justify" >
                        <div class="service-item">
                            <p class="comissao">Escola Profissional de Carvalhais<br>Escola Profissional de Leiria<br>Escola Secundária Adolfo Portela<br>Escola Secundária Cacilhas<br>Escola Secundária de Avelar Brotero<br>Escola Secundária de Valongo<br>Escola Secundária de Carvalhos<br>Escola Secundária de Emídio Navarro<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 text-justify">
                        <div class="service-item">
                            <p class="comissao">Escola Fontes Pereira de Melo<br>Escola Profissional de Aveiro<br>Escola Secundária Ferreira de Castro<br>Escola Secundária Gago Coutinho<br>Escola Secundária Lima de Faria<br>Escola Secundária de Lousada<br>Escola Secundária Marques Castilho<br>Escola Secundária/3 Tomaz Pelayo<br>Escola Técnico Profissional de Cantanhede<br>INETE - Instituto de Educação Técnica <p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
      
       <!-- Plataformas -->
    <section id="plataform" class="plataform">
    <aside class="call-to-action bg-primary" style="background-color:#347AB6;">
        <div class="text-vertical-center">
            <p class="tiparagrafo"> <!--<h1>--><b><span style="color:white; font-size: 40px;">PLATAFORMA</span></b> <!--</h1> --> </p>
            <br>
            <br>
                <div style="padding-left: 100px; padding-right: 100px;"> 
                        <span style="display: inline-block; color:white; text-align: justify; font-size: 17px;">
                          &nbsp;&bull;&nbsp;Durante a fase final cada equipa terá à disposição um computador, não sendo permitida a utilização de material de apoio em suporte informático, com exceção do sistema de ajuda próprio das linguagens de programação, disponibilizado pela organização..<br><br>&nbsp;&bull;&nbsp;Todos os computadores estarão equipados com o <b>sistema operativo</b> Linux e com os <b>IDE/editores:</b>Atom, Code::Blocks, DrPython, Geany, Lazarus, Mono Develop e Netbeans.<br><br>&nbsp;&bull;&nbsp;As <b>linguagens de programação</b> permitidas são: C, C++, C#, Java, Pascal, Python, VB.NET.<br><br>&nbsp;&bull;&nbsp;O <b>sistema de avaliação</b> automática de submissões utilizado será o Mooshak.<br><br>&nbsp;&bull;&nbsp;Para as equipas que assim o pretendam disponibiliza-se uma <b>máquina virtual</b> (Virtual Box) configurada com o mesmo ambiente a utilizar durante a fase final: http://xyz.xyz<br><br></span>
                        <br>
                        <a href="http://mooshak.estga.ua.pt/~tecla2017">
                          <input type="button" class="btn btn-primary btn-md" style="font-size: 10px; color:white; background-color:black; font-weight: bold;" value="PLATAFORMA DE TREINO">
                        </a>
                        <br>
                        <p class="paragrafo" style="text-align: center;">* disponível após registo do Responsável Local de cada escola participante.</p>
                        <a href="http://mooshak.estga.ua.pt/~tecla2017">
                           <input type="button" class="btn btn-primary btn-md" style="font-size: 10px; color:white; background-color:black; font-weight: bold;" value="PLATAFORMA DE PROVA">
                        </a>
                        <p class="paragrafo" style="text-align: center;">* disponível durante as datas definidas para a fase preliminar e fase final.</p>
                        <br> 
                </div>
                <br> 
      </div>
    </aside>
</section>

      
<section id="historico" class="historico">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 text-center">
                   <br>
                   <br>
                  <h2><b>Histórico</b></h2>
                  <hr class="small">
                  <h4 class="titulo2">&nbsp;&nbsp;A ESTGA-UA promove anualmente, desde 2009, o Torneio Estudantil de Computação multi-Linguagem de Aveiro (TECLA). Ao longo destes oito anos, a maioria das escolas têm tido uma participação assídua e, no total, mais de 1 milhar de alunos participaram em uma ou mais edições desta iniciativa.<br><br>&nbsp;&nbsp;A última edição (2016) contou com a participação de cerca de 304 alunos do ensino secundário ou equivalente, distribuídos por 152 equipas e provenientes de 25 escolas de vários distritos.<br><br><b>&nbsp;&nbsp;&bull;&nbsp;Edições Anteriores:</b>
                  </h4>
               
            </div>
         </div>
             <br>
             <div class="wrapper" style="text-align: center;">
                 <div class="row"> 
                     
                 <a href="http://tecla.estga.ua.pt/" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2016</a>
                 <a href="http://tecla.estga.ua.pt/2015/default.aspx" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB6; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2015</a>
                 
                 <a href="http://tecla.estga.ua.pt/2014/default.aspx" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB6; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2014</a>
                 <a href="http://tecla.estga.ua.pt/2013/default.aspx" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB6; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2013</a>
                 
                     
                  <a href="http://tecla.estga.ua.pt/2012/default.aspx" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB6; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2012</a>
                 
                  <a href="http://tecla.estga.ua.pt/2011/default.aspx" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB6; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2011</a>
                  
                  <a href="http://tecla.estga.ua.pt/2010/default.aspx" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB6; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2010</a>
                  <a href="http://tecla.estga.ua.pt/2009/default.aspx" target="_blank" class="btn btn-info col-sm-6 col-md-2" role="button" style="background-color: #347AB6; border-color: #347AB6; margin-left: 10px; margin-right: 10px; margin-bottom: 15px;">Tecla 2009</a>
           
                 </div>
             </div>
             
            
         </div>
       </section>
   <br><br>



      <!-- Callout -->

      <aside class="callout">
         <div class="text-vertical-center">
            <h1>Contamos contigo!</h1>
         </div>
      </aside>



      <!-- Map -->
      
      <section id="contact" class="map">
         <div style="width:100%;max-width:100%;overflow:hidden;height:50%;color:red;">
            <div id="google-maps-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=R.+Cmte.+Pinho+e+Freitas+3750-127,+âˆš?gueda,+Portugal&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div>
            <a class="google-html" rel="nofollow" href="http://www.interserver-coupons.com" id="inject-map-data">interserver coupons</a>
            <style>#google-maps-display img{max-width:none!important;background:none!important;font-size: inherit;}</style>
         </div>
         <script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=6d7584c1-25f0-c990-c5d4-cda6dac68879&c=google-html&u=1474073039" defer="defer" async="async"></script>

         <!-- Footer -->
    
         <footer>
            <div class="container">
               <div class="row">
                  <div class="col-lg-10 col-lg-offset-1 text-center">
                     <h4><strong>ESTGA - Universidade de Aveiro</strong>
                     </h4>
                     <p>R. Cmte. Pinho e Freitas
                        <br>3750-127 Águeda
                     </p>
                     <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (+351) 234 611 500</li>
                        <li><i class="fa fa-globe fa-fw"></i> <a href="http://www.ua.pt/">ua.pt</a>
                        <li><i class="fa fa-envelope fa-fw"></i> tecla@ua.pt </li>
                     </ul>
                     <br>
                     <ul class="list-inline">
                        <li>
                           <a href="https://www.facebook.com/estga.ua/?fref=ts" target="_blank"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                           <a href="https://www.youtube.com/channel/UCWGxcBSjS7tPBmgLwg6rVBw" target="_blank"><i class="fa fa-youtube fa-fw fa-3x"></i></a>
                        </li>
                     </ul>
                     <hr class="small">
                     <p class="text-muted">Copyright &copy; 2017 TECLA TEAM</p>
                  </div>
               </div>
            </div>
            <a id="to-top" href="#top" class="btn btn-dark btn-lg"><i class="fa fa-chevron-up fa-fw fa-1x"></i></a>
         </footer>


    
      </section>


      <section id="portfolio" class="portfolio">
         <div class="container">
            <div class="row">
               <div class="col-lg-10 col-lg-offset-1 text-center">
                  <h2><b>Apoios</b></h2>
                  <hr class="small">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="https://www.cm-agueda.pt/">
                           <img class="img-portfolio img-responsive" src="img/logo_cm_agueda.png">
                           </a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="http://www.fca.pt/pt/">
                           <img class="img-portfolio img-responsive" src="img/logo_fca.png">
                           </a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="https://www.ua.pt/">
                           <img class="img-portfolio img-responsive" src="img/logo_ua.png">
                           </a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="portfolio-item">
                           <a href="https://www.ua.pt/estga/">
                           <img class="img-portfolio img-responsive" src="img/logo_estga.jpg">
                           </a>
                        </div>
                     </div>
                  </div>
                  
               </div>
               
            </div>
            
         </div>
         
      </section> 

      <!--<div id="footer">
         </div> -->
      <!-- jQuery -->
      <script src="js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
      <script src="js/creative.js"></script>
      <!-- Custom Theme JavaScript -->
      <script>
     
         // Closes the sidebar menu
         $("#menu-close").click(function(e) {
           e.preventDefault();
           $("#sidebar-wrapper").toggleClass("active");
         });
         // Opens the sidebar menu
         $("#menu-toggle").click(function(e) {
           e.preventDefault();
           $("#sidebar-wrapper").toggleClass("active");
         });
         // Scrolls to the selected menu item on the page
         $(function() {
           $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
               if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                   var target = $(this.hash);
                   target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                   if (target.length) {
                       $('html,body').animate({
                           scrollTop: target.offset().top
                       }, 1000);
                       return false;
                   }
               }
           });
         });
         //#to-top button appears after scrolling
         var fixed = false;
         $(document).scroll(function() {
           if ($(this).scrollTop() > 250) {
               if (!fixed) {
                   fixed = true;
                   // $('#to-top').css({position:'fixed', display:'block'});
                   $('#to-top').show("slow", function() {
                       $('#to-top').css({
                           position: 'fixed',
                           display: 'block'
                       });
                   });
               }
           } else {
               if (fixed) {
                   fixed = false;
                   $('#to-top').hide("slow", function() {
                       $('#to-top').css({
                           display: 'none'
                       });
                   });
               }
           }
         });
         // Disable Google Maps scrolling
         // See http://stackoverflow.com/a/25904582/1607849
         // Disable scroll zooming and bind back the click event
         var onMapMouseleaveHandler = function(event) {
           var that = $(this);
           that.on('click', onMapClickHandler);
           that.off('mouseleave', onMapMouseleaveHandler);
           that.find('iframe').css("pointer-events", "none");
         }
         var onMapClickHandler = function(event) {
               var that = $(this);
               // Disable the click handler until the user leaves the map area
               that.off('click', onMapClickHandler);
               // Enable scrolling zoom
               that.find('iframe').css("pointer-events", "auto");
               // Handle the mouse leave event
               that.on('mouseleave', onMapMouseleaveHandler);
           }
           // Enable map zooming with mouse scroll when the user clicks the map
         $('.map').on('click', onMapClickHandler);
      </script>
   </body>
</html>