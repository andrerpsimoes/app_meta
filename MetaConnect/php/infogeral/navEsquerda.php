<?php

include("restrito.php");

$_SESSION["tipoconta"]; 

if($_SESSION["tipoconta"] == 1){
    $tipoconta = 'Utilizador';
}elseif ($_SESSION["tipoconta"] == 2) {
    $tipoconta = 'Gestor';
}elseif($_SESSION["tipoconta"] == 3){
    $tipoconta = 'Administrador';
}else{
    $tipoconta = '';
}

?>

<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav leftside-navigation">
        <li class="user-details cyan darken-2">
              <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images/fotos/<?php echo $_SESSION["foto"];?>" alt="" class="circle responsive-img valign profile-image cyan">
                </div>
                <div class="col col s8 m8 l8">
                  <ul id="profile-dropdown-nav" class="dropdown-content">
                    <li>
                      <a href="perfil.php" class="grey-text text-darken-1">
                        <i class="material-icons">face</i> Perfil</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="logout.php" class="grey-text text-darken-1">
                        <i class="material-icons">keyboard_tab</i> Sair</a>
                    </li>
                  </ul>
                  <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown-nav"><?php echo $_SESSION["nome"]; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                  <p class="user-roal"><?php echo $tipoconta; ?></p>
                </div>
              </div>
            </li>
        <li class="no-padding">
            <ul class="collapsible" data-collapsible="accordion">
                <li class="bold">
                    <a href="calendario.php" class="waves-effect waves-cyan">
                        <i class="material-icons">today</i>
                        <span class="nav-text">Calendário</span>
                    </a>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan">
                        <i class="material-icons">assistant</i>
                        <span class="nav-text">Serviços</span>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li class="bold">
                                <a href="levantamento.php">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>Levantamento</span>
                                </a>
                            </li>
                            <li class="bold">
                                <a href="assistencia.php">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>Assistência</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <a href="projeto.php" class="waves-effect waves-cyan">
                        <i class="material-icons">open_in_new</i>
                        <span class="nav-text">Projetos</span>
                    </a>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan">
                        <i class="material-icons">assistant</i>
                        <span class="nav-text">Gestão de Serviços</span>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li class="bold">
                                <a href="gestaoLevantamentos.php">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>Gestão de Levantamentos</span>
                                </a>
                            </li>
                            <li class="bold">
                                <a href="gestaoAssistencias.php">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>Gestão de Assistências</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <a href="historico.php" class="waves-effect waves-cyan">
                        <i class="material-icons">history</i>
                        <span class="nav-text">Histórico</span>
                    </a>
                </li>
                <li class="bold">
                    <a href="#" class="waves-effect waves-cyan">
                        <i class="material-icons">mail_outline</i>
                        <span class="nav-text">Mailbox</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light pink accent-2">
        <i class="material-icons">menu</i>
    </a>
</aside>