@extends('layouts.admin')
@section('title', 'Topic')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Topic Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Topic Page</li>
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
                        <a href="{{ route('admin.topic.trash') }}" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash px-2" aria-hidden="true"></i>Trash bin
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{ route('admin.topic.store') }}" method="post">
                            @csrf
                            <div class="container">
                                <div class="row g-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="name" class="form-label">Topic Name</label>
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{ old('name') }}" />
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="sort_order" class="form-label">Sort Order</label>
                                        <select name="sort_order" id="sort_order" class="form-control">
                                            <option value="0">Sort order</option>
                                            {!! $htmlsortorder !!}
                                        </select>
                                        @error('sort_order')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control"
                                            rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Xuất bản</option>
                                            <option value="0">Chưa xuất bản</option>
                                        </select>
                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Tên chủ đề</th>
                                    <th class="text-center">Mô tả</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->description}}</td>
                                    <td class="text-center">
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
                                        @php
                                        $args = ['id' => $row->id];
                                        @endphp
                                        <div class="btn-group" role="group">
                                            @if ($row->status==1)
                                                <a href="{{ route('admin.topic.status', $args) }}" class="btn btn-sm btn-outline-warning" title="Tạm dừng">
                                                    <i class="fas fa-pause"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.topic.status', $args) }}" class="btn btn-sm btn-outline-success" title="Kích hoạt">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.topic.show', $args) }}" class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.topic.edit', $args) }}" class="btn btn-sm btn-outline-primary" title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.topic.delete', $args) }}" class="btn btn-sm btn-outline-danger" title="Xóa">
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
    <!-- /.CONTENT -->
</div>
@endsection
