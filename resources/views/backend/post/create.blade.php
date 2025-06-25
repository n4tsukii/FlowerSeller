@extends('layouts.admin')
@section('title','Addpost')
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
                        <a href="{{ route('admin.post.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Posts
                        </a>
                    </div>
                </div>
            </div>
        <div class="card-body">
        <form action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h1 class="text-center">Add post</h1>
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-12 mb-3">
                            <label for="topic_id" class="form-label">Topic</label>
                            <select name="topic_id" id="topic_id" class="form-control">
                                <option value="">Topic</option>
                                {{!!$htmltopicid!!}}
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
                                value="{{ old('title') }}"
                            />
                            @error('title')
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
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="post">Post</option>
                                <option value="page">Page</option>
                            </select>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button
                                class="btn btn-primary w-100"
                                type="submit"
                            >
                                Add post
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </section>
  </div>>@endsection