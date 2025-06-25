@extends('layouts.site')
@section('title','Home')
@section('content')

<div class="slider-container">
    <x-slider/>
</div>

<x-product-new />

<x-flash-sale/>  
<x-latest-post/>
<x-product-category-home/>
@endsection