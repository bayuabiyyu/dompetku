@extends('user.layout.main')

{{-- FOR CSS SCRIPT ETC --}}
@push('cssPage')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endpush

{{-- FOR TITLE PAGE --}}
@section('titlePage')
    Dompetku | Ubah Password
@endsection

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Profile Ubah Password
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Examples</a></li>
              <li class="active">Blank page</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">

            <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Form Ubah Password</h3>
                        </div>
                        <!-- /.box-header -->
                        <div id="alert-validation" class="alert alert-warning" style="display:none">
                                {{-- ALERT MESSAGE --}}
                            </div>
                        <!-- form start -->
                        <form role="form" action="{{ route('profile.action_ubah_password') }}" method="POST" id="form-ubah-password">
                          <div class="box-body">

                            <div class="form-group">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
                            </div>

                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password Baru">
                            </div>

                            <div class="form-group">
                                <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password Baru">
                            </div>
                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            <!-- MODAL FORM -->
            <div class="modal fade" id="modal-information">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" align="center">INFORMATION</h4>
                            <div id="alert-validation" class="alert alert-warning" style="display:none">
                                {{-- ALERT MESSAGE --}}
                            </div>
                    </div>
                    <div class="modal-body">

                        <!-- FOR BODY MODAL -->

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal form -->
          </section>
          <!-- /.content -->
@endsection

{{-- FOR JS SCRIPT AJAX ETC --}}
@push('javascriptPage')

<!-- DataTables -->
<script src="{{ asset('assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">

$(document).ready(function() {

//HEADER AJAX CSRF LARAVEL
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#form-ubah-password').on('submit', function(e){
    e.preventDefault();

    var me = $(this),
        url = me.attr('action'),
        method = me.attr('method'),
        data = me.serialize();

    $.ajax({
        url: url,
        type: method,
        data: data,
        dataType: 'JSON',
        success: function(res){
            $('#alert-validation').empty();
            $("#alert-validation").css("display", "none");



        },
        error: function(err){
            $('#alert-validation').empty();
            var error = err.responseJSON;
            //Menampilkan pesan error dari json response error
            $.each(error.errors, function(key, value){
                $('#alert-validation').append("<p>"+ value[0] +"</p>");
            });
            $("#alert-validation").css("display", "block");
        }
    })

})


});

</script>

@endpush
