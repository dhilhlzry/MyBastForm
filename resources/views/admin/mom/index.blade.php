@extends('layouts.main')

@section('title')
<title>MoM</title>
@endsection

@section('modal-title')
Hapus Role
@endsection

@section('modal-body')
Hapus role ini?
@endsection

@push('custom-css')
<link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
<style>
  .filters {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }
</style>
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Minutes of Meetings (MoM)</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('mom.index') }}">Mom</a>
            </li>
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
            @can('mom-create')
            <div class="card-header">
              <div class="row">
                <div class="col-sm-2">
                  <a href="{{ route('mom.create') }}" class="btn btn-success justify-content-end" id="btn-upload">
                    <i class="fa fa-plus"></i> Create MOM
                  </a>
                </div>
              </div>
            </div>
            @endcan
            <!-- /.card-header -->
            <div class="card-body">

              <div class="filters ml-1" id="filters" style="display: none;">
                <select class="custom-select custom-select-sm mb-1" id="project_filter" style="display: inline-block;">
                  <option value="">Project</option>
                  @foreach($projects as $project)
                  <option value="{{$project->id}}">{{$project->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="bastFilter" style="display: none;">
                <label for="" class="mt-1" style="font-weight: 400;font-size: 14px;">Number:</label>
                <select class="custom-select custom-select-sm ml-2" id="bast_filter" style="display: inline-block;">
                  <option value="">BAST</option>
                </select>
              </div>
              <table id="data-table" class="table tables table-bordered table-striped table-responsive" style="width: 100%">
                <thead>
                  <th>No</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>location</th>
                  <th>Project</th>
                  <th>No Bast</th>
                  <th>Action</th>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div><!--/. container-fluid -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function copytext() {
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    Swal.fire(
      'Share Link Berhasil !',
      'URL berhasil dicopy & ditambahkan ke papan klip!',
      'success'
    );
  }
</script>
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
    const table = $('#data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route("mom.datatable") }}',
        data: function(d) {
          d.filter_project = $('#project_filter').val(),
            d.bast_filter = $('#bast_filter').val()
        }
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'no',
          orderable: false,
          searchable: false
        },
        {
          data: 'title',
          name: 'title',
          orderable: true,
          searchable: true
        },
        {
          data: 'date',
          name: 'date',
          orderable: true,
          searchable: true
        },
        {
          data: 'location',
          name: 'location',
          orderable: true,
          searchable: true
        },
        {
          data: 'project',
          name: 'project',
          orderable: true,
          searchable: true,
          row: 'project',
          render: function(data) {
            if (!data) {
              return '';
            }
            return '<a href="/bast/view/' + data.id + '" class="btn btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>' + data.name;
          }
        },
        {
          data: 'no_bast',
          name: 'no_bast',
          orderable: true,
          searchable: true,
          render: function(data) {
            if (!data) {
              return '';
            }
            return data
          }
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
    $("#project_filter").on('change', function() {
      let filter = $('#project_filter').val();
      if (filter == "") {
        $('.bastFilter').insertAfter('#data-table_filter').css('display', 'none');
      } else {
        $('.bastFilter').insertAfter('.dataTables_filter input').css('display', 'flex');
        $('.filters').insertAfter('#data-table_filter input').css('display', 'inline-block');

      }
      $('#bast_filter').empty();
      $('#bast_filter').append('<option value="">BAST</option>')
      $.ajax({
        url: '{{route("mom.getBast")}}',
        type: 'GET',
        data: {
          project_id: filter
        },
        success: function(response) {
          var bastData = response;
          $.each(bastData, function(index, bast) {
            $('#bast_filter').append('<option value="' + bast.id + '">' + bast.bast_no + '</option>')
          })
        }
      })
      table.draw();
    })
    $('.filters').insertAfter('#data-table_filter input').css('display', 'inline-block');


    $('#bast_filter').on('change', function() {
      let no_bast = $(this).val();
      table.draw();
    })

  });
</script>
@endpush