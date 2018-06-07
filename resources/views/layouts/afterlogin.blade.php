<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>@yield('judul')</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet">

    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


<body>
<section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="index.html" class="logo"><b>SIGPen</b></a>
        <!--logo end-->
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </header>
    <!--header end-->

    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <?php
            if(Auth::user()->IdLevel == 1 ) { ?>
            <ul class="sidebar-menu" id="nav-accordion">
                {{--<p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>--}}
                <h5 class="centered">{{Auth::user()->name}}</h5>

                <li class="mt">
                    <a href="/home">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="/puskesmas" >
                        <i class="fa fa-desktop"></i>
                        <span>Puskesmas</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="/pendistribusian" >
                        <i class="fa fa-cogs"></i>
                        <span>Monitoring Pendistribusian</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="/user" >
                        <i class="fa fa-book"></i>
                        <span>Monitoring Kurir</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
            <?php
            }else if(Auth::user()->IdLevel == 2 ) { ?>
            <ul class="sidebar-menu" id="nav-accordion">
                {{--<p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>--}}
                <h5 class="centered">{{Auth::user()->name}}</h5>

                <li class="mt">
                    <a href="/home">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="/puskesmas" >
                        <i class="fa fa-desktop"></i>
                        <span>Puskesmas</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="/jarak" >
                        <i class="fa fa-cogs"></i>
                        <span>Jarak</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="/pendistribusianuser" >
                        <i class="fa fa-book"></i>
                        <span>Pendistribusian</span>
                    </a>
                </li>
            </ul>
            <?php } ?>
        </div>
    </aside>
    <!--sidebar end-->
    @yield('content')
    <footer class="site-footer">
        <div class="text-center">
            2017 - Anisa Dz
            <a class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
    </section>

            <!-- jQuery -->

    <!-- js placed at the end of the document so the pages load faster -->

    <script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/js/jquery.scrollTo.min.js"></script>
    <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="/js/common-scripts.js"></script>

    <script type="text/javascript" src="/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="/js/sparkline-chart.js"></script>
    <script src="/js/zabuto_calendar.js"></script>

</body>

</html>
