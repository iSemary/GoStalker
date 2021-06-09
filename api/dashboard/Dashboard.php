<?php
session_start();
if (isset($_SESSION['username'])) {
  include '../connect.php';
  include '../init.php';
  include 'infoDash.php';
  if ($_SESSION['id'] == 1) {
  } else {include '../404.php';die();}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      if ($_SESSION['id'] == 1) {

        echo '
        <link href="css/font-face.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
        <link href="css/theme.css" rel="stylesheet" media="all">
        <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
        <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">
        <title>Dashboard</title>
        ';
      } else {}
      ?>
  </head>
    <body>
      <div class="page-wrapper">
          <aside class="menu-sidebar2">
              <div class="logo">
                  <a href="#">
                      <img src="images/icon/logo-white.png" alt="Cool Admin" />
                  </a>
              </div>
              <div class="menu-sidebar2__content js-scrollbar1">
                  <div class="account2">
                      <div class="image img-cir img-120">
                          <img src="images/icon/avatar-big-01.jpg" alt="John Doe" />
                      </div>
                      <h4 class="name">john doe</h4>
                      <a href="#">Sign out</a>
                  </div>
                  <nav class="navbar-sidebar2">
                      <ul class="list-unstyled navbar__list">
                          <li class="active has-sub">
                              <a class="js-arrow" href="#">
                                  <i class="fas fa-tachometer-alt"></i>Dashboard
                                  <span class="arrow">
                                      <i class="fas fa-angle-down"></i>
                                  </span>
                              </a>
                              <ul class="list-unstyled navbar__sub-list js-sub-list">
                                  <li>
                                      <a href="index.html">
                                          <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                                  </li>
                                  <li>
                                      <a href="index2.html">
                                          <i class="fas fa-tachometer-alt"></i>Dashboard 2</a>
                                  </li>
                                  <li>
                                      <a href="index3.html">
                                          <i class="fas fa-tachometer-alt"></i>Dashboard 3</a>
                                  </li>
                                  <li>
                                      <a href="index4.html">
                                          <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
                                  </li>
                              </ul>
                          </li>
                          <li>
                              <a href="inbox.html">
                                  <i class="fas fa-chart-bar"></i>Inbox</a>
                              <span class="inbox-num">3</span>
                          </li>
                          <li>
                              <a href="#">
                                  <i class="fas fa-shopping-basket"></i>eCommerce</a>
                          </li>
                          <li class="has-sub">
                              <a class="js-arrow" href="#">
                                  <i class="fas fa-trophy"></i>Features
                                  <span class="arrow">
                                      <i class="fas fa-angle-down"></i>
                                  </span>
                              </a>
                              <ul class="list-unstyled navbar__sub-list js-sub-list">
                                  <li>
                                      <a href="table.html">
                                          <i class="fas fa-table"></i>Tables</a>
                                  </li>
                                  <li>
                                      <a href="form.html">
                                          <i class="far fa-check-square"></i>Forms</a>
                                  </li>
                                  <li>
                                      <a href="#">
                                          <i class="fas fa-calendar-alt"></i>Calendar</a>
                                  </li>
                                  <li>
                                      <a href="map.html">
                                          <i class="fas fa-map-marker-alt"></i>Maps</a>
                                  </li>
                              </ul>
                          </li>
                          <li class="has-sub">
                              <a class="js-arrow" href="#">
                                  <i class="fas fa-copy"></i>Pages
                                  <span class="arrow">
                                      <i class="fas fa-angle-down"></i>
                                  </span>
                              </a>
                              <ul class="list-unstyled navbar__sub-list js-sub-list">
                                  <li>
                                      <a href="login.html">
                                          <i class="fas fa-sign-in-alt"></i>Login</a>
                                  </li>
                                  <li>
                                      <a href="register.html">
                                          <i class="fas fa-user"></i>Register</a>
                                  </li>
                                  <li>
                                      <a href="forget-pass.html">
                                          <i class="fas fa-unlock-alt"></i>Forget Password</a>
                                  </li>
                              </ul>
                          </li>
                          <li class="has-sub">
                              <a class="js-arrow" href="#">
                                  <i class="fas fa-desktop"></i>UI Elements
                                  <span class="arrow">
                                      <i class="fas fa-angle-down"></i>
                                  </span>
                              </a>
                              <ul class="list-unstyled navbar__sub-list js-sub-list">
                                  <li>
                                      <a href="button.html">
                                          <i class="fab fa-flickr"></i>Button</a>
                                  </li>
                                  <li>
                                      <a href="badge.html">
                                          <i class="fas fa-comment-alt"></i>Badges</a>
                                  </li>
                                  <li>
                                      <a href="tab.html">
                                          <i class="far fa-window-maximize"></i>Tabs</a>
                                  </li>
                                  <li>
                                      <a href="card.html">
                                          <i class="far fa-id-card"></i>Cards</a>
                                  </li>
                                  <li>
                                      <a href="alert.html">
                                          <i class="far fa-bell"></i>Alerts</a>
                                  </li>
                                  <li>
                                      <a href="progress-bar.html">
                                          <i class="fas fa-tasks"></i>Progress Bars</a>
                                  </li>
                                  <li>
                                      <a href="modal.html">
                                          <i class="far fa-window-restore"></i>Modals</a>
                                  </li>
                                  <li>
                                      <a href="switch.html">
                                          <i class="fas fa-toggle-on"></i>Switchs</a>
                                  </li>
                                  <li>
                                      <a href="grid.html">
                                          <i class="fas fa-th-large"></i>Grids</a>
                                  </li>
                                  <li>
                                      <a href="fontawesome.html">
                                          <i class="fab fa-font-awesome"></i>FontAwesome</a>
                                  </li>
                                  <li>
                                      <a href="typo.html">
                                          <i class="fas fa-font"></i>Typography</a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </nav>
              </div>
          </aside>
          <!-- END MENU SidEBAR-->

          <!-- PAGE CONTAINER-->
          <div class="page-container2">
              <!-- HEADER DESKTOP-->
              <header class="header-desktop2">
                  <div class="section__content section__content--p30">
                      <div class="container-fluid">
                          <div class="header-wrap2">
                              <div class="logo d-block d-lg-none">
                                  <a href="#">
                                      <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                                  </a>
                              </div>
                              <div class="header-button2">
                                  <div class="header-button-item js-item-menu">
                                      <i class="zmdi zmdi-search"></i>
                                      <div class="search-dropdown js-dropdown">
                                          <form action="">
                                              <input class="au-input au-input--full au-input--h65" type="text" placeholder="Search for datas &amp; reports..." />
                                              <span class="search-dropdown__icon">
                                                  <i class="zmdi zmdi-search"></i>
                                              </span>
                                          </form>
                                      </div>
                                  </div>
                                  <div class="header-button-item has-noti js-item-menu">
                                      <i class="zmdi zmdi-notifications"></i>
                                      <div class="notifi-dropdown js-dropdown">
                                          <div class="notifi__title">
                                              <p>You have 3 Notifications</p>
                                          </div>
                                          <div class="notifi__item">
                                              <div class="bg-c1 img-cir img-40">
                                                  <i class="zmdi zmdi-email-open"></i>
                                              </div>
                                              <div class="content">
                                                  <p>You got a email notification</p>
                                                  <span class="date">April 12, 2018 06:50</span>
                                              </div>
                                          </div>
                                          <div class="notifi__item">
                                              <div class="bg-c2 img-cir img-40">
                                                  <i class="zmdi zmdi-account-box"></i>
                                              </div>
                                              <div class="content">
                                                  <p>Your account has been blocked</p>
                                                  <span class="date">April 12, 2018 06:50</span>
                                              </div>
                                          </div>
                                          <div class="notifi__item">
                                              <div class="bg-c3 img-cir img-40">
                                                  <i class="zmdi zmdi-file-text"></i>
                                              </div>
                                              <div class="content">
                                                  <p>You got a new file</p>
                                                  <span class="date">April 12, 2018 06:50</span>
                                              </div>
                                          </div>
                                          <div class="notifi__footer">
                                              <a href="#">All notifications</a>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="header-button-item mr-0 js-sidebar-btn">
                                      <i class="zmdi zmdi-menu"></i>
                                  </div>
                                  <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                      <div class="account-dropdown__body">
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-account"></i>Account</a>
                                          </div>
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-settings"></i>Setting</a>
                                          </div>
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-money-box"></i>Billing</a>
                                          </div>
                                      </div>
                                      <div class="account-dropdown__body">
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-globe"></i>Language</a>
                                          </div>
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-pin"></i>Location</a>
                                          </div>
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-email"></i>Email</a>
                                          </div>
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </header>
              <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                  <div class="logo">
                      <a href="#">
                          <img src="images/icon/logo-white.png" alt="Cool Admin" />
                      </a>
                  </div>
                  <div class="menu-sidebar2__content js-scrollbar2">
                      <div class="account2">
                          <div class="image img-cir img-120">
                              <img src="images/icon/avatar-big-01.jpg" alt="John Doe" />
                          </div>
                          <h4 class="name">john doe</h4>
                          <a href="#">Sign out</a>
                      </div>
                      <nav class="navbar-sidebar2">
                          <ul class="list-unstyled navbar__list">
                              <li class="active has-sub">
                                  <a class="js-arrow" href="#">
                                      <i class="fas fa-tachometer-alt"></i>Dashboard
                                      <span class="arrow">
                                          <i class="fas fa-angle-down"></i>
                                      </span>
                                  </a>
                                  <ul class="list-unstyled navbar__sub-list js-sub-list">
                                      <li>
                                          <a href="index.html">
                                              <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                                      </li>
                                      <li>
                                          <a href="index2.html">
                                              <i class="fas fa-tachometer-alt"></i>Dashboard 2</a>
                                      </li>
                                      <li>
                                          <a href="index3.html">
                                              <i class="fas fa-tachometer-alt"></i>Dashboard 3</a>
                                      </li>
                                      <li>
                                          <a href="index4.html">
                                              <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
                                      </li>
                                  </ul>
                              </li>
                              <li>
                                  <a href="inbox.html">
                                      <i class="fas fa-chart-bar"></i>Inbox</a>
                                  <span class="inbox-num">3</span>
                              </li>
                              <li>
                                  <a href="#">
                                      <i class="fas fa-shopping-basket"></i>eCommerce</a>
                              </li>
                              <li class="has-sub">
                                  <a class="js-arrow" href="#">
                                      <i class="fas fa-trophy"></i>Features
                                      <span class="arrow">
                                          <i class="fas fa-angle-down"></i>
                                      </span>
                                  </a>
                                  <ul class="list-unstyled navbar__sub-list js-sub-list">
                                      <li>
                                          <a href="table.html">
                                              <i class="fas fa-table"></i>Tables</a>
                                      </li>
                                      <li>
                                          <a href="form.html">
                                              <i class="far fa-check-square"></i>Forms</a>
                                      </li>
                                      <li>
                                          <a href="#">
                                              <i class="fas fa-calendar-alt"></i>Calendar</a>
                                      </li>
                                      <li>
                                          <a href="map.html">
                                              <i class="fas fa-map-marker-alt"></i>Maps</a>
                                      </li>
                                  </ul>
                              </li>
                              <li class="has-sub">
                                  <a class="js-arrow" href="#">
                                      <i class="fas fa-copy"></i>Pages
                                      <span class="arrow">
                                          <i class="fas fa-angle-down"></i>
                                      </span>
                                  </a>
                                  <ul class="list-unstyled navbar__sub-list js-sub-list">
                                      <li>
                                          <a href="login.html">
                                              <i class="fas fa-sign-in-alt"></i>Login</a>
                                      </li>
                                      <li>
                                          <a href="register.html">
                                              <i class="fas fa-user"></i>Register</a>
                                      </li>
                                      <li>
                                          <a href="forget-pass.html">
                                              <i class="fas fa-unlock-alt"></i>Forget Password</a>
                                      </li>
                                  </ul>
                              </li>
                              <li class="has-sub">
                                  <a class="js-arrow" href="#">
                                      <i class="fas fa-desktop"></i>UI Elements
                                      <span class="arrow">
                                          <i class="fas fa-angle-down"></i>
                                      </span>
                                  </a>
                                  <ul class="list-unstyled navbar__sub-list js-sub-list">
                                      <li>
                                          <a href="button.html">
                                              <i class="fab fa-flickr"></i>Button</a>
                                      </li>
                                      <li>
                                          <a href="badge.html">
                                              <i class="fas fa-comment-alt"></i>Badges</a>
                                      </li>
                                      <li>
                                          <a href="tab.html">
                                              <i class="far fa-window-maximize"></i>Tabs</a>
                                      </li>
                                      <li>
                                          <a href="card.html">
                                              <i class="far fa-id-card"></i>Cards</a>
                                      </li>
                                      <li>
                                          <a href="alert.html">
                                              <i class="far fa-bell"></i>Alerts</a>
                                      </li>
                                      <li>
                                          <a href="progress-bar.html">
                                              <i class="fas fa-tasks"></i>Progress Bars</a>
                                      </li>
                                      <li>
                                          <a href="modal.html">
                                              <i class="far fa-window-restore"></i>Modals</a>
                                      </li>
                                      <li>
                                          <a href="switch.html">
                                              <i class="fas fa-toggle-on"></i>Switchs</a>
                                      </li>
                                      <li>
                                          <a href="grid.html">
                                              <i class="fas fa-th-large"></i>Grids</a>
                                      </li>
                                      <li>
                                          <a href="fontawesome.html">
                                              <i class="fab fa-font-awesome"></i>FontAwesome</a>
                                      </li>
                                      <li>
                                          <a href="typo.html">
                                              <i class="fas fa-font"></i>Typography</a>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </nav>
                  </div>
              </aside>
              <!-- END HEADER DESKTOP-->

              <!-- BREADCRUMB-->
              <section class="au-breadcrumb m-t-75">
                  <div class="section__content section__content--p30">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="au-breadcrumb-content">
                                      <div class="au-breadcrumb-left">
                                          <span class="au-breadcrumb-span">You are here:</span>
                                          <ul class="list-unstyled list-inline au-breadcrumb__list">
                                              <li class="list-inline-item active">
                                                  <a href="#">Home</a>
                                              </li>
                                              <li class="list-inline-item seprate">
                                                  <span>/</span>
                                              </li>
                                              <li class="list-inline-item">Dashboard</li>
                                          </ul>
                                      </div>
                                      <button class="au-btn au-btn-icon au-btn--green">
                                          <i class="zmdi zmdi-plus"></i>add item</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
              <!-- END BREADCRUMB-->

              <!-- STATISTIC-->
              <section class="statistic">
                  <div class="section__content section__content--p30">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-md-6 col-lg-3">
                                  <div class="statistic__item">
                                      <h2 class="number"><?php echo $CountUsersF[0]; ?></h2>
                                      <span class="desc">Members</span>
                                      <div class="icon">
                                          <i class="zmdi zmdi-account-o"></i>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-lg-3">
                                  <div class="statistic__item">
                                      <h2 class="number"><?php echo $CountVotesF[0]; ?></h2>
                                      <span class="desc">Votes</span>
                                      <div class="icon">
                                          <i class="zmdi zmdi-shopping-cart"></i>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-lg-3">
                                  <div class="statistic__item">
                                      <h2 class="number"><?php echo $CountReportF[0]; ?></h2>
                                      <span class="desc">Reports</span>
                                      <div class="icon">
                                          <i class="zmdi zmdi-calendar-note"></i>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 col-lg-3">
                                  <div class="statistic__item">
                                      <h2 class="number"><?php echo $CountMessF[0]; ?></h2>
                                      <span class="desc">total Messages</span>
                                      <div class="icon">
                                          <i class="zmdi zmdi-money"></i>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
              <!-- END STATISTIC-->

              <section>
                  <div class="section__content section__content--p30">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xl-8">
                                  <!-- RECENT REPORT 2-->
                                  <div class="recent-report2">
                                      <h3 class="title-3">Users Gender</h3>
                                      <div class="chart-info">
                                          <div class="chart-info__left">
                                              <div class="chart-note">
                                                  <span class="dot dot--blue"></span>
                                                  <span>Male</span>
                                                  <div><?php echo $CountMenF[0]; ?></div>
                                              </div>
                                              <div class="chart-note">
                                                  <span class="dot dot--green"></span>
                                                  <span>Female</span>
                                                  <div><?php echo $CountWomenF[0]; ?></div>
                                              </div>
                                          </div>
                                          <div class="chart-info-right">
                                              <div class="rs-select2--dark rs-select2--md m-r-10">
                                                  <select class="js-select2" name="property">
                                                      <option selected="selected">All Properties</option>
                                                      <option value="">Products</option>
                                                      <option value="">Services</option>
                                                  </select>
                                                  <div class="dropDownSelect2"></div>
                                              </div>
                                              <div class="rs-select2--dark rs-select2--sm">
                                                  <select class="js-select2 au-select-dark" name="time">
                                                      <option selected="selected">All Time</option>
                                                      <option value="">By Month</option>
                                                      <option value="">By Day</option>
                                                  </select>
                                                  <div class="dropDownSelect2"></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="recent-report__chart">
                                          <canvas id="recent-rep2-chart"></canvas>
                                      </div>
                                  </div>
                                  <!-- END RECENT REPORT 2             -->
                              </div>
                              <div class="col-xl-4">
                                  <!-- TASK PROGRESS-->
                                  <div class="task-progress">
                                      <h3 class="title-3">task progress</h3>
                                      <div class="au-skill-container">
                                          <div class="au-progress">
                                              <span class="au-progress__title">Web Design</span>
                                              <div class="au-progress__bar">
                                                  <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="90">
                                                      <span class="au-progress__value js-value"></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="au-progress">
                                              <span class="au-progress__title">HTML5/CSS3</span>
                                              <div class="au-progress__bar">
                                                  <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="85">
                                                      <span class="au-progress__value js-value"></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="au-progress">
                                              <span class="au-progress__title">WordPress</span>
                                              <div class="au-progress__bar">
                                                  <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                                      <span class="au-progress__value js-value"></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="au-progress">
                                              <span class="au-progress__title">Support</span>
                                              <div class="au-progress__bar">
                                                  <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                                      <span class="au-progress__value js-value"></span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- END TASK PROGRESS-->
                              </div>
                          </div>
                      </div>
                  </div>
              </section>

              <section>
                  <div class="section__content section__content--p30">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xl-6">
                                  <!-- USER DATA-->
                                  <div class="user-data m-b-40">
                                      <h3 class="title-3 m-b-30">
                                          <i class="zmdi zmdi-account-calendar"></i>user data</h3>
                                      <div class="filters m-b-45">
                                          <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                              <select class="js-select2" name="property">
                                                  <option selected="selected">All Properties</option>
                                                  <option value="">Products</option>
                                                  <option value="">Services</option>
                                              </select>
                                              <div class="dropDownSelect2"></div>
                                          </div>
                                          <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                              <select class="js-select2 au-select-dark" name="time">
                                                  <option selected="selected">All Time</option>
                                                  <option value="">By Month</option>
                                                  <option value="">By Day</option>
                                              </select>
                                              <div class="dropDownSelect2"></div>
                                          </div>
                                      </div>
                                      <div class="table-responsive table-data">
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                      <td>
                                                          <label class="au-checkbox">
                                                              <input type="checkbox">
                                                              <span class="au-checkmark"></span>
                                                          </label>
                                                      </td>
                                                      <td>name</td>
                                                      <td>role</td>
                                                      <td>type</td>
                                                      <td></td>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>
                                                          <label class="au-checkbox">
                                                              <input type="checkbox">
                                                              <span class="au-checkmark"></span>
                                                          </label>
                                                      </td>
                                                      <td>
                                                          <div class="table-data__info">
                                                              <h6>lori lynch</h6>
                                                              <span>
                                                                  <a href="#">johndoe@gmail.com</a>
                                                              </span>
                                                          </div>
                                                      </td>
                                                      <td>
                                                          <span class="role admin">admin</span>
                                                      </td>
                                                      <td>
                                                          <div class="rs-select2--trans rs-select2--sm">
                                                              <select class="js-select2" name="property">
                                                                  <option selected="selected">Full Control</option>
                                                                  <option value="">Post</option>
                                                                  <option value="">Watch</option>
                                                              </select>
                                                              <div class="dropDownSelect2"></div>
                                                          </div>
                                                      </td>
                                                      <td>
                                                          <span class="more">
                                                              <i class="zmdi zmdi-more"></i>
                                                          </span>
                                                      </td>
                                                  </tr>
                                                
                                              </tbody>
                                          </table>
                                      </div>
                                      <div class="user-data__footer">
                                          <button class="au-btn au-btn-load">load more</button>
                                      </div>
                                  </div>
                                  <!-- END USER DATA-->
                              </div>
                              <div class="col-xl-6">
                                  <!-- MAP DATA-->
                                  <div class="map-data m-b-40">
                                      <h3 class="title-3 m-b-30">
                                          <i class="zmdi zmdi-map"></i>map data</h3>
                                      <div class="filters">
                                          <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                              <select class="js-select2" name="property">
                                                  <option selected="selected">All Worldwide</option>
                                                  <option value="">Products</option>
                                                  <option value="">Services</option>
                                              </select>
                                              <div class="dropDownSelect2"></div>
                                          </div>
                                          <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                              <select class="js-select2 au-select-dark" name="time">
                                                  <option selected="selected">All Time</option>
                                                  <option value="">By Month</option>
                                                  <option value="">By Day</option>
                                              </select>
                                              <div class="dropDownSelect2"></div>
                                          </div>
                                      </div>
                                      <div class="map-wrap m-t-45 m-b-80">
                                          <div id="vmap" style="height: 284px;"></div>
                                      </div>
                                      <div class="table-wrap">
                                          <div class="table-responsive table-style1">
                                              <table class="table">
                                                  <tbody>
                                                      <tr>
                                                          <td>United States</td>
                                                          <td>$119,366.96</td>
                                                      </tr>
                                                      <tr>
                                                          <td>Australia</td>
                                                          <td>$70,261.65</td>
                                                      </tr>
                                                      <tr>
                                                          <td>United Kingdom</td>
                                                          <td>$46,399.22</td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                          <div class="table-responsive table-style1">
                                              <table class="table">
                                                  <tbody>
                                                      <tr>
                                                          <td>Germany</td>
                                                          <td>$20,366.96</td>
                                                      </tr>
                                                      <tr>
                                                          <td>France</td>
                                                          <td>$10,366.96</td>
                                                      </tr>
                                                      <tr>
                                                          <td>Russian</td>
                                                          <td>$5,366.96</td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- END MAP DATA-->
                              </div>
                          </div>
                      </div>
                  </div>
              </section>

              <section>
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="copyright">
                                  <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
              <!-- END PAGE CONTAINER-->
          </div>

      </div>
    </body>
</html>
