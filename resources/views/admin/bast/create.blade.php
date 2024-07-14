@extends('layouts.main')

@section('title')
    <title>Bast</title>
@endsection

@push('custom-css')
<link rel="stylesheet" href="{{ asset('template/adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ (@$data) ? 'Edit' : 'Create' }} Bast</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('bast.view' , $project->id) }}">Bast</a></li>
            <li class="breadcrumb-item active">{{ (@$data) ? 'Edit' : 'Create' }}</li>
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
              <form action="{{ (@$data) ? route('bast.update', @$data->id) : route('bast.store') }}" method="post" class="form-horizontal" >
                @csrf
                @if (@$data)
                    @method('PUT')
                    <input type="hidden" name="bastid" value="{{ @$data->id }}">
                @endif
                <input type="hidden" name="projectid" value="{{ $project->id }}">
                <div class="card-body">
                   
                  <div class="form-group row d-flex">
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>No Bast</label>
                    <div class="col-sm-11">
                      <input name="nobast" type="text" class="form-control" id="nobast" placeholder="Nomor Bast" value="{{ (@$data->bast_no) ?? $format  }}" required>
                      {!! @$errors ? $errors->first('nobast', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    
                  </div>
                  <div class="form-group row d-flex">
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Revision</label>
                    <div class="col-sm-5">
                      <input name="revisi" type="text" class="form-control" id="revisi" placeholder="Nomor Revision" value="{{ (@$data->revision) ?? old('revisi') }}">
                      {!! @$errors ? $errors->first('revisi', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Sprint</label>
                    <div class="col-sm-5">
                      <input name="sprint" type="text" class="form-control" id="sprint" placeholder="Sprint" value="{{ (@$data->sprint) ?? old('sprint') }}">
                      {!! @$errors ? $errors->first('sprint', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row d-flex">
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Phase</label>
                    <div class="col-sm-5">
                      <input name="phase" type="text" class="form-control" id="phase" placeholder="Phase" value="{{ (@$data->phase) ?? old('phase') }}">
                      {!! @$errors ? $errors->first('phase', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>OF Number</label>
                    <div class="col-sm-5">
                      <input name="ofnumber" type="text" class="form-control" id="ofnumber" placeholder="OF Number" value="{{ (@$data->of_number) ?? old('ofnumber') }}">
                      {!! @$errors ? $errors->first('ofnumber', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-6 col-form-label">Pihak Ke 1</label>
                    <label for="name" class="col-sm-6 col-form-label">Pihak Ke 2</label>
                    <div class="col-sm-10">
                      {{-- <input name="description" type="text" class="form-control" id="description" placeholder="Description" value="{{ (@$data->description) ?? old('description') }}">
                      {!! @$errors ? $errors->first('description', '<code><small>:message</small></code>') : '' !!} --}}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Nama</label>
                    <div class="col-sm-5">
                      <input name="nama1" type="text" class="form-control" id="nama1" placeholder="Nama" value="{{ (@$data->nama_pihak1) ?? old('nama1') }}">
                      {!! @$errors ? $errors->first('nama1', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Nama</label>
                    <div class="col-sm-5">
                      <input name="nama2" type="text" class="form-control" id="nama2" placeholder="Nama" value="{{ (@$data->nama_pihak2) ?? old('nama2') }}">
                      {!! @$errors ? $errors->first('nama2', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Perusahaan</label>
                    <div class="col-sm-5">
                      <input name="perusahaan1" type="text" class="form-control" id="perusahaan1" placeholder="Perusahaan" value="{{ (@$data->perusahaan_pihak1) ?? old('perusahaan1') }}">
                      {!! @$errors ? $errors->first('perusahaan1', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Perusahaan</label>
                    <div class="col-sm-5">
                      <input name="perusahaan2" type="text" class="form-control" id="perusahaan2" placeholder="Perusahaan" value="{{ (@$data->perusahaan_pihak2) ?? old('perusahaan2') }}">
                      {!! @$errors ? $errors->first('perusahaan2', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Jabatan</label>
                    <div class="col-sm-5">
                      <input name="jabatan1" type="text" class="form-control" id="jabatan1" placeholder="Jabatan" value="{{ (@$data->jabatan_pihak1) ?? old('jabatan1') }}">
                      {!! @$errors ? $errors->first('jabatan1', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Jabatan</label>
                    <div class="col-sm-5">
                      <input name="jabatan2" type="text" class="form-control" id="jabatan1" placeholder="Jabatan" value="{{ (@$data->jabatan_pihak2) ?? old('jabatan2') }}">
                      {!! @$errors ? $errors->first('description', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Alamat</label>
                    <div class="col-sm-5">
                      <input name="alamat1" type="text" class="form-control" id="alamat1" placeholder="Alamat" value="{{ (@$data->alamat_pihak1) ?? old('alamat1') }}">
                      {!! @$errors ? $errors->first('alamat1', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    <label for="name" class="col-sm-1 col-form-label d-flex"><p style="color: red;margin-bottom: 0;">*</p>Alamat</label>
                    <div class="col-sm-5">
                      <input name="alamat2" type="text" class="form-control" id="alamat2" placeholder="Alamat" value="{{ (@$data->alamat_pihak2) ?? old('alamat2') }}">
                      {!! @$errors ? $errors->first('alamat2', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>

                <div class="card-footer">
                  <a href="{{ route('bast.view' , $project->id) }}" id="batal" class="btn btn-default">Batal</a>
                  <button type="submit" class="btn btn-primary float-right">{{ (@$data) ? 'Ubah' : 'Simpan' }}</button>
                </div>

              </form>
            </div>

              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      </section>


</div>

@endsection