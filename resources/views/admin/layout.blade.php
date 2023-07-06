
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Voting Online</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('style/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/cs-skin-elastic.css') }}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{ asset('style/assets/scss/style.css') }}">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/2f8f6edaba.js" crossorigin="anonymous"></script>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    <link rel="stylesheet" href="http://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
</head>
<body>

        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="{{asset('style/images/logoevot.png')}}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{route('admin.dashboard')}}"><i class="menu-icon fa fa-dashboard"></i>Dashboard</a>

                        @if(auth()->user()->status === 'Super Admin')
                            <a href="{{route('admin.index')}}"><i class="menu-icon fa-solid fa-user"></i>Admin</a>
                            <a href="{{route('banjar.index')}}"><i class="menu-icon fa-solid fa-location-dot"></i>Banjar</a>
                        
                        @else
                            <a href="{{route('penduduk.index')}}"><i class="menu-icon fa-solid fa-users"></i>Penduduk</a>
                            <a href="{{route('penduduk.pemilih')}}"><i class="menu-icon fa-solid fa-id-badge"></i>Pemilih</a>
                            <a href="{{route('token.index')}}"><i class="menu-icon fa-solid fa-key"></i>Token</a>
                            <a href="{{route('kandidat.index')}}"><i class="menu-icon fa-solid fa-person"></i>Kandidat</a>
                            <a href="{{route('hasil-voting')}}"><i class="menu-icon fa-solid fa-bar-chart"></i>Hasil Voting</a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs" style="height: 10vh;">
            <div>
                <div class="w-100 page-header d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        @yield('title')
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="mr-4">
                            <i class="fa-regular fa-user"></i><span class="ml-2">{{auth()->user()->nama}}</span>
                        </div>
                        <div class="ml-4">
                            <form action="{{route('admin.logout')}}" method="post">
                                @csrf
                                <button class="btn" type="submit" style="background: transparent; font-size: 1em; color: red;"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content p-4" style="height: 89vh; overflow:auto;">
            <div class="shadow-lg" style="width: 95%; margin:auto; background-color: white; border-radius: 3px; padding: 1em 0 3em 0;">
                @yield('content')
            </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ asset('style/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('style/https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('style/assets/js/main.js') }}"></script>


    <script src="{{ asset('style/assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('style/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('style/assets/js/widgets.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/vector-map/jquery.vmap.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/vector-map/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/vector-map/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/vector-map/country/jquery.vmap.world.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    {{-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

            $('#tableVote').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );
        })
    </script>

</body>
</html>
