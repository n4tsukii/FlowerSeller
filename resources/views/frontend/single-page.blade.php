@extends('layouts.site')
@section('title', $page->title)
@section('content')
<section class="container mt-4">
    <div class="title-section">
        <h1>{{ $page->title }}</h1>
    </div>
    <div class="content-section">

        <div class="policy-detail">
            {!! $page->detail !!}
        </div>
        <p>{{ $page->description }}</p>
    </div>
</section>
@endsection

<style>
    .title-section {
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,121,67,1) 35%, rgba(0,212,255,1) 100%);
      
        text-align: center;
        padding: 20px 0;
        font-size: 2.5em;
        font-weight: bold;
        border-radius: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .title-section h1 {
        margin: 0;
        color: white !important;
    }

    .content-section {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        line-height: 1.6em;
  
    }

    .content-section p {
  
        font-size: 1.2em;
    }

    .policy-detail {
        margin-bottom: 20px;
        font-size: 1.1em;
        color: #333;
    }
</style>
