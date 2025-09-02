<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar vh-100">
    <div class="position-sticky pt-3 text-white d-flex flex-column h-100">

        <!-- Brand -->
        <div class="px-3 mb-3">
            <h4 class="d-flex align-items-center mb-0">
                <i class="bi bi-hospital me-2"></i>
                RS App
            </h4>
        </div>
        <hr class="text-secondary">

        <!-- Menu -->
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link text-white active" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-2"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('hospitals.index') }}">
                    <i class="bi bi-hospital me-2"></i> Rumah Sakit
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('patients.index') }}">
                    <i class="bi bi-people me-2"></i> Pasien
                </a>
            </li>
        </ul>

        <hr class="text-secondary mt-auto">

        <!-- User Profile / Logout -->
        <div class="dropdown px-3 mb-3">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <strong>{{ auth()->user()->username }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark shadow">
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
