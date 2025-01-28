<nav>
    <!-- Logo and Branding -->
    <div class="logo-name">
        <div class="logo-image">
            <img src="{{ asset('backend/images/logo.png') }}" alt="Logo">
        </div>
        <span class="logo_name">CodingLab</span>
    </div>

    <!-- Navigation Menu -->
    <div class="menu-items">
        <ul class="nav-links">
            <!-- Navigation links can be added here -->
        </ul>

        <!-- Logout and Reset Password Section -->
        <ul class="logout-mode">
            <li>
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info d-flex align-items-center">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        <span class="link-name">Logout</span>
                    </button>
                </form>

                <!-- Reset Password Button -->
                <form action="{{ route('resetPassword') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-danger d-flex align-items-center mt-2">
                        <i class="fas fa-key me-2"></i>
                        <span class="link-name">Change Password</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
