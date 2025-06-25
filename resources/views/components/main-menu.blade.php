<nav class="navbar navbar-expand-lg navbar-light align-items-center" style="background-color: #ffffff;">
    <div class="container-fluid d-flex justify-content-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav mb-2 mb-lg-0">
                @foreach ($listmenu as $rowmenu)
                    <x-main-menu-item :rowmenu="$rowmenu" />
                @endforeach
            </ul>
        </div>
    </div>
</nav>


<style>
.navbar {
    border: none;
    box-shadow: none;
}

.navbar-toggler {
    margin-left: auto; /* Đẩy navbar-toggler sang phải */
}

.collapse.navbar-collapse {
    justify-content: center;
}

.navbar-nav {
    justify-content: center;
    flex-grow: 1;
}

.navbar-nav .nav-link {
    color: #000000 !important;
    font-family: "Arial", sans-serif !important;
    margin-left: 0 !important;
    padding: 0 !important;
    font-size: 20px;
}

.navbar-toggler-icon {
    color: #000000 !important;
}

</style>
