@extends('layouts.main')

@section('title')
<title>Roles</title>
@endsection

@section('customCheckBox')
<link rel="stylesheet" href="{{asset('css/customCheckBox.css')}}">
@endsection
@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ (@$find) ? 'Edit' : 'Create' }} Role</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">{{ (@$find) ? 'Edit' : 'Create' }}</li>
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
            <form action="{{ (@$find) ? route('roles.update', @$find->id) : route('roles.store') }}" method="post" class="form-horizontal">
              @csrf
              @if (@$find)
              @method('PUT')
              @endif

              <div class="card-body">
                <div class="form-group row d-flex" style="justify-content: center;">
                  <label for="name" class=" col-sm-1 col-form-label ">Name :</label>
                  <div class="col-sm-6">
                    <input name="name" type="text" class="form-control" style="width: 85%;" id="name" placeholder="Name" value="{{ (@$find->name) ?? old('name') }}">
                    {!! @$errors ? $errors->first('name', '<code><small>:message</small></code>') : '' !!}
                    <span class="invalid-feedback" role="alert">
                      <strong id="error-name"></strong>
                    </span>
                  </div>
                </div>
                <div class="form-group mr-5 ml-5 shadow" style="border: 1px solid black; border-radius: 5px;">
                  <div class="d-flex justify-content-between pt-3 bg-secondary" style="border: 1px solid green;border-radius: 5px 5px 0 0;">
                    <label class="mb-3 ml-3" style="color: white;">ROLE PERMISSIONS</label>
                    <div class="checkbox-wrapper-33">
                      <label class="checkbox" style="cursor: pointer;">
                        <input class="checkbox__trigger visuallyhidden" id="checkAll" value="" type="checkbox"/>
                        <span class="checkbox__symbol" style="border: 1px solid white; box-shadow: 0 0 0 0 white;">
                          <svg aria-hidden="true" class="icon-checkbox" style="color: white;" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 14l8 7L24 7"></path>
                          </svg>
                        </span>
                        <p class="checkbox__textwrapper mr-2" style="color: white;">Select All</p>
                      </label>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        @foreach($permissions as $data => $permission)
                        <tr>
                          <td style="font-weight: 700;color: rgb(120,120,120);width: 50%;">Feature {{$permission['name'] }}</td>
                          <td>
                            <div class="d-flex" style="gap:50px;">
                              @foreach($permission['feature'] as $key => $data)
                              <div class="checkbox-wrapper-33">
                                <label class="checkbox" style="cursor: pointer;">
                                  <input class="check checkbox__trigger visuallyhidden" name="permission[]" value="{{$permission['slug']}}-{{$key}}" type="checkbox" {{(@$find)->hasPermissionTo($permission['slug'].'-'.$key) ? 'checked' : ''}} />
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
                <div class="card-footer mr-4 ml-4 bg-white">
                  <a href="{{ route('roles.index') }}" id="batal" class="btn btn-default">Batal</a>
                  <button type="submit" class="btn btn-primary float-right">{{ (@$find) ? 'Ubah' : 'Simpan' }}</button>
                </div>
            </form>
          </div>

        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.container-fluid -->

  </section>

</div>

@endsection

@push('custom-scripts')
<script>
  $(document).ready(function() {
    $('#checkAll').click(function() {
      $('input:checkbox').not(this).prop('checked', this.checked);
    });

  });
</script>
@endpush