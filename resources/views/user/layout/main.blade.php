@include('admin.layout.header')

@include('admin.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

@include('admin.layout.footer')

@include('admin.layout.control')
