@extends('layouts.admin')
@section('title','Quản lý thương hiệu')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lý thương hiệu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý thương hiệu</li>
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
                    <a href="{{ route('admin.brand.trash') }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash px-2" aria-hidden="true"></i>Thùng rác
                    </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
            <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Tên thương hiệu</label>
                                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control">
                                    @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="sort_order">Thứ tự sắp xếp</label>
                                    <select name="sort_order" id="sort_order" class="form-control">
                                        <option value="">Chọn thứ tự</option>
                                        {!! $htmlsortorder !!}
                                    </select>
                                    @error('sort_order')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image">Hình ảnh</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                    @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Thêm mới</button>
                                </div>
                            </form>
            </div>
            <div class="col-md-9">
            <table class="table table-bordered table-hover table-striped"> 
            <thead>
            <tr>
                <th class="text-center">Hình ảnh</th>
                <th class="text-center">Tên thương hiệu</th>
                <th class="text-center">Mô tả</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $row)
                <tr>
                    <td class="text-center">
                        @php
                            $imagePath = null;
                            $extensions = ['png', 'jpg', 'jpeg'];
                            foreach ($extensions as $ext) {
                                $path = public_path('images/brand/' . $row->slug . '.' . $ext);
                                if (file_exists($path)) {
                                    $imagePath = asset('images/brand/' . $row->slug . '.' . $ext);
                                    break;
                                }
                            }
                        @endphp
                        
                        @if($imagePath)
                            <img class="rounded" style="width: 60px; height: 60px; object-fit: cover;" 
                                 src="{{ $imagePath }}" 
                                 alt="{{ $row->name }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-building text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-bold">{{$row->name}}</td>
                    <td>{{$row->description}}</td>
                    <td class="text-center">
                        @php $args = ['id' => $row->id]; @endphp
                        @if ($row->status==1)
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>Hoạt động
                            </span>
                        @else
                            <span class="badge bg-warning">
                                <i class="fas fa-pause me-1"></i>Tạm dừng
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            @if ($row->status==1)
                                <a href="{{ route('admin.brand.status', $args) }}" class="btn btn-sm btn-outline-warning" title="Tạm dừng">
                                    <i class="fas fa-pause"></i>
                                </a>
                            @else
                                <a href="{{ route('admin.brand.status', $args) }}" class="btn btn-sm btn-outline-success" title="Kích hoạt">
                                    <i class="fas fa-play"></i>
                                </a>
                            @endif
                            <a href="{{ route('admin.brand.edit', $args) }}" class="btn btn-sm btn-outline-primary" title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.brand.delete', $args) }}" class="btn btn-sm btn-outline-danger" title="Xóa">
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
      </div>
    </section>
  </div>@endsection

