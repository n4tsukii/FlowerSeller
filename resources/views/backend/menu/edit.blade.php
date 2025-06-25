@extends('layouts.admin')
@section('title','Update Menu')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Menu Page</li>
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
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Menus
                    </a>
                </div>
            </div>
        </div>
            <div class="card-body">
                <form action="{{ route('admin.menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h1 class="text-center">Update Menu</h1>
                    <div class="container">
                        <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    class="form-control"
                                    name="name"
                                    value="{{ old('name', $menu->name) }}"
                                />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="link" class="form-label">Link</label>
                                <input
                                    type="text"
                                    id="link"
                                    class="form-control"
                                    name="link"
                                    value="{{ old('link', $menu->link) }}"
                                />
                                @error('link')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input
                                    type="text"
                                    id="type"
                                    class="form-control"
                                    name="type"
                                    value="{{ old('type', $menu->type) }}"
                                /> 
                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select name="position" id="position" class="form-control">
                                <option value="mainmenu" {{ $menu->position == "mainmenu" ? 'selected' : '' }}>Main menu</option>
                                <option value="footermenu" {{ $menu->position == "footermenu" ? 'selected' : '' }}>Footer menu</option>
                            </select>
                            @error('position')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                            <div class="col-md-12 mb-3">
                                <label for="parent_id">Parent ID</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="0">Cấp cha</option>
                                    {!! $htmlparentid !!}
                                </select>
                                @error('parent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="sort_order">Sort Order</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="">Chọn vị trí</option>
                                    {!! $htmlsortorder !!}
                                </select>
                                @error('sort_order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Show</option>
                                    <option value="0" {{ $menu->status == 0 ? 'selected' : '' }}>Hide</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-success w-100" type="submit">
                                    Update Menu
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
