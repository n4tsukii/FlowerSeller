@extends('layouts.admin')
@section('title','Addproduct')
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
        <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h1 class="text-center">Add product</h1>
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input
                                type="text"
                                id="name"
                                class="form-control"
                                name="name"
                                value="{{ old('name') }}"
                            />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="1">Category name</option>
                                {{!!$htmlcategoryid!!}}
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                <option value="1">Brand name</option>
                                {{!!$htmlbrandid!!}}
                            </select>
                            @error('brand_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea name="detail" id="detail" cols="155" rows="2" >{{old("description")}}</textarea>
                            @error('detail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description"  cols="155" rows="5" >{{old("description")}}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="col-md-12 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input
                                type="number"
                                id="price"
                                class="form-control"
                                name="price"
                                value="{{ old('price') }}"
                                
                            />
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="pricesale" class="form-label">Sale Price</label>
                            <input
                                type="number"
                                id="pricesale"
                                class="form-control"
                                name="pricesale"
                                value="{{ old('pricesale') }}"
                            />
                            @error('pricesale')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input
                                type="number"
                                id="qty"
                                class="form-control"
                                name="qty"
                                value="{{ old('qty') }}"
                            />
                            @error('qty')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input
                                type="file"
                                id="image"
                                class="form-control"
                                name="image"
                            />
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Chua xuat ban</option>
                                <option value="0">Xuat ban</option>
                            </select>
                            @error('pricesale')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button
                                class="btn btn-primary w-100"
                                type="submit"
                            >
                                Add Product
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </section>
    <!-- /.CONTENT -->
  </div>@endsection