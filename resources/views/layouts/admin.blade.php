<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet" type="text/css">
    <title>@yield('title')</title>
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .table td .btn{ padding: 0 5px; }
        .table td, .table th { 
          padding: .2rem .3rem!important;
          color: black;
        }
    </style>


    <!-- Styles -->   
    <link href="{{ asset('css/framework/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/framework/ADM-dateTimePicker.min.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script src="{{ asset('js/framework/jquery.min.js') }}"></script>
    <script src="{{ asset('js/framework/angular.min.js') }}"></script>
    <script src="{{ asset('js/framework/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <style>
    #loading.showLoading{
        display:block !important;
        background: #00000073 !important;
    }    
    #loading.showLoading span{ display:none;}

.loadingContent {
    position: fixed;
    height: 100%;
    width: 100%;
    padding-top: 10%;
    background-color: white;
    z-index: 100000;
}
.loadingContent .loader {
    position: relative;
    left: 0;
    width: 100%;
    text-align: center;
    clear: both;
}
.loadingContent .loader img {
    display: block;
    margin: 0 auto;
}
.loadingContent span {
    position: relative;
    left: 0;
    width: 100%;
    text-align: center;
    font-size: 1.5em;
    font-family: Futura,sans-serif;
    color: dimgray;
}
    
.lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-spinner div {
  transform-origin: 32px 32px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 29px;
  width: 5px;
  height: 14px;
  border-radius: 20%;
  background: #00695c;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

.form-control{
  border: 1.5px solid #00000036;
}

.sidebar-dark .nav-item .nav-link{
  padding: .6rem 1rem;
}
.chip {
    display: block;
    width: 100%;
    text-align: center;
    vertical-align: middle;
    padding: .5em 1em;
    background-color: lightgrey;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: black;
    font-weight: bold;
    border-radius: 6px;
}
.topbar .navbar-search{
  width: 30rem;
}
.modal-content{
  border: 0;
}
.modal-header{
    background: #0d47a1;
    color: white;
    border-radius: 0;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: white;
    background-color: #0d47a1;
    border-color: #dddfeb #dddfeb #fff;
}
.modal .modal-dialog{
  -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
  -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
  box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75)
}
.modal-backdrop.show {
    opacity: 1;
    background: #f1f1f1;
}
.modal-header .close{
    opacity: 1;
    color: red;
}
    </style>

    @yield('style')

  </head>
  <body id="page-top" >
            
  <div id="loading" class="loadingContent text-center" >
      <div class="loader">
          <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      </div>
      <span>
        Cargando...
         {{-- <img src="/logo.png" height="80" ></img>  --}}
      </span>
  </div>  

      <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <div class="text-center mt-2">
        <img src="/img/escudo.png" alt="Escudo"  height="90" >
      </div>
      
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard" >
          <div class="sidebar-brand-text mx-3"> SISBANPROYEC {{env('MUNICIPIO')}} </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Proyectos
      </div>

      <li class="nav-item">
        <a class="nav-link" href="/proyectos/listado">
          <i class="fas fa-list-ul"></i>
          <span>Listado proyecto</span></a>
          
          <a class="nav-link pt-0 pl-5" href="/proyectos/crear">
            <i class="fas fa-plus"></i>
            <span>Crear proyecto</span></a>
            
      </li>

      
      <li class="nav-item">
          <a class="nav-link" href="/FuentesRecursos/listado">
            <i class="fas fa-dollar-sign"></i>
            <span>Fuentes de recursos</span></a>            
      </li>

      <li class="nav-item">
          <a class="nav-link" href="/cdps/listado">
            <i class="fas fa-money-check-alt"></i>
            <span>CDPS</span></a>
      </li>
      
      


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Reportes
      </div>


      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="/Reporte/CDPS">
          <i class="fas fa-fw fa-table"></i>
          <span>CDPS</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/Reporte/FuentesRecursos">
          <i class="fas fa-fw fa-table"></i>
          <span>Fuentes recursos</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/Reporte/Proyectos">
          <i class="fas fa-fw fa-table"></i>
          <span>Proyectos</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="nav" >

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <h2>@yield('title')</h2>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/dashboard" >
                      <i class="fas fa-tachometer-alt"></i>  Dashboard
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                        <i class="fas fa-sign-out-alt"></i>  Cerra sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <main @yield('app')  @yield('controller') id="main" >
                @yield('content')
            </main>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white shadow">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SISBANPROYEC 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield("script")

    <script src="{{ asset('js/framework/sweetalert.min.js') }}"></script>
    <!--
    <script src="{{ asset('js/framework/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/framework/dirPagination.js') }}"></script>
    <script src="{{ asset('js/framework/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/framework/ng-ckeditor.js') }}"></script>
    <script src="{{ asset('js/framework/ADM-dateTimePicker.min.js') }}"></script>
    -->

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (event) { 
          $('#loading').delay(500).hide();
        });
    </script>
    <script>
      $('input:file').on('change',function(){
              //get the file name
              var fileName = $(this).val();
              //replace the "Choose a file" label
              $(this).next('.custom-file-label').html(fileName);
          });
    </script>

</body>
</html>