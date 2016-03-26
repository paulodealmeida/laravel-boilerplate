<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
        @include('includes.scripts')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                @include('includes.header')
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                @include('includes.sidebar')
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2015 <a href="http://devibe.com.br">Devibe IT</a>.</strong> All rights reserved.
            </footer>
        </div>
    </body>
</html>