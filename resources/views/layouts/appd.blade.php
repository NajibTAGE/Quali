
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
      <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/progress.css') }}">
      
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
            <li>
           
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          
          
          
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('assets/img/icone/utilisateur.png') }}"
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
            <a href="home"> <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo" style="height: 66px" /> </a>
          </div>
        <br>
        <br>
        <br>
          <ul class="sidebar-menu">
          </ul>
        </aside>
      </div>
      
      <script src="{{ asset('assets/js/app.min.js') }}"></script>
      <script src="{{ asset('assets/js/scripts.js') }}"></script>
      <script src="{{ asset('assets/js/custom.js') }}"></script>
      <script src="{{ asset('assets/js/info.js') }}"></script>
      <script src="{{ asset('assets/js/detail.js') }}"></script>
      <script src="{{ asset('assets/js/search1.js') }}"></script>
      <script src="{{ asset('assets/js/table/admin.js') }}"></script>
      
</body>
@yield('content')
</html>