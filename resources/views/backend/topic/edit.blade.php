@extends('layouts.admin')
@section('title', 'Edit Topic')
@section('content')

<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Topic Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Topic</li>
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
                        <a href="{{ route('admin.topic.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Topics
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.topic.update', $topic->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <h1 class="text-center">Edit Topic</h1>

                    <div class="container">
                        <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Topic Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    class="form-control"
                                    name="name"
                                    value="{{ old('name', $topic->name) }}"
                                />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="">Sort order</option>
                                    {!! $htmlsortorder !!}
                                </select>
                                @error('sort_order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea 
                                    name="description" 
                                    id="description" 
                                    class="form-control"
                                    rows="3"
                                >{{ old('description', $topic->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $topic->status) == 1 ? 'selected' : '' }}>Chưa xuất bản</option>
                                    <option value="0" {{ old('status', $topic->status) == 0 ? 'selected' : '' }}>Xuất bản</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-primary w-100" type="submit">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
</div>
@endsection
