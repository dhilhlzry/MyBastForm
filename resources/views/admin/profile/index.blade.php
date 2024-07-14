@extends('layouts.main')

@section('title')
    <title>Roles</title>
@endsection

@section('modal-title')
  Hapus Role
@endsection

@section('modal-body')
  Hapus role ini?
@endsection

@push('custom-css')
<link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
              <li class="breadcrumb-item active">Index</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <div class="row">
                  <a href="{{ route('roles.create') }}" class="btn btn-success" id="btn-upload">
                    <i class="fa fa-plus"></i> Add new Role
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="role-table" class="table table-bordered table-striped" style="width: 100%">
                  <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
      </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@push('custom-scripts')
<script src="{{ asset('template/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#role-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route("roles.datatable") }}',
      columns: [
        {data: 'DT_RowIndex', name: 'no', orderable: false, searchable: false},
        {data: 'name', name: 'name', orderable: true, searchable: true},
        {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ],
      initComplete: function(){
          var api = this.api();
          $('#role-table_filter input')
              .off('.DT')
              .on('keyup.DT', function (e) {
                  if (e.keyCode == 13) {
                      api.search(this.value).draw();
                  }
              });
        },
    });
  });
</script>

@endpush