@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Page</li>
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
                        <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Products
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <h1 class="text-center">Edit Product</h1>
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    {!! $htmlcategoryid !!}
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    {!! $htmlbrandid !!}
                                </select>
                                @error('brand_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <textarea name="detail" id="detail" cols="30" rows="2" class="form-control">{{ old('detail', $product->detail) }}</textarea>
                                @error('detail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" id="price" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pricesale" class="form-label">Sale Price</label>
                                <input type="number" id="pricesale" class="form-control" name="pricesale" value="{{ old('pricesale', $product->pricesale) }}">
                                @error('pricesale')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" id="qty" class="form-control" name="qty" value="{{ old('qty', $product->qty) }}">
                                @error('qty')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                @if($product->image && file_exists(public_path("images/products/" . $product->image)))
                                    <div class="mb-2">
                                        <img src="{{ asset("images/products/" . $product->image) }}" alt="{{ $product->image }}" style="max-width: 100px; max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" id="image" class="form-control" name="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Not Published</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
