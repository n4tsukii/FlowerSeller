@php
    $currentcategory = request()->segment(3); 
@endphp

<div class="card mb-3 shadow-sm" style="border-radius: 14px; overflow: hidden;">
    <div class="card-header text-white" style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%); font-weight: 700; font-size: 1.13rem;">
        <i class="bi bi-list-ul me-2"></i>Danh Mục
    </div>
    <ul class="list-group list-group-flush" id="categoryList" style="background: #f8f9fa;">
        @foreach ($category_list as $index => $category)
            <li class="list-group-item border-0 px-3 py-2 {{ $currentcategory == $category->slug ? 'active' : '' }} category-item {{ $index >= 5 ? 'd-none' : '' }}"
                style="border-radius: 8px; margin-bottom: 2px; transition: background 0.2s;">
                <a href="{{ route('site.product.category', ['slug' => $category->slug]) }}" class="ms-1"
                    style="text-decoration: none; color: {{ $currentcategory == $category->slug ? '#fff' : '#a18cd1' }}; font-weight: 500; display: flex; align-items: center;">
                    <i class="bi bi-chevron-right me-2" style="font-size: 1rem; opacity: 0.7;"></i>
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
    <button class="btn btn-link" id="toggleCategories" style="text-decoration: none; color: #a18cd1; font-weight: 600; font-size: 1rem;">
        Show More
    </button>
</div>

<style>
    .container > .row {
        align-items: start !important;
    }
    .list-group-item.active,
    .list-group-item.active a {
        background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%) !important;
        color: #fff !important;
        font-weight: 700;
        border: none;
    }
    .list-group-item {
        border: none;
        background: transparent;
        transition: background 0.2s;
    }
    .list-group-item a {
        transition: color 0.2s, background 0.2s;
        border-radius: 6px;
    }
    .list-group-item a:hover {
        text-decoration: underline !important;
        color: #fbc2eb !important;
        background: #a18cd1 !important;
    }
    .card-header {
        border-bottom: none;
    }
    #toggleCategories {
        width: 100%;
        border-radius: 0 0 14px 14px;
        background: #fff;
        border-top: 1px solid #e0e0e0;
        margin: 0;
        padding: 10px 0 8px 0;
        transition: background 0.2s, color 0.2s;
    }
    #toggleCategories:hover {
        background: #fbc2eb;
        color: #a18cd1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleCategories');
        const categoryItems = document.querySelectorAll('.category-item');

        toggleButton.addEventListener('click', function() {
            categoryItems.forEach((item, index) => {
                if (index >= 5) {
                    item.classList.toggle('d-none');
                }
            });

            // Toggle button text
            if (toggleButton.textContent.trim() === 'Show More') {
                toggleButton.textContent = 'Show Less';
            } else {
                toggleButton.textContent = 'Show More';
            }
        });
    });
</script>
