@extends('layouts.admin')
@section('title','Menu')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Menu Page</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 text-right">
      
                    <a href="{{ route('admin.menu.trash') }}" class="btn btn-sm btn-danger ">
                        <i class="fa fa-trash px-2" aria-hidden="true"></i>Trash bin
                    </a>
            </div>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped"> 
              <thead>
              <tr>
                  <th class="text-center">Tên menu</th>
                  <th class="text-center">Liên kết</th>
                  <th class="text-center">Loại</th>
                  <th class="text-center">Vị trí</th>
                  <th class="text-center">Thao tác</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($list as $row)
                  <tr>
                      <td>{{$row->name}}</td>
                      <td>{{$row->link}}</td>
                      <td>{{$row->type}}</td>
                      <td>{{$row->position}}</td>
                      <td>
                      @php
                          $args = ['id' => $row->id];
                      @endphp
                      <a href="{{ route('admin.menu.edit', $args) }}" class="btn btn-sm btn-primary">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                      </a>
                      <a href="{{ route('admin.menu.delete', $args) }}" class="btn btn-sm btn-danger">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                  </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </section>
    <!-- /.CONTENT -->
  </div>@endsection