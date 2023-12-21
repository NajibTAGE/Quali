
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/cdg1.png' />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/progress.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.dataTables.min.css">
  </head>

<body>
  <div id="app">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">   
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
            class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
            @if ($notificationscount > 0)
            <span class="badge headerBadge1" style="background-color: #c40404">{{ $notificationscount }}</span> </a>
            @endif
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header"> Notifications </div>
              <div class="dropdown-footer text-center">
                <a href="notification">Voir plus<i class="fas fa-chevron-right"></i></a>
              </li> 
          <li class="dropdown"><a href="correcteur" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/icone/utilisateur.png"
                > <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
             
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Deconnextion') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="correcteur"> <img alt="image" src="assets/img/logo.png" class="header-logo" style="height: 66px" /> </a>
          </div>
        <br>
        <br>
        <br>

          <ul class="sidebar-menu">
            <li class="dropdown">
              <a href="correcteur" class="nav-link"><i data-feather="file-minus"></i><span>Recommandations</span></a>
            </li>
            <li class="dropdown">
                <a href="notification" class="nav-link"><i data-feather="bell"></i><span>Notifications</span></a>
              </li>
          </ul>
        </aside>
      </div>
      
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/info.js"></script>
  <script src="assets/js/search1.js"></script>
  <script src="assets/js/table/admin.js"></script>
</body>
@yield('content')
</html>