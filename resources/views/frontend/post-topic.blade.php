@extends('layouts.site')

@section('title', 'Bài viết theo chủ đề')

@section('content')
<section class="container mt-4">
    <div class="title-section">
        <h1>{{ $row->name }}</h1>
    </div>
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    Topic
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($topic_list as $topic)
                        <li class="list-group-item">
                            <a href="{{ route('site.post.topic', ['slug' => $topic->slug]) }}">{{$topic->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
         
        </div>
        <!-- Main content -->
        <div class="col-md-9">
            <div class="row">
            @foreach ($post_list as $post)
                <div class="col-md-4 mb-3">
                            <x-post-card :post="$post" />
                        </div>
                @endforeach
            </div>
            
        </div>
    </div>
</section>
@endsection

<style>
       .container > .row {
        align-items: start !important;
    }
    .card-header {
        background-color: var(--primary-color) !important;
        color: white;
    }
    .btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
    }
    .title-section {
        background: linear-gradient(to right, #0d47a1, #64b5f6, #00c853);
        color: white;
        text-align: center;
        padding: 20px 0;
        font-size: 2em;
        font-weight: bold;
        border-radius: 20px;
        margin-bottom: 20px;
    }

    .title-section h1 {
        margin: 0;
    }
</style>
