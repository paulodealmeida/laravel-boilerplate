<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>title</b></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </div>
                @endif
                <form role="form" method="POST" action="{{ url('password/email') }}">
                    {!! csrf_field() !!}
                    <div class="form-group has-feedback">
                        <input name="email" type="email" class="form-control" placeholder="Email" />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar link para recuperar senha</button>
                    </div>
                </form>
                <div class="form-group">
                    <button type="button" class="btn btn-danger btn-block btn-flat" onclick="window.open('{{ url('auth/login') }}', '_self');">Voltar</button>
                </div>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
        <script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
        </script>
    </body>
</html>
