@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-4 mb-4" role="alert">
  <div class="d-flex align-items-center">
    <div class="flex-shrink-0">
      <i class="fas fa-check-circle fa-lg text-success me-3"></i>
    </div>
    <div class="flex-grow-1">
      <h5 class="alert-heading mb-1">Success!</h5>
      <p class="mb-0">{{ session('success') }}</p>
    </div>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-4 mb-4" role="alert">
  <div class="d-flex align-items-center">
    <div class="flex-shrink-0">
      <i class="fas fa-exclamation-circle fa-lg text-danger me-3"></i>
    </div>
    <div class="flex-grow-1">
      <h5 class="alert-heading mb-1">Error!</h5>
      <p class="mb-0">{{ session('error') }}</p>
    </div>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show shadow-sm border-0 rounded-4 mb-4" role="alert">
  <div class="d-flex align-items-center">
    <div class="flex-shrink-0">
      <i class="fas fa-exclamation-triangle fa-lg text-warning me-3"></i>
    </div>
    <div class="flex-grow-1">
      <h5 class="alert-heading mb-1">Warning!</h5>
      <p class="mb-0">{{ session('warning') }}</p>
    </div>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('info'))
<div class="alert alert-info alert-dismissible fade show shadow-sm border-0 rounded-4 mb-4" role="alert">
  <div class="d-flex align-items-center">
    <div class="flex-shrink-0">
      <i class="fas fa-info-circle fa-lg text-info me-3"></i>
    </div>
    <div class="flex-grow-1">
      <h5 class="alert-heading mb-1">Information</h5>
      <p class="mb-0">{{ session('info') }}</p>
    </div>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-4 mb-4" role="alert">
  <div class="d-flex align-items-start">
    <div class="flex-shrink-0">
      <i class="fas fa-exclamation-circle fa-lg text-danger me-3"></i>
    </div>
    <div class="flex-grow-1">
      <h5 class="alert-heading mb-2">Validation Errors!</h5>
      <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<style>
.alert {
  animation: slideInDown 0.5s ease-out;
}

@keyframes slideInDown {
  0% {
    opacity: 0;
    transform: translateY(-30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.alert .btn-close {
  background-size: 0.8rem;
}

.alert-success {
  background: linear-gradient(45deg, rgba(6, 214, 160, 0.1) 0%, rgba(23, 197, 126, 0.1) 100%);
  border-left: 4px solid #06d6a0;
}

.alert-danger {
  background: linear-gradient(45deg, rgba(238, 108, 77, 0.1) 0%, rgba(220, 53, 69, 0.1) 100%);
  border-left: 4px solid #ee6c4d;
}

.alert-warning {
  background: linear-gradient(45deg, rgba(249, 132, 74, 0.1) 0%, rgba(255, 193, 7, 0.1) 100%);
  border-left: 4px solid #f9844a;
}

.alert-info {
  background: linear-gradient(45deg, rgba(61, 90, 241, 0.1) 0%, rgba(13, 202, 240, 0.1) 100%);
  border-left: 4px solid #3d5af1;
}
</style>
