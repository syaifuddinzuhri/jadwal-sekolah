        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('dashboard.index') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" width="40">
                </div>
                <div class="sidebar-brand-text ml-1">SMAN 1 Turen Malang</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li
                class="nav-item {{ Request::is('jurusan') || Request::is('jurusan/*') || Request::is('kelas') || Request::is('kelas/*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelas"
                    aria-expanded="true" aria-controls="collapseKelas">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Data Kelas</span>
                </a>
                <div id="collapseKelas"
                    class="collapse {{ $agent == false && (Request::is('jurusan') || Request::is('jurusan/*') || Request::is('kelas') || Request::is('kelas/*')) ? 'show' : '' }}"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('jurusan') || Request::is('jurusan/*') ? 'active' : '' }}"
                            href="{{ route('jurusan.index') }}">Jurusan</a>
                        <a class="collapse-item {{ Request::is('kelas') || Request::is('kelas/*') ? 'active' : '' }}"
                            href="{{ route('kelas.index') }}">Kelas</a>
                    </div>
                </div>
            </li>
            <li
                class="nav-item {{ Request::is('tahun-akademik') || Request::is('tahun-akademik/*') || Request::is('mapel') || Request::is('mapel/*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkademik"
                    aria-expanded="true" aria-controls="collapseAkademik">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Data Akademik</span>
                </a>
                <div id="collapseAkademik"
                    class="collapse {{ $agent == false && (Request::is('tahun-akademik') || Request::is('tahun-akademik/*') || Request::is('mapel') || Request::is('mapel/*')) ? 'show' : '' }}"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('tahun-akademik') || Request::is('tahun-akademik/*') ? 'active' : '' }}"
                            href="{{ route('tahun-akademik.index') }}">Tahun Akademik</a>
                        <a class="collapse-item {{ Request::is('mapel') || Request::is('mapel/*') ? 'active' : '' }}"
                            href="{{ route('mapel.index') }}">Mata Pelajaran</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::is('guru') || Request::is('guru/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru.index') }}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Data Guru</span></a>
            </li>
            {{-- <li class="nav-item {{ Request::is('siswa') || Request::is('siswa/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('siswa.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Siswa</span></a>
            </li> --}}
            <li class="nav-item {{ Request::is('jadwal') || Request::is('jadwal/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('jadwal.index') }}">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Jadwal pelajaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
