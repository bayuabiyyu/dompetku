@extends('admin.layout.main')

{{-- FOR CSS SCRIPT ETC --}}
@push('cssPage')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endpush

{{-- FOR TITLE PAGE --}}
@section('titlePage')
    Dompetku | Admin Dashboard
@endsection

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              User Data
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
                    <div class="box-header">
                         <button id="btnTambah" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Tambah Data </button>
                      <!-- {{-- <h3 class="box-title">Data Table With Full Features</h3> --}} -->

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                      <table id="data" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Email Verified</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Email Verified</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                      </table>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            <!-- MODAL FORM -->
            <div class="modal fade" id="modal-form">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" align="center">FORM</h4>
                            <div id="alert-validation" class="alert alert-warning" style="display:none">
                                {{-- ALERT MESSAGE --}}
                            </div>
                    </div>
                    <div class="modal-body">

                        <!-- FOR BODY FORM -->

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

    $('#data').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('user.datatable') !!}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'email_verified_at', name: 'email_verified_at' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});

function RefreshForm(){
    $('#alert-validation').empty();
    $("#alert-validation").css("display", "none");
    $('#form-data-add').trigger('reset');
    $('#form-data-edit').trigger('reset');
}

function RefreshData(){
    $('#data').DataTable().ajax.reload();
}

// AJAX GET CREATE FORM
    $('#btnTambah').on('click', function(e){
        e.preventDefault();
        var url = "{!! route('user.create') !!}";
        $.ajax({
            url: url,
            dataType: 'html',
            success: function(res){
                $('.modal-body').empty();
                $('.modal-title').text('FORM CREATE DATA');
                $('.modal-body').html(res);
                $('#modal-form').modal('show');
            }
        });
    });

// AJAX GET EDIT DATA
    $('#data').on('click', '#btnEdit', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
            $.ajax({
                url: url,
                dataType: 'html',
                success: function(res){
                    $('.modal-body').empty();
                    $('.modal-body').html(res);
                    $('.modal-title').text('FORM EDIT DATA');
                    $('#modal-form').modal('show');
                }
            });
    });


// AJAX GET SHOW DATA
$('#data').on('click', '#btnShow', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
            $.ajax({
                url: url,
                dataType: 'html',
                success: function(res){
                    $('.modal-body').empty();
                    $('.modal-body').html(res);
                    $('.modal-title').text('FORM SHOW DATA');
                    $('#modal-form').modal('show');
                }
            });
});


// AJAX EXECUTE ADD DATA
$('#modal-form').on('submit', '#form-data-add', function(e){
    e.preventDefault();
    var url = $(this).attr('action'),
        method = $(this).attr('method'),
        data = $(this).serialize();
            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                success: function(res){
                    alert(res.msg);
                    RefreshData();
                    RefreshForm();
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
            });
});

// AJAX EXECUTE DELETE DATA
    $('#data').on('click', '#btnDelete', function(e){
        e.preventDefault();
        if(confirm("Apa anda yakin ingin menghapus data ?")){
            var url = $(this).attr('href'),
                method = "DELETE";
                    $.ajax({
                    url: url,
                    method: method,
                    dataType: 'JSON',
                    success: function(res){
                        alert(res.msg);
                        RefreshData();
                        RefreshForm();
                    },
                    error: function(err){
                        var error = err.responseJSON;
                        //Menampilkan pesan error dari json response error
                        $.each(error.errors, function(key, value){
                            alert(value[0]);
                        });
                    }
                    });
        }
    });


// AJAX EXECUTE UPDATE DATA
$('#modal-form').on('submit', '#form-data-edit', function(e){
    e.preventDefault();
    var url = $(this).attr('action'),
        method = $(this).attr('method'),
        data = $(this).serialize();
            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'JSON',
                success: function(res){
                    alert(res.msg);
                    RefreshData();
                    RefreshForm();
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
            });
});

</script>

@endpush
