@extends('layouts.main')

@section('title')
    <title>User</title>
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
          <h1>{{ (@$data) ? 'Edit' : 'Create' }} User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
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
              <form action="{{ (@$data) ? route('user.update', @$data->id) : route('user.store') }}" method="post" class="form-horizontal" >
                @csrf
                @if (@$data)
                    @method('PUT')
                    <input type="hidden" value="{{ $data->role->id }}" id="selectedId">
                @endif
                <div class="card-body">
                   <div class="form-group row">
                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                      <input name="nip" type="text" class="form-control" id="nip" placeholder="NIP" value="{{ (@$data->nip) ?? old('nip') }}">
                      {!! @$errors ? $errors->first('nip', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-nip"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ (@$data->name) ?? old('name') }}">
                      {!! @$errors ? $errors->first('name', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ (@$data->email) ?? old('email') }}">
                      {!! @$errors ? $errors->first('email', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-email"></strong>
                        </span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                      <select name="role_id" id="role_id" class="form-control">
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}" {{ @$data->role_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                      </select>
                      {!! @$errors ? $errors->first('role_id', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-role_id"></strong>
                        </span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <select class="form-control select2" name="status" type="text" id="status">
                       <option value="1" {{ old('status', @$data->status) == 1 ? 'selected' : '' }}>Active</option>
                       <option value="0" {{ old('status', @$data->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                      {!! @$errors ? $errors->first('status', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                    </div>
                    </div> 

                  <!-- <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input name="password" type="password" class="form-control" id="password" placeholder="New Password" autocomplete="password" />
                      {!! @$errors ? $errors->first('password', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-password"></strong>
                        </span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" autocomplete="password_confirmation" />
                      {!! @$errors ? $errors->first('password_confirmation', '<code><small>:message</small></code>') : '' !!}
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-password_confirmation"></strong>
                        </span>
                    </div>
                  </div> -->
                </div>

                <div class="card-footer">
                  <a href="{{ route('user.index') }}" id="batal" class="btn btn-default">Batal</a>
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

@push('custom-scripts')

<script src="{{ asset('template/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $('#role_id').select2({
    theme: "bootstrap4",
    width: "100%",
    placeholder: "Search Role...",
    // ajax: {
    //   url: "{{ route('roles.list') }}",
    //   dataType: 'json',
    //   delay: 250,
    //   processResults: function (data) {
    //     return {
    //       results:  $.map(data, function (item) {
    //         return {
    //           text: item.name,
    //           id: item.id
    //         }
    //       })
    //     };
    //   },
    //   cache: true
    // }
  });
</script>

@endpush
