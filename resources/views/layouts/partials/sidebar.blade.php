<aside class="main-sidebar elevation-4 sidebar-light-navy">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-navy">
        <img src="{{ asset('/AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">EmbohWes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile.show') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- @dd($role->menu) --}}
                @foreach ($role->menu as $menu)
                    @if (count($menu->sub_menu))
                        <li class="nav-header text-bold text-uppercase">{{ $menu->menu_detail->nama_menu }}</li>
                        @foreach ($menu->sub_menu as $sub_menu)
                            <li class="nav-item">
                                <a href="{{ route($sub_menu->sub_menu_detail?->go_to) }}"
                                    class="nav-link {{ request()->is($sub_menu->sub_menu_detail?->active) ? 'active' : '' }}">
                                    <i class="{{ $sub_menu->sub_menu_detail?->icon }}"></i>
                                    <p>
                                        {{-- @dd($sub_menu->sub_menu_detail?->nama_sub_menu) --}}
                                        {{ $sub_menu->sub_menu_detail?->nama_sub_menu }}
                                    </p>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="nav-item">
                            <a href="{{ route($menu->menu_detail->go_to) }}"
                                class="nav-link {{ request()->is($menu->menu_detail->active) ? 'active' : '' }}">
                                <i class="{{ $menu->menu_detail->icon }}"></i>
                                <p>
                                    {{ $menu->menu_detail->nama_menu }}
                                </p>
                            </a>
                        </li>
                    @endif
                @endforeach

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
