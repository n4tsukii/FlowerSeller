@extends('layouts.admin')
@section('title','Update Banner')
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
                    <a href="{{ route('admin.banner.index') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Banners
                    </a>
                </div>
            </div>
        </div>
 
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                <form action="{{ route('admin.banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="name">Name</label>
        <input type="text" value="{{ old('name', $banner->name) }}" name="name" id="name" class="form-control">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="link">Link</label>
        <input type="text" value="{{ old('link', $banner->link) }}" name="link" id="link" class="form-control">
        @error('link')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="position">Position</label>
        <input type="text" value="{{ old('position', $banner->position) }}" name="position" id="position" class="form-control">
        @error('position')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $banner->description) }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image">Image</label>
        @if($banner->image && file_exists(public_path("images/banners/" . $banner->image)))
            <div class="mb-2">
                <img src="{{ asset("images/banners/" . $banner->image) }}" alt="{{ $banner->image }}" style="max-width: 100px; max-height: 100px;">
            </div>
        @endif
        <input type="file" name="image" id="image" class="form-control">
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Show</option>
            <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Hide</option>
        </select>
        @error('status')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">Update Banner</button>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection