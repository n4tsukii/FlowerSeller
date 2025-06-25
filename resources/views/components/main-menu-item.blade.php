@if ($listmenu->isEmpty())
    <li class="nav-item">
        <a class="nav-link px-4 py-2" href="{{ url($menu_item->link) }}" style="color: #fff; font-weight: 600; font-size: 1.1rem; border-radius: 8px; transition: background 0.3s, color 0.3s;">
            {{ $menu_item->name }}
        </a>
    </li>
@else
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle px-4 py-2" href="{{ url($menu_item->link) }}" id="navbarDropdown{{ $menu_item->id }}" role="button" aria-expanded="false" style="color: #fff; font-weight: 600; font-size: 1.1rem; border-radius: 8px; transition: background 0.3s, color 0.3s;">
            {{ $menu_item->name }}
        </a>
        <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown{{ $menu_item->id }}" style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%); border: none; border-radius: 10px; min-width: 180px;">
            @foreach ($listmenu as $item)
                <li>
                    <a class="dropdown-item py-2" href="{{ url($item->link) }}" style="color: #333; font-weight: 500; border-radius: 6px; transition: background 0.2s, color 0.2s;">
                        {{ $item->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif

<style>
    .nav-link,
    .dropdown-toggle {
        position: relative;
        transition: background 0.3s, color 0.3s;
    }
    .nav-link:hover,
    .dropdown-toggle:hover,
    .dropdown-menu .dropdown-item:hover {
        background: #fff !important;
        color: #a18cd1 !important;
    }
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 90%;
        left: 0;
        z-index: 1000;
        float: left;
        min-width: 10rem;
        padding: .5rem 0;
        margin: .125rem 0 0;
        font-size: 1rem;
        text-align: left;
        list-style: none;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(161,140,209,0.15);
    }
    .dropdown:hover .dropdown-menu,
    .nav-item.dropdown:focus-within .dropdown-menu {
        display: block;
    }
    .dropdown-item {
        color: #333 !important;
        font-family: "Arial", sans-serif !important;
        font-weight: 500;
        border-radius: 6px;
        margin: 2px 8px;
        padding-left: 18px !important;
        padding-right: 18px !important;
    }
    .dropdown-item:hover {
        background: #fff !important;
        color: #a18cd1 !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdowns = document.querySelectorAll('.nav-item.dropdown');

        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('mouseover', function() {
                var dropdownMenu = dropdown.querySelector('.dropdown-menu');
                dropdownMenu.classList.add('show');
            });

            dropdown.addEventListener('mouseout', function() {
                var dropdownMenu = dropdown.querySelector('.dropdown-menu');
                dropdownMenu.classList.remove('show');
            });
        });
    });
</script>
