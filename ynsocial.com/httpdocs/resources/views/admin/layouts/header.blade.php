<header class="navbar navbar-expand-lg navbar-light bg-white py-2">
    <div class="container-fluid">
        <button type="button" class="btn btn-link text-dark d-lg-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <a class="navbar-brand d-none d-lg-block" href="{{ route('admin.dashboard.index') }}">
            YN Social Admin
        </a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" 
                         alt="{{ Auth::user()->name }}" 
                         class="rounded-circle me-2"
                         width="32"
                         height="32">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-cog fa-fw me-2"></i>
                            Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<style>
.navbar {
    border-bottom: 1px solid #e9ecef;
}

.navbar-brand {
    font-weight: 600;
    color: #212529;
}

.nav-link {
    color: #6c757d;
}

.nav-link:hover {
    color: #0d6efd;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.dropdown-item {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.dropdown-item i {
    width: 1rem;
    text-align: center;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.dropdown-item.text-danger:hover {
    background-color: #dc3545;
    color: #fff !important;
}

#sidebarToggle {
    padding: 0.25rem;
    font-size: 1.25rem;
}

#sidebarToggle:hover {
    color: #0d6efd;
}

@media (max-width: 991.98px) {
    .navbar-brand {
        margin-right: auto;
    }
}
</style>

<script>
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.body.classList.toggle('sidebar-collapsed');
    const mainContent = document.querySelector('.main-content');
    if (mainContent) {
        mainContent.style.marginLeft = document.body.classList.contains('sidebar-collapsed') ? '0' : '250px';
    }
});
</script> 