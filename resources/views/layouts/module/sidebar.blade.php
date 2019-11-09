
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: url({{ asset('img/navbar/gambar-background-kayu-hd.jpg') }})">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-chair"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if ($title == 'Dashboard')
            <li class="nav-item active">
            @else
            <li class="nav-item">
            @endif
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Profil Collapse Menu -->
            @if ($title == 'Profil')
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kostum Profil:</h6>
                        @if ($subtitle == 'Profil Saya')
                        <a class="collapse-item active" href="{{ route('my-profile') }}">Profil Saya</a>
                        <a class="collapse-item" href="{{ route('edit-profile') }}">Ubah Profil</a>
                        <a class="collapse-item" href="{{ route('edit-password') }}">Ganti Password</a>
                        @elseif($subtitle == 'Ubah Profil')
                        <a class="collapse-item" href="{{ route('my-profile') }}">Profil Saya</a>
                        <a class="collapse-item active" href="{{ route('edit-profile') }}">Ubah Profil</a>
                        <a class="collapse-item" href="{{ route('edit-password') }}">Ganti Password</a>
                        @elseif($subtitle == 'Ganti Password')
                        <a class="collapse-item" href="{{ route('my-profile') }}">Profil Saya</a>
                        <a class="collapse-item" href="{{ route('edit-profile') }}">Ubah Profil</a>
                        <a class="collapse-item active" href="{{ route('edit-password') }}">Ganti Password</a>
                        @endif
                    </div>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i><span>Profil</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kostum Profil:</h6>
                        <a class="collapse-item" href="{{ route('my-profile') }}">Profil Saya</a>
                        <a class="collapse-item" href="{{ route('edit-profile') }}">Ubah Profil</a>
                        <a class="collapse-item" href="{{ route('edit-password') }}">Ganti Password</a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Nav Item - Utilities Collapse Menu -->
            @if ($title == 'Utilitas')
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i><span>Utilitas</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kostum Utilitas:</h6>
                        @if ($subtitle == "Perusahaan")
                        <a class="collapse-item active" href="{{ route('company') }}">Perusahaan</a>
                        <a class="collapse-item" href="{{ route('home-picture') }}">Slideshow</a>
                        <a class="collapse-item" href="{{ route('testimonials.index') }}">Testimonial</a>
                        @elseif($subtitle == "Slideshow")
                        <a class="collapse-item" href="{{ route('company') }}">Perusahaan</a>
                        <a class="collapse-item active" href="{{ route('home-picture') }}">Slideshow</a>
                        <a class="collapse-item" href="{{ route('testimonials.index') }}">Testimonial</a>
                        @elseif($subtitle == "Testimonial")
                        <a class="collapse-item" href="{{ route('company') }}">Perusahaan</a>
                        <a class="collapse-item" href="{{ route('home-picture') }}">Slideshow</a>
                        <a class="collapse-item active" href="{{ route('testimonials.index') }}">Testimonial</a>
                        @endif
                    </div>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i><span>Utilitas</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kostum Utilitas:</h6>
                        <a class="collapse-item" href="{{ route('company') }}">Perusahaan</a>
                        <a class="collapse-item" href="{{ route('home-picture') }}">Slideshow</a>
                        <a class="collapse-item" href="{{ route('testimonials.index') }}">Testimonial</a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Nav Item - Business Collapse Menu -->
            @if ($title == 'Bisnis')
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
                    <i class="fas fa-fw fa-business-time"></i>
                    <span>Bisnis</span>
                </a>
                <div id="collapseProduct" class="collapse show" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kostum Bisnis:</h6>
                        @if ($subtitle == 'Produk')
                        <a class="collapse-item active" href="{{ route('products.index') }}">Produk</a>
                        <a class="collapse-item" href="{{ route('categories.index') }}">Kategori</a>
                        @elseif($subtitle == 'Kategori')
                        <a class="collapse-item" href="{{ route('products.index') }}">Produk</a>
                        <a class="collapse-item active" href="{{ route('categories.index') }}">Kategori</a>
                        @endif
                    </div>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
                    <i class="fas fa-fw fa-business-time"></i>
                    <span>Bisnis</span>
                </a>
                <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kostum Bisnis:</h6>
                        <a class="collapse-item" href="{{ route('products.index') }}">Produk</a>
                        <a class="collapse-item" href="{{ route('categories.index') }}">Kategori</a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
