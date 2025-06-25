<div class="footer-menu">
    <ul>
        @foreach ($listmenu as $menu)
            <li>
                <a href="{{ url($menu->link) }}">{{ $menu->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
<style>
    .footer-menu ul {
        list-style: none;
        padding: 0;
    }
    .footer-menu li {
        margin: 5px 0;
    }
    .footer-menu a {
        text-decoration: none !important;
        color: inherit; /* Ensure links inherit color from their parent */
    }
</style>
