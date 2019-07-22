@include('user.layout.header')

@include('user.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

@include('user.layout.footer')

@include('user.layout.control')
