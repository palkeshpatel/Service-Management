<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo-container">
            <img src="{{ asset('image/logo.png') }}" alt="Yuvaan Energy Limited" class="sidebar-logo">
            <h4 class="logo-text" style="font-size: 17px;">Service Management</h4>
        </div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
            <i class="bi bi-speedometer2"></i>
            <span class="nav-text">Dashboard</span>
        </a>
        <a href="{{ route('admin.requests.index') }}"
            class="nav-item {{ request()->routeIs('admin.requests.index') && !request()->has('service_type') ? 'active' : '' }}" data-bs-toggle="tooltip"
            data-bs-placement="right" title="Service Requests Inbox">
            <i class="bi bi-inbox"></i>
            <span class="nav-text">Service Requests Inbox</span>
        </a>
        <div class="submenu">
            <a href="{{ route('admin.requests.index', ['service_type' => 'panel_damage']) }}"
                class="nav-item {{ request()->get('service_type') === 'panel_damage' ? 'active' : '' }}" data-bs-toggle="tooltip"
                data-bs-placement="right" title="Panel Damage (CRACK)">
                <i class="bi bi-exclamation-triangle"></i>
                <span class="nav-text">Panel Damage (CRACK)</span>
            </a>
            <a href="{{ route('admin.requests.index', ['service_type' => 'junction_box']) }}"
                class="nav-item {{ request()->get('service_type') === 'junction_box' ? 'active' : '' }}" data-bs-toggle="tooltip"
                data-bs-placement="right" title="Junction Box Burnt/Voltage Issue">
                <i class="bi bi-lightning-charge"></i>
                <span class="nav-text">Junction Box Burnt/Voltage Issue</span>
            </a>
            <a href="{{ route('admin.requests.index', ['service_type' => 'hotspot']) }}"
                class="nav-item {{ request()->get('service_type') === 'hotspot' ? 'active' : '' }}" data-bs-toggle="tooltip"
                data-bs-placement="right" title="Hot-spot/Panel Burnt">
                <i class="bi bi-fire"></i>
                <span class="nav-text">Hot-spot/Panel Burnt</span>
            </a>
        </div>
    </nav>
    <div class="sidebar-footer">
        <div class="footer-content">
            <p class="footer-text">© {{ date('Y') }} Yuvaan Energy Limited<br>Service Management System</p>
        </div>
    </div>
</aside>
