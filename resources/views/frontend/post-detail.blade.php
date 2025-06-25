@extends('layouts.site')
@section('title', 'Chi tiết bài viết')
@section('content')
<div class="container my-3">
    <div class="row">
        <div class="col-md-8">
            <img class="img-fluid w-100" src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->image }}" style = "width: 250px;height:400px">
        </div>
        <div class="col-md-4">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <h3>Nội dung chi tiết</h3>
            {!! $post->content !!}
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col-12">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-related-tab" data-bs-toggle="tab" data-bs-target="#nav-related" type="button" role="tab" aria-controls="nav-related" aria-selected="true">Bài viết liên quan</button>
                <button class="nav-link" id="nav-comments-tab" data-bs-toggle="tab" data-bs-target="#nav-comments" type="button" role="tab" aria-controls="nav-comments" aria-selected="false">Bình luận</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-related" role="tabpanel" aria-labelledby="nav-related-tab">
                <div class="section_post_related my-5">
                    <div class="row">
                        @foreach ($related_posts as $post)
                            <div class="col-md-3 mb-4">
                            <div class="card" style="width:250px;height:110px;overflow:hidden;">
                             
                                <div class="card-body" style="height:230px;overflow:hidden;">
                                <h4 class="card-title" style="height:20px;overflow:hidden;"><a href="{{route('site.post.detail',['slug'=>$post->slug])}}">{{ $post->title }}</a></h4>
                                    <p class="card-text" style="height:180px;overflow:hidden;text-align: justify;">{{ $post->description }}</p>
                                </div>
                            </div>                           
                         </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
                <!-- Embed Facebook comments plugin or another comments system here -->
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

<style>
    .nav-tabs .nav-link {
        color: var(--primary-color);
    }
    .nav-tabs .nav-link.active {
        background-color: var(--primary-color);
        color: white;
    }
</style>
