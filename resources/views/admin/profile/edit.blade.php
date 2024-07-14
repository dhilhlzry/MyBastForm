@extends('layouts.main')

@section('title')
    <title>Profile</title>
@endsection

@push('custom-css')
@endpush

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Profile Information</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Profile</li>
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
                  <form action="{{ route('profile.update') }}" method="post" class="form-horizontal" >
                    @csrf
                    @method('patch')
    
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ (@$user->name) ?? old('name') }}" required autofocus autocomplete="name" />
                          {!! @$errors ? $errors->first('name', '<code><small>:message</small></code>') : '' !!}
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-name"></strong>
                            </span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="{{ (@$user->email) ?? old('email') }}" required autocomplete="email" />
                          {!! @$errors ? $errors->first('email', '<code><small>:message</small></code>') : '' !!}
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-email"></strong>
                            </span>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form action="{{ route('password.update') }}" method="post" class="form-horizontal" >
                    @csrf
                   @method('put')
    
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                          <input name="current_password" type="password" class="form-control" id="current_password" placeholder="Current Password" value="{{ (@$data->current_password) ?? old('current_password') }}" autocomplete="current_password" />
                          {!! @$errors ? $errors->updatePassword->first('current_password', '<code><small>:message</small></code>') : '' !!}
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-current_password"></strong>
                            </span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input name="password" type="password" class="form-control" id="password" placeholder="New Password" value="{{ (@$data->password) ?? old('password') }}" autocomplete="password" />
                          {!! @$errors ? $errors->updatePassword->first('password', '<code><small>:message</small></code>') : '' !!}
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-password"></strong>
                            </span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" value="{{ (@$data->password_confirmation) ?? old('password_confirmation') }}" autocomplete="password_confirmation" />
                          {!! @$errors ? $errors->updatePassword->first('password_confirmation', '<code><small>:message</small></code>') : '' !!}
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-password_confirmation"></strong>
                            </span>
                        </div>
                      </div>
                    </div>
    
                    <div class="card-footer">
                      <a href="{{ route('index') }}" id="batal" class="btn btn-default">Batal</a>
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


@endpush
