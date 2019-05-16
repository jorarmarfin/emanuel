<!doctype html>
<html class="fixed has-top-menu">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Emanuel</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/animate/animate.css') }}">

		<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/fontawesome-all.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.theme.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/morris/morris.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/pnotify/pnotify.custom.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('css/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header header-nav-menu">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="{{ asset('img/logo.png') }}" width="75" height="35" alt="Porto Admin" />
					</a>
					<button class="btn header-btn-collapse-nav d-lg-none" data-toggle="collapse" data-target=".header-nav">
						<i class="fas fa-bars"></i>
					</button>
			
					<!-- start: header nav menu -->
					<div class="header-nav collapse">
						<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
							<nav>
								<ul class="nav nav-pills" id="mainNav">
									<li class="dropdown active">
									    <a class="nav-link" href="{{ route('home') }}">
									        Dashboard
										</a>  
									</li>
									<li class="dropdown">
									    <a class="nav-link dropdown-toggle" href="#">
									        Caja
									    </a>
									    <ul class="dropdown-menu">
									        <li>
									            <a class="nav-link" href="{{ route('caja.dashboard') }}">
									                Dashboard
									            </a>
									        </li>
									        <li>
									            <a class="nav-link" href="{{ route('balance') }}">
									                Balance mensual
									            </a>
									        </li>
									        <li>
									            <a class="nav-link" href="{{ route('deudas.dashboard') }}">
									                Deudas
									            </a>
									        </li>
									    </ul>
									</li>
									<li class="dropdown">
									    <a class="nav-link dropdown-toggle" href="#">
									        Actividad economica
									    </a>
									    <ul class="dropdown-menu">
									        <li>
									            <a class="nav-link" href="{{ route('actividad.lista') }}">
									                Lista
									            </a>
									        </li>
									        <li>
									            <a class="nav-link" href="pages-signup.html">
									                Tarjetas
									            </a>
									        </li>
									    </ul>
									</li>
									<li class="">
									    <a class="nav-link " href="{{ route('movimientos') }}">
									        Movimientos
									    </a>
									</li>
									<li class="">
									    <a class="nav-link " href="{{ route('deudas.index') }}">
									        Deudas
									    </a>
									</li>
									
									
								</ul>
							</nav>
						</div>
					</div>
					<!-- end: header nav menu -->
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<a class="btn search-toggle d-none d-md-inline-block d-xl-none" data-toggle-class="active" data-target=".search"><i class="fas fa-search"></i></a>
					<form action="pages-search-results.html" class="search nav-form d-none d-xl-inline-block">
						<div class="input-group">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-append">
								<button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>

                    <div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<div class="profile-info" data-lock-name="{{ Auth::user()->name }}" data-lock-email="johndoe@okler.com">
								<span class="name">{{ Auth::user()->name }}</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Emanuel > @yield('titulo-pagina','')</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="/">
										<i class="fas fa-home"></i>
									</a>
								</li>
							</ol>
					
							<a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					@yield('content')
					<!-- end: page -->
				</section>
			</div>


		</section>

		<!-- Vendor -->
		<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('vendor/popper/umd/popper.min.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
		<script src="{{ asset('vendor/common/common.js') }}"></script>
		<script src="{{ asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
		<script src="{{ asset('vendor/jquery-placeholder/jquery-placeholder.js') }}"></script>
		
		<!-- Specific Page Vendor -->
		<script src="{{ asset('vendor/jquery-ui/jquery-ui.js') }}"></script>
		<script src="{{ asset('vendor/jqueryui-touch-punch/jqueryui-touch-punch.js') }}"></script>
		<script src="{{ asset('vendor/jquery-appear/jquery-appear.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
		<script src="{{ asset('vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('vendor/flot.tooltip/flot.tooltip.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ asset('vendor/jquery-sparkline/jquery-sparkline.js') }}"></script>
		<script src="{{ asset('vendor/raphael/raphael.js') }}"></script>
		<script src="{{ asset('vendor/morris/morris.js') }}"></script>
		<script src="{{ asset('vendor/gauge/gauge.js') }}"></script>
		<script src="{{ asset('vendor/snap.svg/snap.svg.js') }}"></script>
		<script src="{{ asset('vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>
		<script src="{{ asset('vendor/pnotify/pnotify.custom.js') }}"></script>
		<script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
		<script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('js/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ asset('js/custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('js/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ asset('js/examples/examples.header.menu.js') }}"></script>
		<script src="{{ asset('js/examples/examples.dashboard.js') }}"></script>
		@yield('scripts')

	</body>
</html>