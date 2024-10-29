<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Task Management</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}">
 
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('image/logo.png')}}" />
  <!-- <script src="{{asset('js/jquery-ajax.min.js')}}"></script> -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}"/>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

  <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">

  @yield('css')
</head>

<body>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
       <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo text-white" href="{{route('dashboard')}}"><img src="{{asset('image/logo.png')}}" alt="logo"/>Task Portal</a>
          <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}"><img src="{{asset('image/logo.png')}}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </div>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul lass="navbar-nav navbar-nav-left" style="margin: 0px auto;">
          <!-- <li class="single-info-box" style="display: inline-block; padding: 0px 10px;">
              <img style="height: 56px; margin-top: 10px;" src="{{asset('user_end_files/images/logog20.png')}}" alt="Awesome Logo">
          </li>
          <li class="single-info-box" style="display: inline-block; padding: 0px 10px;">
               <img style="height: 56px; margin-top: 10px;" src="{{asset('user_end_files/images/logo12.png')}}" alt="Awesome Logo">
          </li> -->
        </ul>    
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-date dropdown">
            <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
              <h6 class="date mb-0">Today : {{ date('d M, Y  h:i A') }}</h6>
              <i class="typcn typcn-calendar"></i>
            </a>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                @php 
                    $user = Auth::user();
                  @endphp
              <img src="{{asset('image/user.png')}}" alt="profile"/>
              
              <span class="nav-profile-name"> {{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              
              	<a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </li>
        
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
   
    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('dashboard')}}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('boards.index') }}">
                <i class="typcn typcn-news menu-icon"></i>
                <span class="menu-title">Board Management</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="typcn typcn-user-outline menu-icon"></i>
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">User</a></li>
                </ul>
              </div>
            </li> --><!-- 
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#my_space" aria-expanded="false" aria-controls="my_space">
                <i class="typcn typcn-news menu-icon"></i>
                <span class="menu-title">My Space</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="my_space">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">Personal Information</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">PF</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Payslip</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">perquisite</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Personal calendar/scheduler</a></li>
                </ul>
              </div>
            </li> -->
        </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
      </div>
        <!-- main-panel ends -->
     
        <!-- container-scroller -->
               
          <!-- <main class="py-6"> -->
              
          <!-- </main> -->
    </div>
  </div>
    
    <!-- base:js -->
 <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->


  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script src="{{asset('js/jquery-ui.js')}}"></script>

  <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('js/template.js')}}"></script>
  <script src="{{asset('js/settings.js')}}"></script>
  <script src="{{asset('js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- <script src="{{asset('js/dashboard.js')}}"></script> -->
  <script src="{{asset('js/tabs.js')}}"></script>
  
  <!-- endinject -->
  <!-- Custom js for this page-->
  
  <!-- End custom js for this page-->
  <!-- Datatable -->
  
  


    @stack('scripts')
</body>
</html>
