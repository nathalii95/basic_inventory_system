<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>M&E (Papeleria y Suministro)</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" media="all">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}" media="all"> 
    <script src="https://kit.fontawesome.com/a1c839e625.js" crossorigin="anonymous" ></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('css/databledisign.css')}}" media="all" >
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}" media="print">
    <link rel="logo" href="{{asset('img/logo.png')}} ">
    <link rel="logo" href="{{asset('img/logo.png')}}">
    <!-- Datatable-->
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}" media="all">
    <!-- Datatable Buttones-->
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}" media="all">
           <!-- Datatable Time-->
    <link rel="stylesheet" href="{{asset('css/dataTables.dateTime.min.css')}}" media="all">
     <!-- Datatable Filter head-->
     <link rel="stylesheet" href="{{asset('css/fixedHeader.dataTables.min.css')}}" media="all">
         <!-- Datatable resposave-->
         <link rel="stylesheet" href="{{asset('css/responsive.dataTables.min.css')}}" media="all">

         <link  href="{{asset('css/toastr.css')}}" rel="stylesheet">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{URL::action('InicioController@index')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">M<b>&</b>E</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>M&E</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- <small class="bg-red">Online</small> -->
                  <span class="hidden-xs">{{ Auth::user()->name }}  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                 <li class="user-header">
                    <img src="{{asset('imagenes/usuarios/'.Auth::user()->imagen)}}" alt="{{Auth::user()->imagen}}" height="50px" width="50px" class="img-thumbnail"><br>
                    <p>
                   Correo: {{ Auth::user()->email }}<br>
                   C.I. {{ Auth::user()->cedula }}<br>
                    @if(Auth::user()->id_cargo== "1")	
										Cargo: ADMINISTRADOR
											@else
										Cargo: VENDEDOR
											@endif
                   </p> <!-- - {{ Auth::user()->id_cargo }} -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{url('logout')}}" class="btn btn-warning">CERRAR</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
           
            <li class="treeview">
                <a href="{{URL::action('InicioController@index')}}">
                  <i  class="fa fa-home"></i>
                  <span>Inicio</span>
              </a>
            </li>
           	
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
              @if(Auth::user()->id_cargo== "1")
                <li><a href="{{URL::action('ArticuloController@index')}}"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="{{URL::action('CategoriaController@index')}}"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="{{URL::action('HistorialProController@index')}}"><i class="fa fa-circle-o"></i> Historial Productos</a></li>
             
               @else
               <li><a href="{{URL::action('ArticuloController@index')}}"><i class="fa fa-circle-o"></i> Productos</a></li>
               <li><a href="{{URL::action('HistorialProController@index')}}"><i class="fa fa-file"></i>  Historial Productos</a></li>
             
                @endif 
                <li><a href="{{URL::action('IndicadorProductController@index')}}"><i class="fa fa-file" aria-hidden="true"></i>Indicadores</a></li>
              </ul>
            </li>
            @if(Auth::user()->id_cargo== "1")
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::action('IngresoController@index')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="{{URL::action('ProveedorController@index')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="{{URL::action('DevolucionComController@index')}}"><i class="fa fa-circle-o"></i>Detalle Devolución</a></li>
                <li><a href="{{URL::action('IndicadorCompraController@index')}}"><i class="fa fa-file" aria-hidden="true"></i>Indicadores</a></li>
              </ul>
            </li>
            @endif 


            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::action('VentaController@index')}}"><i class="fa fa-circle-o"></i> Ventas</a></li>
                @if(Auth::user()->id_cargo== "1")
                <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                
                @endif 
                <li><a href="{{URL::action('DevolucionVenController@index')}}"><i class="fa fa-circle-o"></i>Detalle Devolución</a></li>
                <li><a href="{{URL::action('IndicadorVentasController@index')}}"><i class="fa fa-file" aria-hidden="true"></i>Indicadores</a></li>
             </ul>
            </li>
            @if(Auth::user()->id_cargo== "1")    
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::action('UsuarioController@index')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="{{URL::action('EmpresaController@index')}}"><i class="fa fa-circle-o"></i> Empresa</a></li>
                <li><a href="{{URL::action('SucursalController@index')}}"><i class="fa fa-circle-o"></i> Sucursal</a></li>
              </ul>
            </li>
            @endif 
            @if(Auth::user()->id_cargo!= "1")
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Activos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">            
                <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-circle-o"></i>Clientes</a></li>
              </ul>
            </li>
            @endif 
<!--              <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Reporte</span> 
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li> -->

  <!--           <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li> -->
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                 <!--  <h3 class="box-title">Sistema de Ventas</h3> -->
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
<!--<h3>Contenido</h3>-->  @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0 SystemTesis
        </div>
        <strong>Copyright &copy; 2021-2022
      </footer>

      
<!-- jQuery 2.1.4 -->

   <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script> 
@stack('scripts')    <!-- Bootstrap 3.3.5 -->

     <script src="{{asset('js/toastr.min.js')}}"></script> 
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <!--DataTables 1.11.4-->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
       <!-- Datatable Buttones-->
       <script src="{{asset('js/pdfmake.min.js')}}"></script>
       <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
       <script src="{{asset('js/buttons.colVis.min.js')}}"></script>
       <script src="{{asset('js/buttons.html5.min.js')}}"></script>
       <script src="{{asset('js/buttons.print.min.js')}}"></script>
       <script src="{{asset('js/vfs_fonts.js')}}"></script>
       <script src="{{asset('js/jszip.min.js')}}"></script>
       <!-- Datatable Time-->
       <script src="{{asset('js/dataTables.dateTime.min.js')}}"></script>
       <!-- Datatable Filter head-->
       <script src="{{asset('js/dataTables.fixedHeader.min.js')}}"></script>
              <!-- Datatable responsive-->
              <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>

        <!-- Datatable General-->
       <script src="{{asset('js/dataJs.js')}}"></script>
         <script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
         
 
  </body>
</html>
