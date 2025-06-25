@extends('layouts.admin')
@section('title','Edit Post')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Post</li>
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
                <a href="{{ route('admin.post.index') }}" class="btn btn-sm btn-info">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Posts
                </a>
            </div>
          </div>
        </div>
        <div class="card-body">
        <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h1 class="text-center">Edit Post</h1>
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-12 mb-3">
                            <label for="topic_id" class="form-label">Topic</label>
                            <select name="topic_id" id="topic_id" class="form-control">
                                <option value="">Topic</option>
                                {!! $htmltopicid !!}
                            </select>
                            @error('topic_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input
                                type="text"
                                id="title"
                                class="form-control"
                                name="title"
                                value="{{ old('title', $post->title) }}"
                            />
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea name="detail" id="detail" cols="155" rows="2">{{ old('detail', $post->detail) }}</textarea>
                            @error('detail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="155" rows="5">{{ old('description', $post->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="image">Image</label>
                            @if($post->image && file_exists(public_path("images/posts/" . $post->image)))
                                <div class="mb-2">
                                    <img src="{{ asset("images/posts/" . $post->image) }}" alt="{{ $post->image }}" style="max-width: 100px; max-height: 100px;">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="post" {{ old('type', $post->type) == 'post' ? 'selected' : '' }}>Post</option>
                                <option value="page" {{ old('type', $post->type) == 'page' ? 'selected' : '' }}>Page</option>
                            </select>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Show</option>
                                <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Hide</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-primary w-100" type="submit">Update Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </section>
  </div>
@endsection
