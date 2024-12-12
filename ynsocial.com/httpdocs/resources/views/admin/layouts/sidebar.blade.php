<nav id="sidebar" class="bg-dark text-white">
    <div class="sidebar-header">
        <h3>YN Social Admin</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <a href="#pageSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.pages.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="fas fa-file-alt"></i> Pages
            </a>
            <ul class="collapse {{ request()->routeIs('admin.pages.*') ? 'show' : '' }}" id="pageSubmenu">
                <li>
                    <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.index') ? 'active' : '' }}">
                        All Pages
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.create') }}" class="{{ request()->routeIs('admin.pages.create') ? 'active' : '' }}">
                        Add New
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
            <a href="#portfolioSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.portfolio.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="fas fa-briefcase"></i> Portfolio
            </a>
            <ul class="collapse {{ request()->routeIs('admin.portfolio.*') ? 'show' : '' }}" id="portfolioSubmenu">
                <li>
                    <a href="{{ route('admin.portfolio.index') }}" class="{{ request()->routeIs('admin.portfolio.index') ? 'active' : '' }}">
                        All Items
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.portfolio.create') }}" class="{{ request()->routeIs('admin.portfolio.create') ? 'active' : '' }}">
                        Add New
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.portfolio.categories') }}" class="{{ request()->routeIs('admin.portfolio.categories') ? 'active' : '' }}">
                        Categories
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
            <a href="#blogSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.blog.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="fas fa-blog"></i> Blog
            </a>
            <ul class="collapse {{ request()->routeIs('admin.blog.*') ? 'show' : '' }}" id="blogSubmenu">
                <li>
                    <a href="{{ route('admin.blog.index') }}" class="{{ request()->routeIs('admin.blog.index') ? 'active' : '' }}">
                        All Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.blog.create') }}" class="{{ request()->routeIs('admin.blog.create') ? 'active' : '' }}">
                        Add New
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.blog.categories') }}" class="{{ request()->routeIs('admin.blog.categories') ? 'active' : '' }}">
                        Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.blog.tags') }}" class="{{ request()->routeIs('admin.blog.tags') ? 'active' : '' }}">
                        Tags
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.theme.*') ? 'active' : '' }}">
            <a href="#themeSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.theme.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                <i class="fas fa-paint-brush"></i> Theme
            </a>
            <ul class="collapse {{ request()->routeIs('admin.theme.*') ? 'show' : '' }}" id="themeSubmenu">
                <li>
                    <a href="{{ route('admin.theme.settings') }}" class="{{ request()->routeIs('admin.theme.settings') ? 'active' : '' }}">
                        Settings
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.theme.customize') }}" class="{{ request()->routeIs('admin.theme.customize') ? 'active' : '' }}">
                        Customize
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}">
                <i class="fas fa-cog"></i> Settings
            </a>
        </li>
    </ul>
</nav>

<style>
#sidebar {
    min-width: 250px;
    max-width: 250px;
    min-height: 100vh;
    position: fixed;
    left: 0;
    padding: 20px 0;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #343a40;
}

#sidebar ul.components {
    padding: 20px 0;
}

#sidebar ul li a {
    padding: 10px 20px;
    font-size: 1.1em;
    display: block;
    color: #fff;
    text-decoration: none;
}

#sidebar ul li a:hover {
    background: #495057;
}

#sidebar ul li.active > a {
    background: #0d6efd;
}

#sidebar ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
}

.wrapper {
    display: flex;
    width: 100%;
}

.main-content {
    width: calc(100% - 250px);
    margin-left: 250px;
    min-height: 100vh;
}

.content {
    padding: 20px;
}

/* Icons */
#sidebar ul li a i {
    margin-right: 10px;
}

/* Submenu animation */
.collapse {
    transition: all 0.3s ease;
}

/* Active state for submenu items */
#sidebar ul ul a.active {
    background: rgba(13, 110, 253, 0.2);
    color: #fff;
}

/* Hover effect for submenu items */
#sidebar ul ul a:hover {
    background: rgba(13, 110, 253, 0.1);
}

/* Dropdown arrow */
.dropdown-toggle::after {
    float: right;
    margin-top: 8px;
}

/* Submenu indentation */
#sidebar ul ul {
    background: rgba(0, 0, 0, 0.2);
}
</style> 