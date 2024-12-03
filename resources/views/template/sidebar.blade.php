<div class="sidebar-wrapper">
    <nav class="mt-2"> <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item"> <a href="/dashboard"
                    class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}"> <i
                        class="nav-icon bi bi-speedometer"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-header">MASTER DATA</li>
            <li class="nav-item"> <a href="/speedboat"
                    class="nav-link {{ Request::segment(1) == 'speedboat' ? 'active' : '' }}"> <i
                        class="nav-icon bi bi-pci-card"></i>
                    <p>Speedboat</p>
                </a> </li>
            <li class="nav-item"> <a href="/jadwal"
                    class="nav-link {{ Request::segment(1) == 'jadwal' ? 'active' : '' }}"> <i
                        class="nav-icon bi bi-clock-fill"></i>
                    <p>Jadwal</p>
                </a> </li>
            <li class="nav-item"> <a href="/pemesanan"
                    class="nav-link {{ Request::segment(1) == 'pemesanan' ? 'active' : '' }}"> <i
                        class="nav-icon bi bi-archive-fill"></i>
                    <p>Pemesanan</p>
                </a> </li>
            <li class="nav-header">PENGGUNA</li>
            <li class="nav-item"> <a href="/pemilik"
                    class="nav-link {{ Request::segment(1) == 'pemilik' ? 'active' : '' }}"> <i
                        class="nav-icon bi bi-person-fill"></i>
                    <p>Pemilik</p>
                </a> </li>
            <li class="nav-item"> <a href="/penumpang"
                    class="nav-link {{ Request::segment(1) == 'penumpang' ? 'active' : '' }}"> <i
                        class="nav-icon bi bi-person"></i>
                    <p>Penumpang</p>
                </a> </li>
            <li class="nav-header">PENGATURAN</li>

            <li class="nav-item"> <a href="{{ route('logout') }}"
                    class="nav-link {{ Request::segment(1) == 'keluar' ? 'active' : '' }}"> <i
                        class="nav-icon bi bi-box-arrow-right"></i>
                    <p>Keluar</p>
                </a> </li>

        </ul>
    </nav>
</div>
