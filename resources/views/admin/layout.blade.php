<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield("title","Trang quản trị hệ thống")</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("before_css")
    @include('admin.html.css')
    @yield("after_css")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.html.nav')

    <!-- Main Sidebar Container -->
    @include('admin.html.aside')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                @yield("content-header")
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
               @yield("main-content")
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.html.footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
   @yield("before_js")
   @include('admin.html.scripts')
   @yield("after_js")
</body>
</html>
