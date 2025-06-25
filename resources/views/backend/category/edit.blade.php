@extends('layouts.admin')
@section('title','Edit Category')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category Page</li>
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
                    <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Categories
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <h1 class="text-center">Edit Category</h1>

                        <div class="mb-3">
                            <label for="name">Category name</label>
                            <input type="text" value="{{ old('name', $category->name) }}" name="name" id="name" class="form-control">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="parent_id">Parent Category</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0">Cấp cha</option>
                                {!! $htmlparentid !!}
                            </select>
                            @error('parent_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort_order">Order by</label>
                            <select name="sort_order" id="sort_order" class="form-control">
                                <option value="">Chọn vị trí</option>
                                {!! $htmlsortorder !!}
                            </select>
                            @error('sort_order')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image">Image</label>
@if($category->image && file_exists(public_path("images/categorys/" . $category->image)))
                                <div class="mb-2">
                                    <img src="{{ asset("images/categorys/" . $category->image) }}" alt="{{ $category->image }}" style="max-width: 100px; max-height: 100px;">
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
                                <option value="0" {{ $category->status == 1 ? 'selected' : '' }}>Chưa xuất bản</option>
                                <option value="1" {{ $category->status == 0 ? 'selected' : '' }}>Xuất bản</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- /.CONTENT -->
@endsection