<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
{!! Html::style('assets/bootstrap/css/bootstrap.min.css') !!}
<!-- Font Awesome -->
{!! Html::style('assets/css/font-awesome-4.7.0/css/font-awesome.min.css') !!}
<!-- Ionicons -->
{!! Html::style('assets/css/ionicons-2.0.1/css/ionicons.min.css') !!}
<!-- Theme style -->
{!! Html::style('assets/css/AdminLTE.min.css') !!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
{!! Html::style('assets/css/skins/_all-skins.min.css') !!}
<!-- iCheck -->
{!! Html::style('assets/plugins/iCheck/flat/blue.css') !!}
<!-- Date Picker -->
{!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}
<!-- Daterange picker -->
{!! Html::style('assets/plugins/daterangepicker/daterangepicker.css') !!}
<!-- CodeSeven Toastr -->
{!! Html::style('assets/plugins/toastr/build/toastr.min.css') !!}
<!-- Sweet Alert -->
{!! Html::style('assets/plugins/sweetalert/dist/sweetalert.css') !!}

@yield('style')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->