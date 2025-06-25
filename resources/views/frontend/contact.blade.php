@extends('layouts.site')
@section('title','Contact')
@section('content')
<div class="container-fluid py-5 wow">
    <div class="container">
      <div class="text-center mx-auto mb-5" style="max-width: 600px">
        <h5 class="text-primary text-uppercase" style="letter-spacing: 5px">
          Contact Us
        </h5>
      </div>
      <div class="row g-5">
        <div class="col-lg-7 wow">
          <div class="bg-light rounded p-5">
          <form action="{{ route('site.contact.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div> 
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4">{{ old('content') }}</textarea>
            </div>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary mt-2">Send Message</button>
        </form>
          </div>
        </div>
        <div class="col-lg-5 wow">
          <div class="bg-white rounded shadow-sm p-4" style="min-height: 350px;">
            <div class="mb-4 text-start">
                <h5 class="mb-3" style="color:#a18cd1;font-weight:700;"><i class="bi bi-info-circle me-2"></i>Thông tin liên hệ</h5>
                <div class="mb-1 d-flex align-items-center">
                    <i class="bi bi-geo-alt-fill me-2" style="color:#a18cd1;"></i>
                    <span><strong>Địa chỉ:</strong> Tòa nhà Ladeco, 266 Đội Cấn, Ba Đình,Hà Nội</span>
                </div>
                <div class="mb-1 d-flex align-items-center">
                    <i class="bi bi-telephone-fill me-2" style="color:#a18cd1;"></i>
                    <span><strong>Điện thoại:</strong> 123456789</span>
                </div>
                <div class="mb-1 d-flex align-items-center">
                    <i class="bi bi-envelope-fill me-2" style="color:#a18cd1;"></i>
                    <span><strong>Email:</strong> contact@gmail.com</span>
                </div>
            </div>
            <div class="rounded overflow-hidden" style="border: 2px solid #a18cd1;">
                <iframe
                    class="position-relative w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0"
                    style="height: 200px; border: 0"
                    allowfullscreen=""
                    aria-hidden="false"
                    tabindex="0"
                ></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

