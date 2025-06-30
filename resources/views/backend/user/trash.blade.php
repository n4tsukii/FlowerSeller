@extends('layouts.admin')
@section('title', 'Trash Users')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-trash me-2"></i>Trash Users
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}" class="text-primary">Users</a></li>
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
                            <i class="fas fa-trash me-2"></i>Deleted Users
                        </h4>
                        <small class="opacity-75">Restore or permanently delete users</small>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-1"></i>Back to Users
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
                                        <i class="fas fa-user me-2 text-primary"></i>Profile
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-envelope me-2 text-info"></i>Contact
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-user-tag me-2 text-warning"></i>Role
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
                                            <div class="user-avatar me-3">
                                                @if($row->image && file_exists(public_path('images/users/'.$row->image)))
                                                    <img src="{{ asset('images/users/'.$row->image) }}" 
                                                         alt="{{ $row->name }}" 
                                                         class="rounded-circle shadow-sm" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $row->name }}</div>
                                                <small class="text-muted">@{{ $row->username }}</small>
                                                @if($row->gender)
                                                    <div class="mt-1">
                                                        @if($row->gender == 1)
                                                            <span class="badge bg-primary rounded-pill">
                                                                <i class="fas fa-mars me-1"></i>Male
                                                            </span>
                                                        @elseif($row->gender == 2)
                                                            <span class="badge bg-pink rounded-pill">
                                                                <i class="fas fa-venus me-1"></i>Female
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="contact-info">
                                            <div class="mb-1">
                                                <i class="fas fa-envelope me-2 text-info"></i>
                                                <span class="text-dark">{{ $row->email }}</span>
                                            </div>
                                            @if($row->phone)
                                                <div class="mb-1">
                                                    <i class="fas fa-phone me-2 text-success"></i>
                                                    <span class="text-dark">{{ $row->phone }}</span>
                                                </div>
                                            @endif
                                            @if($row->address)
                                                <div>
                                                    <i class="fas fa-map-marker-alt me-2 text-warning"></i>
                                                    <small class="text-muted">{{ Str::limit($row->address, 30) }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($row->roles == 'admin')
                                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                                <i class="fas fa-crown me-1"></i>Administrator
                                            </span>
                                        @elseif($row->roles == 'customer')
                                            <span class="badge bg-success rounded-pill px-3 py-2">
                                                <i class="fas fa-user me-1"></i>Customer
                                            </span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill px-3 py-2">
                                                <i class="fas fa-question me-1"></i>{{ ucfirst($row->roles) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.user.show', $args) }}" 
                                               class="btn btn-outline-info btn-sm rounded-pill me-1 hover-lift"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.user.restore', $args) }}" 
                                               class="btn btn-outline-success btn-sm rounded-pill me-1 hover-lift"
                                               title="Restore User">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                            <form action="{{ route('admin.user.destroy', $args) }}" 
                                                  method="post" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to permanently delete this user?')">
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
                        <h5 class="text-muted">No deleted users found</h5>
                        <p class="text-muted mb-4">All users are active and available.</p>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Back to Users
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
