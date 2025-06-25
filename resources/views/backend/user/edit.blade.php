@extends('layouts.admin')
@section('title','Edit User')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Users
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h1 class="text-center">Update User</h1>
                    <div class="container">
                        <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    value="{{ old('name', $user->name) }}" />
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="username" class="form-label">UserName</label>
                                <input type="text" id="username" class="form-control" name="username"
                                    value="{{ old('username', $user->username) }}" />
                                @error('username')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- <div class="col-md-12 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" id="password" class="form-control" name="password"
                                    value="{{ old('password') }}" />
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> -->
                            <div class="col-md-12 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male</option>
                                    <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" class="form-control" name="phone"
                                    value="{{ old('phone', $user->phone) }}" />
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    value="{{ old('email', $user->email) }}" />
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                @if($user->image && file_exists(public_path("images/users/" . $user->image)))
                                    <div class="mb-2">
                                        <img src="{{ asset("images/users/" . $user->image) }}" alt="{{ $user->image }}" style="max-width: 100px; max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" id="image" class="form-control" name="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="roles" class="form-label">Role</label>
                                <select name="roles" id="roles" class="form-control">
                                    <option value="customer" {{ $user->roles == 'customer' ? 'selected' : '' }}>Customer</option>
                                    <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('roles')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" class="form-control" name="address"
                                    value="{{ old('address', $user->address) }}" />
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Chưa xuất bản</option>
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Xuất bản</option>
                                </select>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-primary w-100" type="submit">Update User</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
</div>
@endsection
