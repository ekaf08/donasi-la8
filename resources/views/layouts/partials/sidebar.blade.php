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
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->hasRole('donatur'))
                    <li class="nav-header text-bold">MASTER</li>
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}"
                            class="nav-link {{ request()->is('category*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cube"></i>
                            <p>
                                Kategori
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('campaign.index') }}"
                            class="nav-link {{ request()->is('campaign*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                Projek
                            </p>
                        </a>
                    </li>

                    <li class="nav-header text-bold">REFERENSI</li>
                    <li class="nav-item">
                        <a href="pages/widgets.html" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Donatur
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-donate"></i>
                            <p>
                                Daftar Donasi
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-header text-bold">INFORMASI</li>
                    <li class="nav-item">
                        <a href="pages/widgets.html" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Kontak Masuk
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Subscriber
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->hasRole('donatur'))
                    <li class="nav-header text-bold">REPORT</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Laporan
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('donatur'))
                    <li class="nav-header text-bold">AKTIVITAS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Log Aktivitas
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-header text-bold">PENGATURAN</li>
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                @endif
                {{-- @if (auth()->user()->hasRole('admin') ||
    auth()->user()->hasRole('donatur'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-edit"></i>
                            <p>
                                Profil
                            </p>
                        </a>
                    </li>
                @endif --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
