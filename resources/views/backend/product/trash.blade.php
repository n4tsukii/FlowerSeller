@extends('layouts.admin')
@section('title', 'Trash Products')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-trash me-2"></i>Trash Products
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}" class="text-primary">Products</a></li>
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
                            <i class="fas fa-trash me-2"></i>Deleted Products
                        </h4>
                        <small class="opacity-75">Restore or permanently delete products</small>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-1"></i>Back to Products
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
                                        <i class="fas fa-image me-2 text-primary"></i>Product
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-tags me-2 text-success"></i>Category & Brand
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-dollar-sign me-2 text-warning"></i>Pricing
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
                                            <div class="product-image me-3">
                                                @if($row->image && file_exists(public_path('images/products/'.$row->image)))
                                                    <img src="{{ asset('images/products/'.$row->image) }}" 
                                                         alt="{{ $row->name }}" 
                                                         class="rounded-3 shadow-sm" 
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $row->name }}</div>
                                                <small class="text-muted">ID: {{ $row->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div>
                                            <span class="badge bg-primary rounded-pill mb-1">
                                                <i class="fas fa-folder me-1"></i>{{ $row->categoryname }}
                                            </span>
                                            <br>
                                            <span class="badge bg-secondary rounded-pill">
                                                <i class="fas fa-star me-1"></i>{{ $row->brandname }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="pricing-info">
                                            <div class="fw-bold text-success">
                                                <i class="fas fa-tag me-1"></i>${{ number_format($row->pricesale ?: $row->price, 2) }}
                                            </div>
                                            @if($row->pricesale && $row->pricesale != $row->price)
                                                <small class="text-muted text-decoration-line-through">
                                                    ${{ number_format($row->price, 2) }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.product.show', $args) }}" 
                                               class="btn btn-outline-info btn-sm rounded-pill me-1 hover-lift"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.product.restore', $args) }}" 
                                               class="btn btn-outline-success btn-sm rounded-pill me-1 hover-lift"
                                               title="Restore Product">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                            <form action="{{ route('admin.product.destroy', $args) }}" 
                                                  method="post" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to permanently delete this product?')">
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
                        <h5 class="text-muted">No deleted products found</h5>
                        <p class="text-muted mb-4">All products are active and available.</p>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Back to Products
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
