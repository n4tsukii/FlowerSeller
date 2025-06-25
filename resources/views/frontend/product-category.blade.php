@extends('layouts.site')
@section('title', 'Product')
@section('content')
<section class="container mt-4">
    <div class="title-section">
        <h1>Danh muc: {{ $row->name }}</h1>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-8">
                <button class="btn btn-primary" id="toggleGridView">Grid View</button>
                <button class="btn btn-secondary" id="toggleListView">List View</button>
            </div>
            <div class="col-md-4 text-end">
                <form action="{{ route('site.product.category', ['slug' => $row->slug]) }}" method="GET" id="sortForm">
                    @csrf
                    <div class="mydict mb-4">
                        <div class="form-group">
                            <select class="form-control" id="sort" name="sort" onchange="document.getElementById('sortForm').submit();">
                                {!! $htmlSortOptions !!}
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="col-md-3">
            <x-product-category-name />
            <x-product-brand />
        </div>
        <!-- Main content -->
        <div class="col-md-9">
            <!-- Grid View Section -->
            <div class="row product-container grid-view" id="gridViewSection">
                @foreach ($product_list as $product)
                    <div class="col-md-4 mb-4 product-item">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            <!-- List View Section -->
            <div class="row product-container list-view" id="listViewSection" style="display: none;">
                @foreach ($product_list as $product)
                    <div class="col-12 mb-4 product-item list-item">
                        <div class="list-item-content">
                            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="list-avatar">
                            <div class="list-info">
                                <h3 class="list-name">{{ $product->name }}</h3>
                                <p class="list-description">{{ $product->description }}</p>
                                <div class="row">
                                    @if ($product->pricesale > 0 && $product->pricesale < $product->price)
                                        <div class="col-8">
                                            <span class="text-success">{{ number_format($product->pricesale) }}₫</span>
                                            <del class="text-muted">{{ number_format($product->price) }}₫</del>
                                        </div>
                                        <div class="col-4 text-danger">
                                            -{{ number_format((($product->price - $product->pricesale) / $product->price) * 100) }}%
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <span class="text-success">{{ number_format($product->price) }}₫</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $product_list->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .card-header {
        background-color: var(--primary-color) !important;
        color: white;
    }
    .btn-success {
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

    .grid-view .product-item {
        display: flex;
        flex-direction: column;
    }

    .list-view .product-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .list-item-content {
        display: flex;
        align-items: center;
        width: 100%;
        height: 150px !important;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .list-avatar {
        width: 150px;
        height: 150px;
        margin-right: 15px;
    }

    .list-info {
        flex-grow: 1;
    }

    .list-name {
        margin: 0;
        font-size: 1.2em;
    }

    .list-description {
        margin: 0;
        color: #777;
    }

    .action-icon {
        color: #007bff;
    }

    .action-icon:hover {
        color: #0056b3;
    }

    .btn {
        margin-top: auto;
    }

    a {
        text-decoration: none !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const gridViewBtn = document.getElementById('toggleGridView');
        const listViewBtn = document.getElementById('toggleListView');
        const gridViewSection = document.getElementById('gridViewSection');
        const listViewSection = document.getElementById('listViewSection');

        // Set initial view mode from localStorage
        const initialView = localStorage.getItem('viewMode') || 'grid';
        if (initialView === 'list') {
            gridViewSection.style.display = 'none';
            listViewSection.style.display = 'flex';
        } else {
            gridViewSection.style.display = 'flex';
            listViewSection.style.display = 'none';
        }

        gridViewBtn.addEventListener('click', function() {
            console.log('Grid View button clicked');
            gridViewSection.style.display = 'flex';
            listViewSection.style.display = 'none';
            localStorage.setItem('viewMode', 'grid');
        });

        listViewBtn.addEventListener('click', function() {
            console.log('List View button clicked');
            gridViewSection.style.display = 'none';
            listViewSection.style.display = 'flex';
            localStorage.setItem('viewMode', 'list');
        });
    });
</script>
