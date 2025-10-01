<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box py-2">
        <!-- Dark Logo-->
        <a href="{{ route('dashboard.index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="20">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard.index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="20">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
            <span class="visually-hidden">@lang('dashboard.toggle_sidebar')</span>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : ''}}" href="{{ route('dashboard.index') }}" role="button">
                        <i class="ri-home-3-fill"></i> <span>@lang('dashboard.home')</span>
                    </a>
                </li>
                
                @if (Auth::user()->hasPermissionTo('services_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.services.index' ? 'active' : ''}}" href="{{ route('dashboard.services.index') }}" role="button">
                            <i class="ri-service-line"></i> <span>@lang('dashboard.services')</span>
                        </a>
                    </li>
                @endif
                
                @if (Auth::user()->hasPermissionTo('blogs_show'))
                    <li class="nav-item">               
                        <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.blogs.index' ? 'active' : ''}}" href="{{ route('dashboard.blogs.index') }}" role="button">
                            <i class="ri-ball-pen-fill"></i> <span>@lang('dashboard.blogs')</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasPermissionTo('partners_show'))
                    <li class="nav-item">               
                        <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.partners.index' ? 'active' : ''}}" href="{{ route('dashboard.partners.index') }}" role="button">
                            <i class="ri-group-2-fill"></i> <span>@lang('dashboard.partners')</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasPermissionTo('users_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.users.index' ? 'active' : ''}}" href="{{ route('dashboard.users.index') }}" role="button">
                            <i class="ri-user-fill"></i> <span>@lang('dashboard.users')</span>
                        </a>
                    </li>
                @endif
                
                @if (Auth::user()->hasPermissionTo('roles_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.roles.index' ? 'active' : ''}}" href="{{ route('dashboard.roles.index') }}" role="button">
                            <i class="ri-key-2-fill"></i> <span>@lang('dashboard.roles')</span>
                        </a>
                    </li>
                @endif
               

                @if (Auth::user()->hasPermissionTo('contact_us_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.contact-us.index' ? 'active' : ''}}" href="{{ route('dashboard.contact-us.index') }}" role="button">
                            <i class="ri-message-2-line"></i> <span>@lang('dashboard.contact_us')</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasPermissionTo('website_settings_show'))
                    <li class="nav-item">               
                        <a class="nav-link menu-link {{ Route::currentRouteName() == 'dashboard.website_setting.index' ? 'active' : ''}}" href="{{ route('dashboard.website_setting.index') }}" role="button">
                            <i class="ri-tools-fill"></i> <span>@lang('dashboard.website_settings')</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>