@extends('layouts.admin')
@section('title', 'Trash Brand')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trash Brand Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Brand Page</li>
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
                        <a href="{{ route('admin.brand.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Brands
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Brand Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="brand_checkbox" value="1">
                                    </td>
                                    <td>
                                        <img style="width: 150px; height: 150px;" src="{{ asset('images/brands/'.$row->image) }}" alt="{{ $row->image }}">
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp

                                        <a href="{{ route('admin.brand.show', $args) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.brand.restore', $args) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-undo" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('admin.brand.destroy', $args) }}" method="post" style="display: inline-block;">
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
            </div>
        </div>
    </section>
</div>
@endsection
