@extends('layouts.admin')
@section('title', 'Topic Trash')
@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trash Topic Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Topic Trash</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.topic.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Topics
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
                                    <th class="text-center">Topic Name</th>
                                    <th class="text-center">Slug</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                <tr>
                                    <td class="text-center"><input type="checkbox" name="topic_checkbox" value="1"></td>
                                    <td class="text-center">{{$row->name}}</td>
                                    <td class="text-center">{{$row->description}}</td>
                                    <td class="text-center">{{$row->slug}}</td>
                                    <td>
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp

                                        <a href="{{ route('admin.topic.show', $args) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.topic.restore', $args) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-undo" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('admin.topic.destroy', $args) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" name="delete" type="submit">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">{{$row->id}}</td>
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
