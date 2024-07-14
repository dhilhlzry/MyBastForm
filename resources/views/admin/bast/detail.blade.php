@extends('layouts.main')

@section('title')
    <title>Bast</title>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('tailwind/output.css') }}">
    <style>
        .modal-body .form-control{
            border-color: #566a7f;
            border-radius: 5px;
            border-width: 1px;
        }
    </style>
@endsection

@section('modal-title')
    Hapus Role
@endsection

@section('modal-body')
    Hapus role ini?
@endsection

@push('custom-css')
    <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                        <h1 class="m-0">DETAIL</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('bast.view', $project->first()->id) }}">Bast</a>
                            </li>
                            <li class="breadcrumb-item active">Detail</li>
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
                            @can('detailBast-create')
                                <div class="card-header">
                                    <div class="row">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaldetail"><i class="fa fa-plus"></i> Add Detail</button>
                                    </div>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body d-flex">
                                <div class="bast-data"
                                    style="">
                                    <table>
                                        <tr>
                                            <td style="width: 150px; font-size: 17px;">Project Name</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 17px;">{{ $project->first()->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px; font-size: 17px;">No Bast</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 17px;">{{ $bast->bast_no }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px; font-size: 17px;">Revision</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 17px;">{{ $bast->revision }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px; font-size: 17px;">Sprint</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 17px;">{{ $bast->sprint }}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;font-size: 17px;">PIHAK 1</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px; font-size: 14px;">Nama</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 14px;"> {{ $bast->nama_pihak1 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150;font-size: 14px;">Perusahaan</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 14px;">{{ $bast->perusahaan_pihak1 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px;font-size: 14px;">Jabatan</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 14px;">{{ $bast->jabatan_pihak1 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;font-size: 17px;">PIHAK 2</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px;font-size: 14px;">Nama</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 14px;">{{ $bast->nama_pihak2 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px; font-size: 14px;">Perusahaan</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 14px;">{{ $bast->perusahaan_pihak2 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 150px;font-size: 14px;">Jabatan</td>
                                            <td style="font-size: 14px;">:</td>
                                            <td style="padding-left: 5px;font-size: 14px;">{{ $bast->jabatan_pihak2 }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                                <div class="detail-table">
                                    <table id="data-table" class="table tables table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <th>No</th>
                                            <th>Fitur</th>
                                            <th>Deskripsi</th>
                                            <th>Penguji</th>
                                            <th>Tanggal Uji</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            ?>
                                            @foreach ($detail as $list)
                                                <tr>
                                                    <td>{{ $no }}</td>
                                                    <td>{{ $list->fitur }}</td>
                                                    <td>{{ $list->deskripsi }}</td>
                                                    <td>{{ $list->penguji }}</td>
                                                    <td>{{ $list->format_date }}</td>
                                                    <td class="d-flex flex-wrap">
                                                        @can('detailBast-edit')
                                                            <button type="button" class="btn btn-primary btn-xs"
                                                                data-toggle="modal" data-target="#modaledit{{ $list->id }}"
                                                                style="margin-right: 5px;">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        @endcan
                                                        @can('detailBast-delete')
                                                            <a href="{{ route('bast.delete-detail', ['idbast' => $bast->id, 'id' => $list->id]) }}"
                                                                class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                                data-placement="bottom" title="Hapus"
                                                                onclick="return confirm('Yakin Ingin Menghapus Detail Ini ?')"><i
                                                                    class="fa fa-trash"></i></a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="modaledit{{ $list->id }}" tabindex="-1"
                                                    aria-labelledby="modaleditLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title" id="modaldetailLabel" style="font-size: 20px;">Add Detail
                                                                </h1>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('bast.update-detail') }}">
                                                                @csrf
                                                                @method('GET')
                                                                <input type="hidden" name="bastid"
                                                                    value="{{ $bast->id }}">
                                                                <input type="hidden" name="detailid"
                                                                    value="{{ $list->id }}">
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold;"><p style="color: red;margin-bottom: 0;">*</p>Fitur</label>
                                                                        <input type="text" name="fitur" class="form-control col-sm-10" placeholder="Fitur" value="{{ $list->fitur }}" required>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold; font-size: 15px;"><p style="color: red;margin-bottom: 0;">*</p>Deskripsi</label>
                                                                        <input type="text" name="deskripsi" class="form-control col-sm-10" value="{{ $list->deskripsi }}" placeholder="Deskripsi" required>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold;"><p style="color: red;margin-bottom: 0;">*</p>Penguji</label>
                                                                        <input type="text" name="penguji" class="form-control col-sm-10" placeholder="Penguji" value="{{ $list->penguji }}" required>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold;"><p style="color: red;margin-bottom: 0;">*</p>Tanggal</label>
                                                                        <input type="date" class="form-control col-sm-10" name="dateuji" value="{{ $list->edit_date }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
                                    <a href="{{ route('mom.create',['project' => $project->first()->id,'bast' => $bast->id,'from' => 'bast']) }}" class="btn btn-success"><i class="fa fa-plus"></i> Create Mom</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="mom-table" class="table tables table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1; 
                                        ?>
                                        @foreach ($mom as $data)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ $data->date }}</td>
                                                <td>{{ $data->location }}</td>
                                                <td>
                                                    <a href="{{ route('mom.print', ['id' => $data->id,'project' => $project->first()->id,'bast' => $bast->id,'from' => 'bast']) }}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Print" style="margin-right: 5px;"><i class="fa fa-print"></i></a>
                                                    <a href="{{ route('mom.edit',['project' => $project->first()->id,'bast' => $bast->id,'from' => 'project','id' => $data->id]) }} " class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                                                    <a href="{{ route('mom.delete',$data->id) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                            ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white">
                                    <a href="{{ route('bast.view', $project->first()->id) }}" id="batal"
                                        class="btn btn-default">Back</a>
                                    <a href="{{ route('bast.print',  $bast->id) }}" class="btn btn-dark float-right "><i class="fa fa-print" style="color: white;"></i><label style="color: white; margin-bottom: 0;padding-left: 5px;">Print</label></a>
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

    <div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="modalbarangLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="modaldetailLabel" style="font-size: 20px;">Add Detail</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bast.create-detail') }}">
                    @csrf
                    @method('GET')
                    <input type="hidden" name="bastid" value="{{ $bast->id }}">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold;"><p style="color: red;margin-bottom: 0;">*</p>Fitur</label>
                            <input type="text" name="fitur" class="form-control col-sm-10" placeholder="Fitur" required>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold;"><p style="color: red;margin-bottom: 0;">*</p>Deskrips</label>
                            <input type="text" name="deskripsi" class="form-control col-sm-10" placeholder="Deskripsi" required>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold;"><p style="color: red;margin-bottom: 0;">*</p>Penguji</label>
                            <input type="text" name="penguji" class="form-control col-sm-10" placeholder="Penguji" required>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 pt-2 d-flex" style="font-weight: bold;"><p style="color: red;margin-bottom: 0;">*</p>Tanggal</label>
                            <input type="date" class="form-control col-sm-10" name="dateuji" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
            $('#data-table').DataTable({
                "lengthMenu": [ [5, 10, 25, 50], [5, 10, 25, 50] ]
            });
            $('#mom-table').DataTable();
        });
    </script>
@endpush
