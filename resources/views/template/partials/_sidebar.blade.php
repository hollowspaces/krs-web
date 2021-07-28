<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="gambar/logo.png"  width="100px">
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">EK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('/') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-fire"></i>
                <span>Dashboard</span></a></li>
            <li class="menu-header">Menu</li>
            @if(auth()->user()->role == 'admin')
                <li class="{{ request()->is('mahasiswa') || request()->is('mahasiswa/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('mahasiswa.index') }}"><i class="fas fa-users"></i>
                    <span>Mahasiswa</span></a></li>
                <li class="{{ request()->is('kelas') || request()->is('kelas/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('kelas.index') }}"><i class="fas fa-th-large"></i>
                    <span>Kelas</span></a></li>
            @endif
            <li class="{{ request()->is('mata-kuliah') || request()->is('mata-kuliah/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('mata-kuliah.index') }}"><i class="fas fa-th-list"></i>
                <span>Mata Kuliah</span></a></li>
            <li class="{{ request()->is('krs') || request()->is('krs/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('krs.index') }}"><i class="fas fa-file"></i>
                <span>KRS</span></a></li>
        </ul>
    </aside>
</div>