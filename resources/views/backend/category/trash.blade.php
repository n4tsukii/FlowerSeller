@extends('layouts.admin')
@section('title', 'Trash Categories')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-trash me-2"></i>Trash Categories
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}" class="text-primary">Categories</a></li>
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
                            <i class="fas fa-trash me-2"></i>Deleted Categories
                        </h4>
                        <small class="opacity-75">Restore or permanently delete categories</small>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-1"></i>Back to Categories
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
                                        <i class="fas fa-image me-2 text-primary"></i>Category
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-sitemap me-2 text-success"></i>Hierarchy
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-align-left me-2 text-info"></i>Description
                                    </th>
                                    <th class="text-center border-0 py-3">
                                        <i class="fas fa-cogs me-2 text-dark"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                <tr class="border-bottom">
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="category-image me-3">
                                                @if($row->image && file_exists(public_path('images/categorys/'.$row->image)))
                                                    <img src="{{ asset('images/categorys/'.$row->image) }}" 
                                                         alt="{{ $row->name }}" 
                                                         class="rounded-3 shadow-sm" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-folder text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $row->name }}</div>
                                                <small class="text-muted">{{ $row->slug }}</small>
                                                <br>
                                                <small class="text-muted">ID: {{ $row->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($row->parent_id)
                                            <span class="badge bg-info rounded-pill">
                                                <i class="fas fa-level-up-alt me-1"></i>Child Category
                                            </span>
                                            <br>
                                            <small class="text-muted">Parent ID: {{ $row->parent_id }}</small>
                                        @else
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="fas fa-crown me-1"></i>Parent Category
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-muted">
                                            {{ Str::limit($row->description ?: 'No description', 50) }}
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.category.show', $args) }}" 
                                               class="btn btn-outline-info btn-sm rounded-pill me-1 hover-lift"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.category.restore', $args) }}" 
                                               class="btn btn-outline-success btn-sm rounded-pill me-1 hover-lift"
                                               title="Restore Category">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                            <form action="{{ route('admin.category.destroy', $args) }}" 
                                                  method="post" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to permanently delete this category?')">
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
                        <h5 class="text-muted">No deleted categories found</h5>
                        <p class="text-muted mb-4">All categories are active and available.</p>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Back to Categories
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
