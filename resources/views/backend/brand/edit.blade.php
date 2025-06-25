@extends('layouts.admin')
@section('title','Update Brand')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand Page</li>
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
                    <a href="{{ route('admin.brand.index') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Brands
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h1 class="text-center">Edit Brand</h1>
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" value="{{ old('name', $brand->name) }}" name="name" id="name" class="form-control">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $brand->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort_order">Sort Order</label>
                            <select name="sort_order" id="sort_order" class="form-control">
                                <option value="">Sort Order</option>
                                {!! $htmlsortorder !!}
                            </select>
                            @error('sort_order')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image">Image</label>
                            @if($brand->image && file_exists(public_path("images/brands/" . $brand->image)))
                                <div class="mb-2">
                                    <img src="{{ asset("images/brands/" . $brand->image) }}" alt="{{ $brand->image }}" style="max-width: 100px; max-height: 100px;">
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
                                <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Show</option>
                                <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Hide</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection
