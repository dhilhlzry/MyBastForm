@extends('layouts.main')

@section('title')
    <title>MoM</title>
@endsection

@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('trix_editor/trix.css') }}">
    <style>
        trix-content img {
            width: 100px;
            height: 100px;
        }
        /* trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        } */
    </style>
    <script src="{{ asset('template/adminlte/plugins/jquery/jquery.min.js') }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ @$data ? 'Edit' : 'Create' }} Mom</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('mom.index') }}">Mom</a></li>
                            <li class="breadcrumb-item active">{{ @$data ? 'Edit' : 'Create' }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- form start -->
                            <form action="{{ @$data ? route('mom.update') : route('mom.store') }}" method="post"
                                class="form-horizontal">
                                @csrf
                                @if (@$data)
                                    @method('PUT')
                                    <input type="hidden" name="momid" value="{{ @$data->id }}">
                                @endif
                                <input type="hidden" name="from" value="{{ @$from }}">
                                <input type="hidden" name="p_selected" value="{{ @$p_selected }}">
                                <input type="hidden" name="b_selected" value="{{ @$b_selected }}">
                                <div class="card-body">
                                    <div class="form-group row d-flex">
                                        <label for="name" class="col-sm-2 col-form-label d-flex">
                                            <p style="color: red;">*</p>Title
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="title" type="text" class="form-control" id="title"
                                                placeholder="Masukan Title" value="{{ @$data->title ?? old('title') }}">
                                            {!! @$errors ? $errors->first('title', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="name" class="col-sm-2 col-form-label d-flex">
                                            <p style="color: red;margin-bottom: 0;">*</p>Date Of Meeting
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="date" style="width: 320px" type="date" class="form-control"
                                                id="date" value="{{ @$edit_date ?? old('date') }}">
                                            {!! @$errors ? $errors->first('revisi', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="name" class="col-sm-2 col-form-label d-flex">
                                            <p style="color: red;margin-bottom: 0;">*</p>Time Of Meeting
                                        </label>
                                        <div class="col-sm-10 flex">
                                            <input name="time_awal" type="time" style="width: 150px" class="form-control"
                                                id="time_awal" placeholder=""
                                                value="{{ @$data->time_awal ?? old('time_awal') }}">
                                            {!! @$errors ? $errors->first('time_awal', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                            <input name="time_akhir" style="width: 150px; margin-left: 20px" type="time"
                                                class="form-control" id="time_akhir" placeholder=""
                                                value="{{ @$data->time_akhir ?? old('time_akhir') }}">
                                            {!! @$errors ? $errors->first('time_akhir', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="project" class="col-sm-2 col-form-label">Project</label>
                                        <div class="col-sm-10">
                                            <select name="project" id="project" class="form-control Project">
                                                <option value=""></option>
                                                @foreach ($project as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ @$data->project == $item->id || @$p_selected == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {!! @$errors ? $errors->first('project', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row bast" style="display: none;">
                                        <label for="bast" class="col-sm-2 col-form-label">Bast</label>
                                        <div class="col-sm-10">
                                            @if (@$data)
                                                <select name="bast" id="bast" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($bast as $basts)
                                                        <option value="{{ $basts->id }}"
                                                            {{ @$data->bast == $basts->id || @$b_selected == $basts->id ? 'selected' : '' }}>
                                                            {{ $basts->bast_no }}</option>
                                                    @endforeach
                                                </select>
                                            @elseif (@$detail)
                                                <select name="bast" id="bast" class="form-control">
                                                    @if (@$from == 'project')
                                                        <option value=""></option>
                                                    @endif
                                                    @foreach ($bast as $basts)
                                                        <option value="{{ $basts->id }}"
                                                            {{ @$data->bast == $basts->id || @$b_selected == $item->id ? 'selected' : '' }}>
                                                            {{ $basts->bast_no }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="bast" id="bast" class="form-control">
                                                    <option></option>
                                                </select>
                                            @endif
                                            {!! @$errors ? $errors->first('project', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="location" class="col-sm-2 col-form-label d-flex">
                                            <p style="color: red;margin-bottom: 0;">*</p>Location
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="location" type="text" class="form-control" id="location"
                                                placeholder="Masukan Location"
                                                value="{{ @$data->location ?? old('location') }}">
                                            {!! @$errors ? $errors->first('location', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="attendance" class="col-sm-2 col-form-label d-flex">
                                            <p style="color: red;margin-bottom: 0;">*</p>Attendance
                                        </label>
                                        <div class="col-sm-10">
                                            <input id="attendance" type="hidden" name="attendance"
                                                value="{!! @$data->attendance ?? old('attendance') !!}">
                                            <trix-editor input="attendance"  value=""></trix-editor>
                                            {!! @$errors ? $errors->first('attendance', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="plan" class="col-sm-2 col-form-label d-flex">
                                            <p style="color: red;margin-bottom: 0;">*</p>Action Plan
                                        </label>
                                        <div class="col-sm-10">
                                            <input id="plan" type="hidden" name="content"
                                                value="{{ @$data->plan ?? old('plan') }}">
                                            <trix-editor input="plan"></trix-editor>
                                            {!! @$errors ? $errors->first('plan', '<code><small>:message</small></code>') : '' !!}
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    @if (@$from == 'project')
                                        <a href="{{ route('bast.view', $p_selected) }}" id="batal"
                                            class="btn btn-default">Batal</a>
                                    @elseif (@$from == 'bast')
                                        <a href="{{ route('bast.detail', $b_selected) }}" id="batal"
                                            class="btn btn-default">Batal</a>
                                    @else
                                        <a href="{{ route('mom.index') }}" id="batal"
                                            class="btn btn-default">Batal</a>
                                    @endif
                                    <button type="submit"
                                        class="btn btn-primary float-right">{{ @$data ? 'Ubah' : 'Simpan' }}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
        </section>


    </div>
    <script>
        var uploadUrl = "{{ route('mom.upload') }}";
    </script>
    <script type="text/javascript" src="{{ asset('trix_editor/attachments.js') }}"></script>
    <script type="text/javascript" src="{{ asset('trix_editor/trix.umd.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var project = $('#project').val();
            if (!project == "") {
                $('.bast').css('display', 'flex')
            }

            $('#project').change(function() {
                var project_id = $(this).val();
                if (!project_id) {
                    $('.bast').css('display', 'none')
                } else {
                    $('.bast').css('display', 'flex')
                }
                $('#bast').empty();

                // ajax
                $.ajax({
                    url: '{{ route('mom.getBast') }}',
                    type: 'GET',
                    data: {
                        project_id: project_id
                    },
                    success: function(response) {
                        // console.log(response);
                        var bastData = response;
                        $('#bast').append('<option ></option>')
                        $.each(bastData, function(index, bast) {
                            $('#bast').append('<option value="' + bast.id + '">' + bast
                                .bast_no + '</option>')
                        })
                    }
                })
            })
        })
        // 
    </script>
@endsection
