@php
    $routeActive = Route::currentRouteName();
@endphp

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i class="fas fa-users text-warning"></i>
        <span class="nav-link-text">Users</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'products.index' ? 'active' : '' }}" href="{{ route('products.index') }}">
        <i class="fas fa-cart-plus text-default"></i>
        <span class="nav-link-text">Products</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'transactions.index' ? 'active' : '' }}" href="{{ route('transactions.index') }}">
        <i class="fas fa-building text-danger"></i>
        <span class="nav-link-text">Transactions</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
        <i class="fas fa-user-tie text-success"></i>
        <span class="nav-link-text">Profile</span>
    </a>
</li>