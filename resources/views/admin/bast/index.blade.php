@extends('layouts.main')

@section('title')
<title>Bast</title>
<link rel="stylesheet" href="{{ asset('css/table.css') }}">
<link rel="stylesheet" href="{{ asset('tailwind/output.css') }}">
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
                    <h1 class="m-0">BAST</h1>
                    @if ($url == '')
                    @else
                    <input type="text" value="{{ $url }}" id="myInput" style="display: none">
                    @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bast.view', $project->first()->id) }}">Bast</a>
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
                        @can('bast-create')
                        <div class="card-header">
                            <div class="row">
                                <a href="{{ route('bast.create', $project->first()->id) }}" class="btn btn-success" id="btn-upload">
                                    <i class="fa fa-plus"></i> Add new Bast
                                </a>
                            </div>
                        </div>
                        @endcan
                        <!-- /.card-header -->
                        <div class="card-body d-flex">
                            <div class="project-data">
                                <table>
                                    <tr style="display: flex;align-items: flex-start;">
                                        <td style="width: 120px;font-size: 17px;">Project Name</td>
                                        <td style="font-size: 17px;">:</td>
                                        <td style="padding-left: 5px;font-size: 17px;"> {{ $project->first()->name }}</td>
                                    </tr>
                                    <tr style="display: flex;align-items: flex-start;">
                                        <td style="width: 120px;font-size: 17px;">Description</td>
                                        <td style="font-size: 17px;">:</td>
                                        <td style="padding-left: 5px;font-size: 17px;"> {{ $project->first()->description }}</td>
                                    </tr>
                                    <tr style="display: flex;align-items: flex-start;">
                                        <td style="width: 120px;font-size: 17px;">Type Project</td>
                                        <td style="font-size: 17px;">:</td>
                                        <td style="padding-left: 5px;font-size: 17px;"> {{ $project->first()->type_project }}</td>
                                    </tr>
                                    <tr style="display: flex;align-items: flex-start;">
                                        <td style="width: 120px;font-size: 17px;">Assign To</td>
                                        <?php
                                        $no = 0;
                                        ?>
                                        <td style="padding-left: 5px;font-size: 17px;">
                                            @foreach ($project[0]->users as $item)
                                            <li> {{ $item->name }}</li>
                                            <?php
                                            $no++;
                                            ?>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="bast-table">
                                <table id="bast-table" class="table tables table-bordered table-striped">
                                    <thead>
                                        <th>No</th>
                                        {{-- <th>Tanggal</th> --}}
                                        <th>Number</th>
                                        {{-- <th>Revisi</th> --}}
                                        <th>Pihak 1</th>
                                        {{-- <th>Perusahaan Pihak 1</th> --}}
                                        <th>Pihak 2</th>
                                        {{-- <th>Perusahaan Pihak 2</th> --}}
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach ($bast as $head)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            {{-- <td>{{ $head->bast_date }}</td> --}}
                                            <td>{{ $head->bast_no }}</td>
                                            {{-- <td>{{ $head->revision }}</td> --}}
                                            <td>{{ $head->nama_pihak1 }}</td>
                                            {{-- <td>{{ $head->perusahaan_pihak1 }}</td> --}}
                                            <td>{{ $head->nama_pihak2 }}</td>
                                            {{-- <td>{{ $head->perusahaan_pihak2 }}</td> --}}
                                            <td class="d-flex flex-wrap">
                                                <a href="{{ route('bast.print', $head->id) }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Print" style="margin-right: 5px;"><i class="fa fa-print"></i></a>
                                                <a href="/bast_link/{{ $head->id }}/{{ $head->projectid }}" id="mybtn" class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Share" style="margin-right: 5px;"><i class="fa fa-share"></i></a>
                                                @can('detailBast-index')
                                                <a href="{{ route('bast.detail', $head->id) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Detail" style="margin-right: 5px;"><i class="fa fa-list"></i></a>
                                                @endcan
                                                @can('detailBast-edit')
                                                <a href="{{ route('bast.edit', ['id' => $head->id, 'projectid' => $project->first()->id]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit" style="margin-right: 1px;"><i class="fa fa-edit"></i></a>&nbsp;
                                                @endcan
                                                @can('detailBast-delete')
                                                <a href="{{ route('bast.delete', $head->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Ingin Menghapus Bast Ini ?')" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                        ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-header" style="border-top-width: 1px;">
                            <div class="row">
                                <a href="{{ route('mom.create',['project' => $project->first->id,'from' => 'project']) }}" class="btn btn-success"><i class="fa fa-plus"></i> Create Mom</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="filters ml-1" id="filters" style="display: none;">
                                <select class="custom-select custom-select-sm mb-1" id="bast_filter" style="display: inline-block;">
                                    <option value="">BAST</option>
                                    @foreach($bast as $value)
                                    <option value="{{$value->id}}">{{$value->bast_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" class="id" value="{{$id}}" hidden>
                            <table id="data-table" class="table tables table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Bast</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-white">
                            <div class="row">
                                <a href="{{ route('project.index') }}" id="batal" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->


                </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($alert == true)
<script>
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
</script>
@endif
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
        $('#bast-table').DataTable({
            "lengthMenu": [ [5, 10, 25, 50], [5, 10, 25, 50] ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        var id = $('.id').val();
        const table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("bast.datatable") }}',
                data: function(d) {
                    d.idMOM = id,
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
        $('.filters').insertAfter('#data-table_filter input').css('display', 'inline-block');

        $('#bast_filter').on('change', function() {
            table.draw();
        })
    })
</script>
<!-- <script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("project.datatable",) }}',
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
                    data: 'description',
                    name: 'description',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'type_project',
                    name: 'type_project',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'user.id',
                    name: 'user.id',
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
</script> -->
@endpush