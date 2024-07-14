@extends('layouts.main')

@section('title')
<title>Settings</title>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('tailwind/output.css') }}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Settings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('settings.index')}}">Settings</a>
            </li>
            <li class="breadcrumb-item active">Index</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <hr class="mx-3 mt-4">
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content mb-5">
    <div class="container-fluid d-flex" style="justify-content: space-between;gap: 10px;">
      <div class="col-5 ml-2">
        <h1 style="font-size: 20px;" class="bold mb-3">Mom Document</h1>
        <p class="mb-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus sequi non, eos ducimus possimus molestias dolores, autem assumenda ullam illo unde tempore dolorum nisi, nam eum odit porro! Sequi, minima.</p>

        <img src="{{asset('img/mom.png')}}" alt="" title="Mom Document">
      </div>
      <div class="col-6 mt-1 bg-white shadow-lg rounded-xl">
        <form action="{{ route('settings.store')}}" method="post" class="ml-3 mr-3 mt-4 mb-4">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Margin Y</label>
            <select name="margin_y" id="" class="custom-select">
              <option value="3rem">Default</option>
              <option value="3rem" {{ (@$value->margin_y) == '3rem' ? 'selected' : '' }}>3 rem</option>
              <option value="6rem" {{ (@$value->margin_y) == '6rem' ? 'selected' : '' }}>6 rem</option>
              <option value="9rem" {{ (@$value->margin_y) == '9rem' ? 'selected' : '' }}>9 rem</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Margin X</label>
            <select name="margin_x" id="" class="custom-select">
              <option value="5rem">Default</option>
              <option value="5rem" {{ (@$value->margin_x) == '5rem' ? 'selected' : '' }}>5 rem</option>
              <option value="7rem" {{ (@$value->margin_x) == '7rem' ? 'selected' : '' }}>7 rem</option>
              <option value="9rem" {{ (@$value->margin_x) == '9rem' ? 'selected' : '' }}>9 rem</option>
              <option value="11rem" {{ (@$value->margin_x) == '11rem' ? 'selected' : '' }}>11 rem</option>
            </select>
          </div>
          <div class="">
            <label for="exampleInputEmail1">Column 1</label>
            <div class="form-group flex p-3 rounded-sm" style="border: 1px solid black;">
              <label for="exampleInputEmail1" class="mt-2 mr-2" style="width: 100px;">Margin Top</label>
              <select name="column1" id="" class="custom-select">
                <option value="3rem">Default</option>
                <option value="1rem" {{ (@$value->col1_mt) == '1rem' ? 'selected' : '' }}>1 rem</option>
                <option value="3rem" {{ (@$value->col1_mt) == '3rem' ? 'selected' : '' }}>3 rem</option>
                <option value="5rem" {{ (@$value->col1_mt) == '5rem' ? 'selected' : '' }}>5 rem</option>
                <option value="7rem" {{ (@$value->col1_mt) == '7rem' ? 'selected' : '' }}>7 rem</option>
              </select>
            </div>
          </div>
          <div class="">
            <label for="exampleInputEmail1">Column 2</label>
            <div class="form-group flex p-3 rounded-sm" style="border: 1px solid black;">
              <label for="exampleInputEmail1" class="mt-2 mr-2" style="width: 100px;">Margin Top</label>
              <select name="column2" id="" class="custom-select">
                <option value="1rem">Default</option>
                <option value="1rem" {{ (@$value->col2_mt) == '1rem' ? 'selected' : '' }}>1 rem</option>
                <option value="3rem" {{ (@$value->col2_mt) == '3rem' ? 'selected' : '' }}>3 rem</option>
                <option value="5rem" {{ (@$value->col2_mt) == '5rem' ? 'selected' : '' }}>5 rem</option>
                <option value="7rem" {{ (@$value->col2_mt) == '7rem' ? 'selected' : '' }}>7 rem</option>
              </select>
            </div>
          </div>
          <div class="">
            <label for="exampleInputEmail1">Column 3</label>
            <div class="form-group flex p-3 rounded-sm" style="border: 1px solid black;">
              <label for="exampleInputEmail1" class="mt-2 mr-2" style="width: 100px;">Margin Top</label>
              <select name="column3" id="" class="custom-select">
                <option value="1rem">Default</option>
                <option value="1rem" {{ (@$value->col3_mt) == '1rem' ? 'selected' : '' }}>1 rem</option>
                <option value="3rem" {{ (@$value->col3_mt) == '3rem' ? 'selected' : '' }}>3 rem</option>
                <option value="5rem" {{ (@$value->col3_mt) == '5rem' ? 'selected' : '' }}>5 rem</option>
                <option value="7rem" {{ (@$value->col3_mt) == '7rem' ? 'selected' : '' }}>7 rem</option>
              </select>
            </div>
          </div>
          <div class="">
            <label for="exampleInputEmail1">Column 4</label>
            <div class="form-group flex p-3 rounded-sm" style="border: 1px solid black;">
              <label for="exampleInputEmail1" class="mt-2 mr-2" style="width: 100px;">Margin Top</label>
              <select name="column4" id="" class="custom-select">
                <option value="1rem">Default</option>
                <option value="1rem" {{ (@$value->col4_mt) == '1rem' ? 'selected' : '' }}>1 rem</option>
                <option value="3rem" {{ (@$value->col4_mt) == '3rem' ? 'selected' : '' }}>3 rem</option>
                <option value="5rem" {{ (@$value->col4_mt) == '5rem' ? 'selected' : '' }}>5 rem</option>
                <option value="7rem" {{ (@$value->col4_mt) == '7rem' ? 'selected' : '' }}>7 rem</option>
              </select>
            </div>
          </div>
          <div class="" style="text-align: end;">
            <a href="{{ route('mom.print', ['id' => 1, 'from' => 'settings']) }}" class="text-base font-semibold text-white bg-green-700 py-2 px-4 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out mr-2">
              Preview</a>
            <button type="submit" onclick="return confirm('Apakah Yakin Dengan Option Ini ?')" class="text-base font-semibold text-white bg-green-700 py-2 px-4 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
              Simpan</button>
          </div>
        </form>
      </div>
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->

</div>
@endsection