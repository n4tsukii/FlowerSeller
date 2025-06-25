@extends('layouts.admin')
@section('title','Banner')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banner Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banner Page</li>
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
          
                    <a href="{{ route('admin.banner.trash') }}" class="btn btn-sm btn-danger ">
                        <i class="fa fa-trash px-2" aria-hidden="true"></i>Trash bin
                    </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
            <form action="{{ route('admin.banner.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control">
                                    @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="link">Link</label>
                                    <input type="text" value="{{ old('link') }}" name="link" id="link" class="form-control">
                                    @error('link')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="position">Position</label>
                                    <select name="position" id="position" class="form-control">
                                        <option value="slideshow">slideshow</option>
                                       
                                    </select>
                                    @error('position')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                
                                
                                <div class="mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Xuat ban</option>
                                        <option value="0">Chua xuat ban</option>
                                    </select>
                                    @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>
            </div>
            <div class="col-md-9">
            <table class="table table-bordered table-hover table-striped"> 
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Image</th>
                <th class="text-center">Banner Name</th>
                <th class="text-center">Link</th>
                <th class="text-center">Position</th>
                <th class="text-center">Description</th>
                <th class="text-center">Action</th>
                <th class="text-center">ID</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($list as $row)
                <tr>
                  <td> <input type="checkbox" name="banner_checkbox" value="1">     </td>
                  <td><img style="width: 150px; height: 150px;" src="{{ asset('images/banners/'.$row->image) }}" alt="{{ $row->image }}">     </td>           
                    <td>{{$row->name}}</td>
                    <td>{{$row->link}}</td>
                    <td>{{$row->position}}</td>
                    <td>{{$row->description}}</td>
                    <td>
    @php
        $args = ['id' => $row->id];
    @endphp
    @if ($row->status==1)
    <a href="{{ route('admin.banner.status', $args) }}" class="btn btn-sm btn-success">
        <i class="fa fa-toggle-on" aria-hidden="true"></i>
    </a>
    @else
    <a href="{{ route('admin.banner.status', $args) }}" class="btn btn-sm btn-danger">
        <i class="fa fa-toggle-off" aria-hidden="true"></i>
    </a>
    @endif
    <a href="{{ route('admin.banner.show', $args) }}" class="btn btn-sm btn-info">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
    <a href="{{ route('admin.banner.edit', $args) }}" class="btn btn-sm btn-primary">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
    <a href="{{ route('admin.banner.delete', $args) }}" class="btn btn-sm btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</td>
                <td>{{$row->id}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.CONTENT -->
  </div>@endsection