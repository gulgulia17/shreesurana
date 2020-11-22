<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/home" class="brand-link">
        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="{{ config('app.name') }} Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('home') ? 'active' : null }}" href="{{ route('home') }}">
                        <i class="far fa-fw fa-circle nav-icon"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @can('profile.index')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('profile.index') ? 'active' : null }}"
                        href="{{ route('profile.index') }}">
                        <i class="fa fa-user-circle nav-icon"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                @endcan
                @can('files.index')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('files.index') ? 'active' : null }}"
                        href="{{ route('files.index') }}">
                        <i class="far fa-fw fa-circle nav-icon"></i>
                        <p>
                            Files
                        </p>
                    </a>
                </li>
                @endcan

                @can('leads.index')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('leads.index') ? 'active' : null }}"
                        href="{{ route('leads.index') }}">
                        <i class="far fa-fw fa-circle nav-icon"></i>
                        <p>
                            Leads
                        </p>
                    </a>
                </li>
                @endcan

                @if (Route::is('leads.pending'))
                
                @can('leads.pending')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('leads.pending') ? 'active' : null }}"
                        href="{{ route('leads.pending') }}">
                        <i class="far fa-fw fa-circle nav-icon"></i>
                        <p>
                            Leads Pending
                        </p>
                    </a>
                </li>
                @endcan

                @endif
                @can('permission.index', 'role.index', 'user.index')
                    <li class="nav-header text-uppercase">
                        Settings
                    </li>
                    @can('permission.index')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('permission.index') ? 'active' : null }}"
                                href="{{ route('permission.index') }}">
                                <i class="far fa-fw fa-circle nav-icon"></i>
                                <p>
                                    Permissions
                                </p>
                            </a>
                        </li>
                    @endcan

                    @can('role.index')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('role.index') ? 'active' : null }}"
                                href="{{ route('role.index') }}">
                                <i class="far fa-fw fa-circle nav-icon"></i>
                                <p>
                                    All Roles
                                </p>
                            </a>
                        </li>
                    @endcan

                @endcan
                @can('user.index')
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('user.index') ? 'active' : null }}"
                            href="{{ route('user.index') }}">
                            <i class="far fa-fw fa-circle nav-icon"></i>
                            <p>
                                All User
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>
