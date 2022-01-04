<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li>
                    <a class="active" href="clients.html"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-title">
                    <span>Master Data</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-users"></i> <span> Data Users</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::is('admin/user') ? 'active' : '' }}" href="{{ route('user.index') }}">List User</a></li>
                        <li><a class="{{ Request::is('admin/user/create') ? 'active' : '' }}" href="{{ route('user.create') }}">Add User</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Produk</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::is('admin/paket') ? 'active' : '' }}" href="{{ route('paket.index') }}">Paket Laundry</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Transaksi</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-file-text"></i> <span> Transaksi</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::is('admin/transaksi') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">List Transaksi</a></li>
                        <li><a class="{{ Request::is('admin/transaksi/create') ? 'active' : '' }}" href="{{ route('transaksi.create') }}">Create Transaksi</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
