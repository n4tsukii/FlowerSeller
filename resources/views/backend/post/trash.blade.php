@extends('layouts.admin')
@section('title', 'Trash Posts')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-trash me-2"></i>Trash Posts
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}" class="text-primary">Posts</a></li>
                            <li class="breadcrumb-item active text-secondary">Trash</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-gradient-danger text-white border-0 py-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-trash me-2"></i>Deleted Posts
                        </h4>
                        <small class="opacity-75">Restore or permanently delete posts</small>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.post.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-1"></i>Back to Posts
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @if($list->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-newspaper me-2 text-primary"></i>Post
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-tags me-2 text-success"></i>Topic
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-align-left me-2 text-info"></i>Content
                                    </th>
                                    <th class="text-center border-0 py-3">
                                        <i class="fas fa-cogs me-2 text-dark"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $row)
                                <tr class="border-bottom">
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="post-image me-3">
                                                @if($row->image && file_exists(public_path('images/posts/'.$row->image)))
                                                    <img src="{{ asset('images/posts/'.$row->image) }}" 
                                                         alt="{{ $row->title }}" 
                                                         class="rounded-3 shadow-sm" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-newspaper text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ Str::limit($row->title, 40) }}</div>
                                                <small class="text-muted">{{ $row->slug }}</small>
                                                <br>
                                                <small class="text-muted">ID: {{ $row->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="fas fa-tag me-1"></i>{{ $row->topicname ?? 'No Topic' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-muted">
                                            <div class="mb-1">
                                                <strong>Description:</strong> {{ Str::limit($row->description, 50) ?: 'No description' }}
                                            </div>
                                            @if($row->detail)
                                                <div>
                                                    <strong>Content:</strong> {{ Str::limit(strip_tags($row->detail), 50) }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.post.show', $args) }}" 
                                               class="btn btn-outline-info btn-sm rounded-pill me-1 hover-lift"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.post.restore', $args) }}" 
                                               class="btn btn-outline-success btn-sm rounded-pill me-1 hover-lift"
                                               title="Restore Post">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                            <form action="{{ route('admin.post.destroy', $args) }}" 
                                                  method="post" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to permanently delete this post?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger btn-sm rounded-pill hover-lift" 
                                                        type="submit"
                                                        title="Delete Permanently">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-trash text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="text-muted">No deleted posts found</h5>
                        <p class="text-muted mb-4">All posts are active and available.</p>
                        <a href="{{ route('admin.post.index') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Back to Posts
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
