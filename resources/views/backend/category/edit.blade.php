@extends('layouts.admin')
@section('title','Edit Category')
@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-edit me-2"></i>Edit Category
                    </h1>
                    <p class="text-muted">Update category information</p>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}" class="text-primary">Categories</a></li>
                            <li class="breadcrumb-item active text-secondary">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-warning text-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0 fw-bold">
                                    <i class="fas fa-edit me-2"></i>Edit Category
                                </h4>
                                <small class="opacity-75">Update category details</small>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                                    <i class="fas fa-arrow-left me-1"></i>Back to Categories
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data" id="editCategoryForm">
                                    @csrf
                                    @method('put')
                                    
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label for="name" class="form-label fw-bold">
                                                <i class="fas fa-tag me-2 text-primary"></i>Category Name
                                            </label>
                                            <input type="text" value="{{ old('name', $category->name) }}" name="name" id="name" 
                                                   class="form-control form-control-lg rounded-3 shadow-sm" 
                                                   placeholder="Enter category name">
                                            @error('name')
                                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="description" class="form-label fw-bold">
                                                <i class="fas fa-align-left me-2 text-info"></i>Description
                                            </label>
                                            <textarea name="description" id="description" rows="4" 
                                                      class="form-control rounded-3 shadow-sm" 
                                                      placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                                            @error('description')
                                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="parent_id" class="form-label fw-bold">
                                                <i class="fas fa-sitemap me-2 text-warning"></i>Parent Category
                                            </label>
                                            <select name="parent_id" id="parent_id" class="form-select rounded-3 shadow-sm">
                                                <option value="0">Root Category</option>
                                                {!! $htmlparentid !!}
                                            </select>
                                            @error('parent_id')
                                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="sort_order" class="form-label fw-bold">
                                                <i class="fas fa-sort me-2 text-secondary"></i>Sort Order
                                            </label>
                                            <select name="sort_order" id="sort_order" class="form-select rounded-3 shadow-sm">
                                                <option value="">Choose position</option>
                                                {!! $htmlsortorder !!}
                                            </select>
                                            @error('sort_order')
                                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="image" class="form-label fw-bold">
                                                <i class="fas fa-image me-2 text-primary"></i>Category Image
                                            </label>
                                            @if($category->slug && file_exists(public_path('images/categories/' . $category->slug . '.png')))
                                                <div class="mb-3">
                                                    <img src="{{ asset('images/categories/' . $category->slug . '.png') }}" 
                                                         alt="{{ $category->name }}" 
                                                         class="rounded-3 shadow-sm d-block"
                                                         style="width: 100px; height: 100px; object-fit: cover;">
                                                    <small class="text-muted">Current image</small>
                                                </div>
                                            @elseif($category->slug && file_exists(public_path('images/categories/' . $category->slug . '.jpg')))
                                                <div class="mb-3">
                                                    <img src="{{ asset('images/categories/' . $category->slug . '.jpg') }}" 
                                                         alt="{{ $category->name }}" 
                                                         class="rounded-3 shadow-sm d-block"
                                                         style="width: 100px; height: 100px; object-fit: cover;">
                                                    <small class="text-muted">Current image</small>
                                                </div>
                                            @elseif($category->slug && file_exists(public_path('images/categories/' . $category->slug . '.jpeg')))
                                                <div class="mb-3">
                                                    <img src="{{ asset('images/categories/' . $category->slug . '.jpeg') }}" 
                                                         alt="{{ $category->name }}" 
                                                         class="rounded-3 shadow-sm d-block"
                                                         style="width: 100px; height: 100px; object-fit: cover;">
                                                    <small class="text-muted">Current image</small>
                                                </div>
                                            @endif
                                            <input type="file" name="image" id="image" 
                                                   class="form-control rounded-3 shadow-sm" 
                                                   accept="image/*">
                                            <small class="text-muted">Leave empty to keep current image</small>
                                            @error('image')
                                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="status" class="form-label fw-bold">
                                                <i class="fas fa-toggle-on me-2 text-success"></i>Status
                                            </label>
                                            <select name="status" id="status" class="form-select rounded-3 shadow-sm">
                                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill me-md-2">
                                                    <i class="fas fa-times me-2"></i>Cancel
                                                </a>
                                                <button type="submit" class="btn btn-gradient-warning btn-lg rounded-pill shadow hover-lift">
                                                    <i class="fas fa-save me-2"></i>Update Category
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.text-gradient {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f39c12 0%, #e67e22 100%);
}

.btn-gradient-warning {
    background: linear-gradient(45deg, #f39c12 0%, #e67e22 100%);
    border: none;
    color: white;
}

.btn-gradient-warning:hover {
    background: linear-gradient(45deg, #e67e22 0%, #d35400 100%);
    color: white;
}

.form-control:focus, .form-select:focus {
    border-color: #f39c12;
    box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('editCategoryForm');
    const nameInput = document.getElementById('name');
    
    form.addEventListener('submit', function(e) {
        if (nameInput.value.trim() === '') {
            e.preventDefault();
            nameInput.classList.add('is-invalid');
            nameInput.focus();
            return false;
        }
    });
    
    nameInput.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
    
    // Image preview
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let preview = document.getElementById('newImagePreview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'newImagePreview';
                        preview.className = 'mt-2 rounded-3 shadow-sm d-block';
                        preview.style.width = '100px';
                        preview.style.height = '100px';
                        preview.style.objectFit = 'cover';
                        
                        const label = document.createElement('small');
                        label.className = 'text-muted d-block';
                        label.textContent = 'New image preview';
                        
                        imageInput.parentNode.appendChild(preview);
                        imageInput.parentNode.appendChild(label);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

@endsection