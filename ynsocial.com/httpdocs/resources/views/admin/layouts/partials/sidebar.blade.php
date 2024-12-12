<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="{{ route('admin.dashboard.index') }}">
            <img alt="Logo" src="{{ asset('admin/media/logos/logo-1-dark.svg') }}" class="h-25px logo" />
        </a>
    </div>
    
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="kt_aside_menu">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                        <span class="menu-icon"><i class="bi bi-grid fs-3"></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.portfolio-categories.*') ? 'active' : '' }}" href="{{ route('admin.portfolio-categories.index') }}">
                        <span class="menu-icon"><i class="bi bi-folder fs-3"></i></span>
                        <span class="menu-title">Portfolio Categories</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 