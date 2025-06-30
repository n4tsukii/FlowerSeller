@extends('layouts.admin')
@section('title','Posts Management')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-blog me-2"></i>Posts Management
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                <li class="breadcrumb-item active text-secondary">Posts</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    
    <section class="content">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient-primary text-white border-0 py-4">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h4 class="mb-0 fw-bold">
                <i class="fas fa-blog me-2"></i>All Posts
              </h4>
              <small class="opacity-75">Manage your blog posts and articles</small>
            </div>
            <div class="col-md-6">
              <!-- Search and Filter -->
              <div class="row g-2">
                <div class="col-md-8">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                      <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Search posts..." id="searchInput">
                  </div>
                </div>
                <div class="col-md-4">
                  <select class="form-select" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="row mt-3">
            <div class="col-12 text-end">
              <a href="{{route('admin.post.create')}}" class="btn btn-light btn-sm rounded-pill shadow-sm me-2 hover-lift">
                <i class="fas fa-plus me-1"></i>Add New Post
              </a>
              <a href="{{ route('admin.post.trash') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                <i class="fas fa-trash me-1"></i>Trash Bin
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0" id="postsTable"> 
              <thead class="bg-light">
                <tr>
                  <th class="border-0 py-3">
                    <i class="fas fa-image me-2 text-primary"></i>Image
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-tags me-2 text-success"></i>Topic
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-heading me-2 text-info"></i>Title
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-align-left me-2 text-warning"></i>Description
                  </th>
                  <th class="text-center border-0 py-3">
                    <i class="fas fa-toggle-on me-2 text-secondary"></i>Status
                  </th>
                  <th class="text-center border-0 py-3">
                    <i class="fas fa-cogs me-2 text-dark"></i>Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($list as $row)
                  <tr class="post-row border-bottom" data-status="{{ $row->status }}">
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div class="post-image-container me-3">
                          <img src="{{ asset('images/posts/'.$row->image) }}" 
                               alt="{{ $row->title }}" 
                               class="rounded-3 shadow-sm"
                               style="width: 60px; height: 60px; object-fit: cover;">
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                        <i class="fas fa-tag me-1"></i>{{ $row->topicname }}
                      </span>
                    </td>
                    <td class="align-middle">
                      <div class="fw-bold text-dark mb-1">{{ Str::limit($row->title, 30) }}</div>
                      <small class="text-muted">ID: {{ $row->id }}</small>
                    </td>
                    <td class="align-middle">
                      <div class="text-muted">
                        {{ Str::limit($row->description, 50) }}
                      </div>
                    </td>
                    <td class="text-center align-middle">
                      @if ($row->status == 1)
                        <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                          <i class="fas fa-check-circle me-1"></i>Active
                        </span>
                      @else
                        <span class="badge bg-gradient-secondary rounded-pill px-3 py-2">
                          <i class="fas fa-pause-circle me-1"></i>Inactive
                        </span>
                      @endif
                    </td>
                    <td class="text-center align-middle">
                      @php
                          $args = ['id' => $row->id];
                      @endphp
                      <div class="btn-group" role="group">
                        @if ($row->status==1)
                        <a href="{{ route('admin.post.status', $args) }}" 
                           class="btn btn-sm btn-outline-success rounded-pill me-1 hover-lift"
                           title="Deactivate">
                            <i class="fas fa-toggle-on"></i>
                        </a>
                        @else
                        <a href="{{ route('admin.post.status', $args) }}" 
                           class="btn btn-sm btn-outline-secondary rounded-pill me-1 hover-lift"
                           title="Activate">
                            <i class="fas fa-toggle-off"></i>
                        </a>
                        @endif
                        <a href="{{ route('admin.post.show', $args) }}" 
                           class="btn btn-sm btn-outline-info rounded-pill me-1 hover-lift"
                           title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.post.edit', $args) }}" 
                           class="btn btn-sm btn-outline-primary rounded-pill me-1 hover-lift"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.post.delete', $args) }}" 
                           class="btn btn-sm btn-outline-danger rounded-pill hover-lift"
                           title="Delete"
                           onclick="return confirm('Are you sure you want to delete this post?')">
                            <i class="fas fa-trash"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const table = document.getElementById('postsTable');
    const rows = table.querySelectorAll('tbody tr');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        
        rows.forEach(row => {
            const title = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const topic = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const description = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            const status = row.getAttribute('data-status');
            
            const matchesSearch = title.includes(searchTerm) || 
                                topic.includes(searchTerm) || 
                                description.includes(searchTerm);
            const matchesStatus = statusValue === '' || status === statusValue;
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                row.style.animation = 'fadeIn 0.3s ease-in';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
    
    // Add hover effects and animations
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.post-row {
    transition: all 0.3s ease;
}

.post-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 0.5rem;
}

.text-gradient {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #56ab2f 0%, #a8e6cf 100%);
}

.bg-gradient-secondary {
    background: linear-gradient(45deg, #bdc3c7 0%, #2c3e50 100%);
}

.card {
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.btn-group .btn {
    margin-right: 0.25rem;
}

.btn-group .btn:last-child {
    margin-right: 0;
}
</style>

@endsection