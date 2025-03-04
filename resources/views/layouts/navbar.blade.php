<nav class="container-fluid nav-custom d-flex justify-content-between align-items-center shadow sticky-top gap-3 py-2 px-3">
    <!-- Sidebar Toggle Button -->
    <button onclick="sidebartoggle()" class="sidebar-toggle bg-transparent p-2 border-0">
        <i class="fa-solid fa-bars-staggered fa-lg"></i>
    </button>
    {{-- <button onclick="changeLayout()">Ganti Layout</button> --}}
    <!-- User Dropdown -->
    <div class="dropdown">
        <button class="dropdown-toggle bg-transparent border-0 text-dark gap-1"
            data-bs-toggle="dropdown">
            <i class="fa-regular fa-user"></i> {{ ucfirst(Auth::user()->name) }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow rounded-2">
            <li>
                <a href="{{route('profile.index')}}" class="dropdown-item">Profil Saya</a>
            </li>
            <hr>
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="dropdown-item d-flex justify-content-between text-danger align-items-center" type="submit">
                        Logout <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
