@extends('layouts.admin')
@section('title','Post')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Post Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Post Page</li>
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
            <a href="{{route('admin.post.create')}}" class="btn btn-sm btn-success ">
                        <i class="fa fa-plus px-2" aria-hidden="true"></i>Add
                    </a>
                    <a href="{{ route('admin.post.trash') }}" class="btn btn-sm btn-danger ">
                        <i class="fa fa-trash px-2" aria-hidden="true"></i>Trash bin
                    </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-striped"> 
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Image</th>
                <th class="text-center">Topic name</th>
                <th class="text-center">Title</th>
                <th class="text-center">Detail</th>
                <th class="text-center">Description</th>
                <th class="text-center">Action</th>
                <th class="text-center">ID</th>
                <th class="text-center">Status</th>
            </tr>
            </thead>
            <tbody>
              @foreach($list as $row)
                <tr>
                    <td><input type="checkbox" name="post_checkbox" value="1"></td>
                    <td><img style="width: 150px; height: 150px;" src="{{ asset('images/posts/'.$row->image) }}" alt="{{ $row->image }}"></td>
                    <td>{{$row->topicname}}</td>
                    <td>{{$row->title}}</td>
                    <td>{{$row->detail}}</td>
                    <td>{{$row->description}}</td>
                    <td>
    @php
        $args = ['id' => $row->id];
    @endphp
    @if ($row->status==1)
    <a href="{{ route('admin.post.status', $args) }}" class="btn btn-sm btn-success">
        <i class="fa fa-toggle-on" aria-hidden="true"></i>
    </a>
    @else
    <a href="{{ route('admin.post.status', $args) }}" class="btn btn-sm btn-danger">
        <i class="fa fa-toggle-off" aria-hidden="true"></i>
    </a>
    @endif
    <a href="{{ route('admin.post.show', $args) }}" class="btn btn-sm btn-info">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
    <a href="{{ route('admin.post.edit', $args) }}" class="btn btn-sm btn-primary">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
    <a href="{{ route('admin.post.delete', $args) }}" class="btn btn-sm btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</td>
                <td>{{$row->id}}</td>
                <td>{{$row->status}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.CONTENT -->
  </div>@endsection