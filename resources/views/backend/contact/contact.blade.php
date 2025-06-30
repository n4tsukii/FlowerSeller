@extends('layouts.admin')
@section('title','Contact')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact Page</li>
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
      
                    <a href="{{ route('admin.contact.trash') }}" class="btn btn-sm btn-danger ">
                        <i class="fa fa-trash px-2" aria-hidden="true"></i>Trash bin
                    </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-striped"> 
            <thead>
            <tr>
                <th class="text-center">Tên khách hàng</th>
                <th class="text-center">Email</th>
                <th class="text-center">Điện thoại</th>
                <th class="text-center">Tiêu đề</th>
                <th class="text-center">Nội dung</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Thao tác</th>
            </tr>
            </thead>
            <tbody>              @foreach ($list as $row)
                <tr>
                    <td class="fw-bold">{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->title}}</td>
                    <td>
                        <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                            {{Str::limit($row->content, 50)}}
                        </div>
                    </td>
                    <td class="text-center">
                        @php $args = ['id' => $row->id]; @endphp
                        @if ($row->status==1)
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>Đã xử lý
                            </span>
                        @else
                            <span class="badge bg-warning">
                                <i class="fas fa-clock me-1"></i>Chờ xử lý
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            @if ($row->status==1)
                                <a href="{{ route('admin.contact.status', $args) }}" class="btn btn-sm btn-outline-warning" title="Đánh dấu chưa xử lý">
                                    <i class="fas fa-undo"></i>
                                </a>
                            @else
                                <a href="{{ route('admin.contact.status', $args) }}" class="btn btn-sm btn-outline-success" title="Đánh dấu đã xử lý">
                                    <i class="fas fa-check"></i>
                                </a>
                            @endif
                            <a href="{{ route('admin.contact.show', $args) }}" class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.contact.edit', $args) }}" class="btn btn-sm btn-outline-primary" title="Trả lời">
                                <i class="fas fa-reply"></i>
                            </a>
                            <a href="{{ route('admin.contact.delete', $args) }}" class="btn btn-sm btn-outline-danger" title="Xóa">
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
    </section>
    <!-- /.CONTENT -->
  </div>@endsection