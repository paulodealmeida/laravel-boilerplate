<!-- jQuery 2.2.3 -->
{!! Html::script('assets/plugins/jQuery/jquery-2.2.3.min.js') !!}
<!-- jQuery UI 1.11.4 -->
{!! Html::script('assets/plugins/jQueryUI/jquery-ui.min.js') !!}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);</script>
<!-- Bootstrap 3.3.6 -->
{!! Html::script('assets/bootstrap/js/bootstrap.min.js') !!}

<!-- Sparkline -->
{!! Html::script('assets/plugins/sparkline/jquery.sparkline.min.js') !!}

<!-- daterangepicker -->
{!! Html::script('assets/plugins/moment/moment.min.js') !!}
{!! Html::script('assets/plugins/daterangepicker/daterangepicker.js') !!}
<!-- datepicker -->
{!! Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') !!}
<!-- Slimscroll -->
{!! Html::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') !!}
<!-- FastClick -->
{!! Html::script('assets/plugins/fastclick/fastclick.min.js') !!}
<!-- CodeSeven Toastr -->
{!! Html::script('assets/plugins/toastr/build/toastr.min.js') !!}
<!-- Sweet Alert -->
{!! Html::script('assets/plugins/sweetalert/dist/sweetalert.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('assets/js/app.min.js') !!}

@yield('scripts') 