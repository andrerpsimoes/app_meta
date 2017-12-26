<!-- Start Page Loading -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End Page Loading -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START HEADER -->
<header id="header" class="page-topbar">
    <div class="navbar-fixed">
        <nav class="navbar-color">
            <div class="nav-wrapper">
                <ul class="left">
                    <li>
                        <h1 class="logo-wrapper">
                            <a href="page-principal.php" class="brand-logo darken-1">
                                <img src="images/logo/materialize-logo.png">
                                <span class="logo-text hide-on-med-and-down">ServPro</span>
                            </a>
                        </h1>
                    </li>
                </ul>
                <div class="header-search-wrapper hide-on-med-and-down sideNav-lock">
                    <i class="material-icons">search</i>
                    <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Pesquisar" />
                </div>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown">
                            <span class="flag-icon flag-icon-pt"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen">
                            <i class="material-icons">settings_overscan</i>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php" class="waves-effect waves-block waves-light waves-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Sair">
                            <!--<a class="btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am a tooltip">Hover me!</a>-->
                            <i class="material-icons">keyboard_tab</i>
                        </a>
                    </li>
                    <!--
                    <li>
                      <a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown">
                        <i class="material-icons">notifications_none
                          <small class="notification-badge pink accent-2">5</small>
                        </i>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="waves-effect waves-block waves-light profile-button" data-activates="profile-dropdown">
                        <span class="avatar-status avatar-online">
                          <img src="../../images/avatar/avatar-7.png" alt="avatar">
                          <i></i>
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse">
                        <i class="material-icons">format_indent_increase</i>
                      </a>
                    </li>-->
                </ul>
                <!-- notifications-dropdown -->
                <ul id="notifications-dropdown" class="dropdown-content">
                    <li>
                        <h6>NOTIFICATIONS
                            <span class="new badge">5</span>
                        </h6>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#!" class="grey-text text-darken-2">
                            <span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                    </li>
                    <li>
                        <a href="#!" class="grey-text text-darken-2">
                            <span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                    </li>
                    <li>
                        <a href="#!" class="grey-text text-darken-2">
                            <span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                    </li>
                    <li>
                        <a href="#!" class="grey-text text-darken-2">
                            <span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                    </li>
                    <li>
                        <a href="#!" class="grey-text text-darken-2">
                            <span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                    </li>
                </ul>
                <!-- profile-dropdown -->
                <ul id="profile-dropdown" class="dropdown-content">
                    <li>
                        <a href="#" class="grey-text text-darken-1">
                            <i class="material-icons">face</i> Profile</a>
                    </li>
                    <li>
                        <a href="#" class="grey-text text-darken-1">
                            <i class="material-icons">settings</i> Settings</a>
                    </li>
                    <li>
                        <a href="#" class="grey-text text-darken-1">
                            <i class="material-icons">live_help</i> Help</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#" class="grey-text text-darken-1">
                            <i class="material-icons">lock_outline</i> Lock</a>
                    </li>
                    <li>
                        <a href="#" class="grey-text text-darken-1">
                            <i class="material-icons">keyboard_tab</i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->
<script>
    $(document).ready(function () {
        $('.tooltipped').tooltip({delay: 50});
    });
</script>