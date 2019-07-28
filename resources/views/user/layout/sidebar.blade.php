  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ (request()->routeIs('home')) ? 'active' : '' }}">
          <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview {{ (request()->routeIs('kategori.*')) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->routeIs('kategori.*')) ? 'active' : '' }}"><a href="{{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Kategori</a></li>
          </ul>
        </li>
        <li class="treeview {{ (request()->routeIs('expense.*') || request()->routeIs('income.*')) ? 'active menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Dompet</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (request()->routeIs('expense.*')) ? 'active' : '' }}"><a href="{{ route('expense.index') }}"><i class="fa fa-circle-o"></i> Pengeluaran (Expense)</a></li>
            <li class="{{ (request()->routeIs('income.*')) ? 'active' : '' }}"><a href="{{ route('income.index') }}"><i class="fa fa-circle-o"></i> Pemasukan (Income)</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Laporan Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Pengeluaran (Expense)</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Pemasukan (Income)</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">SETTING ACCOUNT</li>
        <li {{ (request()->routeIs('profile.*')) ? 'active' : '' }}><a href="{{ route('profile.form_ubah_password') }}"><i class="fa fa-circle-o text-red"></i> <span>Ubah Password</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Reset Password</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
