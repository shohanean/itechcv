<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>iTechCV</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="iTechCV.com is the Only Tech CV Bank & job site where the technical professionals and prominent companies meet to fulfill their needs. " name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

        <!-- App css -->
        <link href="{{ url('/') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="{{ url('/') }}/assets/js/modernizr.min.js"></script>

    </head>


    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('{{ url('/') }}/assets/images/bg-image.jpg');background-size: cover;background-position: center;"></div>
        <div class="wrapper-page account-page-full" style="overflow:scroll">

            <div class="card">
                <div class="card-block">

                    <div class="account-box">
                        @yield('content')
                    </div>

                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
        <script src="{{ url('/') }}/assets/js/popper.min.js"></script>
        <script src="{{ url('/') }}/assets/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/assets/js/metisMenu.min.js"></script>
        <script src="{{ url('/') }}/assets/js/waves.js"></script>
        <script src="{{ url('/') }}/assets/js/jquery.slimscroll.js"></script>

        <!-- App js -->
        <script src="{{ url('/') }}/assets/js/jquery.core.js"></script>
        <script src="{{ url('/') }}/assets/js/jquery.app.js"></script>
        @yield('footer_js')

    </body>
</html>
