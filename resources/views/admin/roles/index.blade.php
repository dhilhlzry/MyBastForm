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
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
<style>
  .custom-Button {
    background-color: rgb(105, 108, 255);
    color: white;
  }

  .custom-Button:hover {
    background-color: rgb(100, 80, 255);
    color: white;
  }
</style>
@endpush
@section('customCheckBox')
<link rel="stylesheet" href="{{ asset('css/customCheckBox.css') }}">
@endsection
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
              @can('role-create')
              <div class="row">

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="btn-upload">
                  <i class="fa fa-plus"></i> Add new Role
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title" id="exampleModalLabel"></h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body mr-3 ml-3">
                        <form action="{{route('roles.store')}}" method="post">
                          @csrf
                          <div class="form-group mb-5">
                            <label for="exampleInputEmail1" style="color: rgb(143,156,170);">ROLE NAME</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a role name">
                          </div>
                          <div class="form-group">
                            <div class="d-flex justify-content-between">
                              <label class="mb-3" style="color: rgb(120,120,120);">ROLE PERMISSIONS</label>
                              <div class="checkbox-wrapper-33">
                                <label class="checkbox" style="cursor: pointer;">
                                  <input class="checkbox__trigger visuallyhidden checkAll" id="checkAll" value="" type="checkbox" />
                                  <span class="checkbox__symbol">
                                    <svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M4 14l8 7L24 7"></path>
                                    </svg>
                                  </span>
                                  <p class="checkbox__textwrapper" style="color: rgb(143,156,170);">Select All</p>
                                </label>
                              </div>
                            </div>
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  @foreach($permissions as $data => $permission)
                                  <tr>
                                    <td style="font-weight: 700;color: rgb(120,120,120);width: 40%;">Feature {{$permission['name']}}</td>
                                    <td>
                                      <div class="d-flex" style="gap:45px;">
                                        @foreach($permission['feature'] as $key => $data)
                                        <div class="checkbox-wrapper-33">
                                          <label class="checkbox" style="cursor: pointer;">
                                            <input class="check checkbox__trigger visuallyhidden checkRole" name="permission[]" value="{{$permission['slug']}}-{{$key}}" type="checkbox" />
                                            <span class="checkbox__symbol">
                                              <svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 14l8 7L24 7"></path>
                                              </svg>
                                            </span>
                                            <p class="checkbox__textwrapper" style="color: rgb(143,156,170);">{{$key}}</p>
                                          </label>
                                        </div>
                                        @endforeach
                                      </div>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancelButton" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn custom-Button">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Button trigger modal -->

                <!-- Modal Edit-->
                @include('admin.roles.Edit')
                <!-- End -->
              </div>
              @endcan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data-table" class="table tables table-bordered table-striped" style="width: 100%">
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
<script>
  $(document).ready(function() {
    $('.checkAll').click(function() {
      $('.checkRole').not(this).prop('checked', this.checked);
    });
    // $('.checkAll2').click(function() {
    //   $('.editCheck').not(this).prop('checked', this.checked);
    // });
  });

  // Event listener untuk tombol "Batal" di dalam modal
  $('.cancelButton').on('click',function(){
    var checkboxes = document.querySelectorAll('.checkRole');
    for (var checkbox of checkboxes) {
      checkbox.checked = false;
    }
    document.getElementById('checkAll').checked = false;
    // document.querySelector('.checkAll2').checked = false;

    $('#exampleModal').modal('hide');
  })
</script>
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
    $('#data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('roles.datatable') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'no',
          orderable: false,
          searchable: false
        },
        {
          data: 'name',
          name: 'name',
          orderable: true,
          searchable: true
        },
        {
          data: 'created_at',
          name: 'created_at',
          orderable: false,
          searchable: false
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }

      ],
      initComplete: function() {
        var api = this.api();
        $('#data-table_filter input')
          .off('.DT')
          .on('keyup.DT', function(e) {
            if (e.keyCode == 13) {
              api.search(this.value).draw();
            }
          });
      },
    });
  });
</script>
@endpush