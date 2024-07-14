@extends('layouts.main')

@section('title')
<title>Project</title>
<style>
  .selected-user {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
  }

  .selected-user button {
    margin-left: 10px;
  }
</style>
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
          <h1>{{ (@$data) ? 'Edit' : 'Create' }} Project</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Project</a></li>
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
            <form action="{{ (@$data) ? route('project.update', @$data->id) : route('project.store') }}" method="post" class="form-horizontal">
              @csrf
              @if (@$data)
              @method('PUT')
              @endif
              <div class="card-body">
                <div class="form-group row">
                  <label for="nip" class="col-sm-2 col-form-label">Nama Project</label>
                  <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="name" placeholder="Nama Project" value="{{ (@$data->name) ?? old('name') }}">
                    {!! @$errors ? $errors->first('name', '<code><small>:message</small></code>') : '' !!}
                    <span class="invalid-feedback" role="alert">
                      <strong id="error-nip"></strong>
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <input name="description" type="text" class="form-control" id="description" placeholder="Description" value="{{ (@$data->description) ?? old('description') }}">
                    {!! @$errors ? $errors->first('description', '<code><small>:message</small></code>') : '' !!}
                    <span class="invalid-feedback" role="alert">
                      <strong id="error-name"></strong>
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Type Project</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" name="type_project" type="text" id="type_project" value="{{ (@$data->type_project) ?? old('type_project') }}">
                      <option>FB</option>
                      <option>ET</option>
                    </select>
                    {!! @$errors ? $errors->first('type_project', '<code><small>:message</small></code>') : '' !!}
                    <span class="invalid-feedback" role="alert">
                      <strong id="error-name"></strong>
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="assign_to" class="col-sm-2 col-form-label">Asign To</label>
                  <div class="col-sm-10">
                    @if (@$data)
                    <input type="hidden" id="has_data" value="true">
                    @endif
                    <select name="assign_to[]"class="form-control" id="select_assign" multiple>
                      <option>Pilih User</option>
                      @foreach ($users as $item)
                      <option value="{{ $item->id }}" @if (@$data) {{ in_array($item->id, $data->users->pluck('id')->toArray()) ? 'selected' : '' }} @endif>{{ $item->name }}</option>
                      @endforeach
                    </select>
                    {!! @$errors ? $errors->first('assign_to', '<code><small>:message</small></code>') : '' !!}
                    <span class="invalid-feedback">
                      <strong id="error-assign_to"></strong>
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10 ">
                    <div id="selected_users" class="d-flex flex-wrap">

                    </div>
                    {!! @$errors ? $errors->first('selected_user[]', '<code><small>:message</small></code>') : '' !!}
                    <span class="invalid-feedback">
                      <strong id="error-selected_user"></strong>
                    </span>
                  </div>
                </div>

                <div class="card-footer">
                  <a href="{{ route('project.index') }}" id="batal" class="btn btn-default">Batal</a>
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
  <script>
    //   document.addEventListener('DOMContentLoaded', (event) => {
    //   const assignToSelect = document.getElementById('assign_to');
    //   const selectedUsersDiv = document.getElementById('selected_users');
    //   const hasDataInput = document.getElementById('has_data');
    //   const hasData = hasDataInput !== null;
    //   assignToSelect.addEventListener('change', function () {
    //     const selectedOptions = Array.from(assignToSelect.selectedOptions);
    //     selectedOptions.forEach(option => {
    //       // Create a new div for the selected user
    //       const userDiv = document.createElement('div');
    //       userDiv.className = 'selected-user';
    //       userDiv.textContent = option.text;

    //       // Create a hidden input to store the selected user id
    //       const hiddenInput = document.createElement('input');
    //       hiddenInput.type = 'hidden';
    //       hiddenInput.name = `selected_users[]`;
    //       hiddenInput.value = option.value;

    //       // Create a remove button
    //       const removeButton = document.createElement('button');
    //       removeButton.textContent = 'Hapus';
    //       removeButton.className = 'btn btn-danger btn-sm ml-2 mr-2';
    //       removeButton.onclick = function () {
    //         // Remove the user from the selected list
    //         userDiv.remove();
    //         // Add the option back to the select
    //         option.selected = false;
    //         option.style.display = '';
    //       };

    //       userDiv.appendChild(hiddenInput);
    //       userDiv.appendChild(removeButton);
    //       selectedUsersDiv.appendChild(userDiv);

    //       // Hide the option in the select
    //       option.style.display = 'none';
    //     });

    //     // Clear the selection
    //     assignToSelect.value = '';
    //   });
    //   if (hasData) {

    //   // Load initially selected users
    //   const initiallySelectedUsers = assignToSelect.querySelectorAll('option:checked');
    //   initiallySelectedUsers.forEach(option => {
    //     const userDiv = document.createElement('div');
    //     userDiv.className = 'selected-user';
    //     userDiv.textContent = option.text;

    //     const hiddenInput = document.createElement('input');
    //     hiddenInput.type = 'hidden';
    //     hiddenInput.name = `selected_users[]`;
    //     hiddenInput.value = option.value;

    //     const removeButton = document.createElement('button');
    //     removeButton.textContent = 'Hapus';
    //     removeButton.className = 'btn btn-danger btn-sm ml-2 mr-2';
    //     removeButton.onclick = function () {
    //       userDiv.remove();
    //       option.selected = false;
    //       option.style.display = '';
    //     };

    //     userDiv.appendChild(hiddenInput);
    //     userDiv.appendChild(removeButton);
    //     selectedUsersDiv.appendChild(userDiv);

    //     option.style.display = 'none';
    //   });
    //   }

    // });
  </script>
</div>

@endsection

@push('custom-scripts')
<script src="{{ asset('template/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $('#select_assign').select2({
    theme: "default",
    width: "100%",
    // multiple: true,
  })
</script>
@endpush