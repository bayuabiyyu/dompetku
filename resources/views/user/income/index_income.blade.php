@extends('user.layout.main')

{{-- FOR CSS SCRIPT ETC --}}
@push('cssPage')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

{{-- FOR TITLE PAGE --}}
@section('titlePage')
    Dompetku | Income
@endsection

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Income Data
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
                <div class="col-xs-6">
                  <div class="box">
                    <div class="box-header">
                        {{-- HEADER --}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!-- Date -->
                        <div class="form-group">
                            <label>Date:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="txtDate">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12">
                        <div class="box">
                          <div class="box-header">
                            <button id="btnTambah" class="btn btn-primary"> <i class="fa fa-plus"></i> ADD INCOME </button>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <div class="table-responsive">
                            <table id="data" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>Tanggal</th>
                                  <th>Kategori</th>
                                  <th>Keterangan</th>
                                  <th>Nominal</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody id="data-body">
                              </tbody>
                              <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th></th>
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
<!-- date-range-picker -->
<script src="{{ asset('assets/admin/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">

$(document).ready(function() {

    // EXECUTE ADD, DELETE, UPDATE ADA DI DALAM DOCUMENT READY AGAR BISA REFRESH INIT TABLE

    // HEADER AJAX CSRF LARAVEL
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Date picker
    $('#txtDate').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    }).datepicker('setDate', 'now');

    initDataTable();
    // Fungsi Refresh Data
    function initDataTable(){
        $('#data').DataTable().destroy();
        var txtDate = $('#txtDate').val();
        var table = $('#data').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{!! route('income.datatable') !!}",
                type : "POST",
                data: {txtDate:txtDate}
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'nama_kategori', name: 'nama_kategori' },
                { data: 'keterangan', name: 'keterangan' },
                { data: 'nominal', name: 'nominal', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' ) },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // computing column Total of the complete result
                var totalNominal = api
                    .column(4)
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );


                // Update footer by showing the total with the reference of the column index
                $(api.column(4).footer()).html('Total');
                    var currencyFormat = $.fn.dataTable.render.number( '.', ',', 2, 'Rp' ).display;
                    $(api.column(4).footer()).html(currencyFormat(totalNominal));
                },
        });
    }

    $('#txtDate').on('change', function(e){
        initDataTable();
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
                    initDataTable();
                    $('#modal-form').modal('hide');
                },
                error: function(err){
                    console.log(err);
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
                        initDataTable();
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
                    initDataTable();
                    $('#modal-form').modal('hide');
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


});


// AJAX GET CREATE FORM
    $('#btnTambah').on('click', function(e){
        e.preventDefault();
        var url = "{!! route('income.create') !!}";
        var date = $('#txtDate').val();
        $.ajax({
            url: url,
            dataType: 'html',
            success: function(res){
                $('.modal-body').empty();
                $('.modal-title').text('FORM CREATE DATA');
                $('.modal-body').html(res);
                $('#modal-form #tanggal').val(date);
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

</script>

@endpush
