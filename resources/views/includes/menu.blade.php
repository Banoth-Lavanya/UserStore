<nav>
    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <ul class="menu">
    @if (!session('user_id'))
        <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a></li>
        <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
        @else
            <li><a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">Profile</a></li>
            <li><a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">Edit Profile</a></li>
            <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">Products</a></li>
            @if (Auth::user()->role === 'admin') <!-- Check if the user is admin -->
                <li><a href="{{ route('admin.customers') }}" class="{{ request()->routeIs('admin.customers') ? 'active' : '' }}">Customers</a></li>
              
                <li><a href="{{ route('products.manage') }}" class="{{ request()->routeIs('products.manage') ? 'active' : '' }}">Manage Products</a></li>
            @endif
            <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="logout-btn btn-danger">Logout</button>
        </form>
            </li>
            @endif
    </ul>
</nav>
