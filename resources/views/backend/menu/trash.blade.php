@extends('layouts.admin')
@section('title', 'Trash Menu')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trash Menu Page</h1>
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
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Menu Name</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Parent ID</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Action</th>
                            <th class="text-center">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                        <tr>
                            <td><input type="checkbox" name="menu_checkbox" value="1"></td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->link }}</td>
                            <td>{{ $row->parent_id }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->position }}</td>
                            <td>
                                @php
                                    $args = ['id' => $row->id];
                                @endphp

                                <a href="{{ route('admin.menu.show', $args) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('admin.menu.restore', $args) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('admin.menu.destroy', $args) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger" name="delete" type="submit">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $row->id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
</div>
@endsection
