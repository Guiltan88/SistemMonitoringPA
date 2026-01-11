<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">

        {{-- HEADER --}}
        <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('admin.dashboard') }}" class="fw-bold">
                        Monitoring PA
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>


        </div>

        {{-- MENU --}}
        <div class="sidebar-menu">
            <ul class="menu">

                {{-- DASHBOARD --}}
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="bi bi-house-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- ================= ADMIN ================= --}}
                @if(auth()->check() && auth()->user()->hasRole('admin'))

                <li class="sidebar-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.projects.index') }}" class="sidebar-link">
                        <i class="bi bi-folder-fill"></i>
                        <span>Project Management</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.staff.index') }}" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Staff Management</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Mahasiswa Management</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports.index') }}" class="sidebar-link">
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Reports</span>
                    </a>
                </li>
                @endif

                {{-- ================= STAFF ================= --}}
                @role('staff')
                <li class="sidebar-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.projects.index') }}" class="sidebar-link d-flex align-items-center">
                        <i class="bi bi-folder-fill"></i>
                        <span>My Projects</span>

                        @php
                            $staff = auth()->user()->staff;
                            $myProjectsCount = $staff ? \App\Models\Project::where('assigned_staff_id', $staff->id)->count() : 0;
                        @endphp

                        @if($myProjectsCount > 0)
                            <span class="badge bg-primary ms-auto">
                                {{ $myProjectsCount }}
                            </span>
                        @endif
                    </a>
                </li>


                @endrole

                {{-- ================= STAFF MAHASISWA ================= --}}
                @role('staff')
                <li class="sidebar-item {{ request()->routeIs('admin.staff.mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.staff.mahasiswa.index') }}" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                @endrole

                {{-- ================= MAHASISWA ================= --}}
                @if(auth()->check() && auth()->user()->hasRole('mahasiswa'))
                    @php
                        // Ensure mahasiswa role exists
                        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'mahasiswa']);
                    @endphp

                    <li class="sidebar-title">
                        <i class="bx bx-graduation"></i> Mahasiswa
                    </li>
                @endif
                @if(auth()->check() && auth()->user()->hasRole('mahasiswa'))
                <li class="sidebar-item {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('mahasiswa.index') }}" class="sidebar-link">
                        <i class="bi bi-book-fill"></i>
                        <span>My Projects</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('mahasiswa.create') }}" class="sidebar-link">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Submit New Project</span>
                    </a>
                </li>
                @endif

                {{-- PROFILE --}}
                <li class="sidebar-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <a href="{{ route('profile.show') }}" class="sidebar-link">
                        <i class="bi bi-person-circle"></i>
                        <span>My Profile</span>
                    </a>
                </li>

                {{-- LOGOUT --}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>

    </div>
</div>
