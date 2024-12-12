<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo">
            <img src="{{env("APP_URL")}}/admin/images/logos/logo.svg" alt="logo" class="desktop-logo">
            <img src="{{env("APP_URL")}}/admin/images/logos/logo.svg" alt="logo" class="toggle-dark">
            <img src="{{env("APP_URL")}}/admin/images/logos/logo.svg" alt="logo" class="desktop-dark">
            <img src="{{env("APP_URL")}}/admin/images/logos/logo.svg" alt="logo" class="toggle-logo">
            <img src="{{env("APP_URL")}}/admin/images/logos/logo.svg" alt="logo" class="toggle-white">
            <img src="{{env("APP_URL")}}/admin/images/logos/logo.svg" alt="logo" class="desktop-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">@lang('admin/components.panel_sidebar_title')</span></li>
                <!-- End::slide__category -->

                @foreach(config('modules') as $menu)
                    @if($menu["status"])
                        @if(count($menu["subs"] ?? []) > 0)
                            <li class="slide has-sub @if($menu["subs"][$module->type]["name"] ?? false) open @endif ">
                                <a href="javascript:void(0);" class="side-menu__item @if($menu["subs"][$module->type]["name"] ?? false) active @endif" title="@lang($menu["title"])">
                                    @include($menu["icon"])
                                    <span class="side-menu__label">@lang($menu["title"])</span>
                                    <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1 pages-ul">

                                    @foreach($menu["subs"] as $child)
                                        @if($child["status"])
                                            <li class="slide">
                                                <a href="{{route("admin.".$child["name"].".index")}}" class="side-menu__item @if($child["name"] == $module->type) active @endif " title="@lang($child["title"])">@lang($child["title"])</a>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                            </li>
                        @else
                            <li class="slide">
                                <a href="{{route("admin.".$menu["name"].".index")}}" class="side-menu__item @if($module->type == $menu["name"]) active @endif" title="@lang($menu["title"])">
                                    @include($menu["icon"])
                                    <span class="side-menu__label">@lang($menu["title"])</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
