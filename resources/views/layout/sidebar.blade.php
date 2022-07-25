<div class="dashboard-sidebar">
    <div class="logo-dashboard">
        <img src="{{ asset('asset/img/logo/logo_type.svg')}}" alt="">
    </div>

    <nav class="nav-dashboard flex-column">
        <a href="/dashboard" class="drop"><span class="iconify" data-icon="ant-design:home-outlined" data-width="20" data-height="20"style="display: inline;position:static;align-items:flex-end"></span>
        Home</a>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="iconify" data-icon="ant-design:database-twotone" data-width="20" data-height="20" style="display: inline;position:static"></span>
                    Master Data
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    @if(Auth::guard('admin')->check())
                    <li><a class="dropdown-item" href="/dashboard/admin">Admin</a></li>
                    <li><a class="dropdown-item" href="/dashboard/user">User</a></li>
                    @endif
                    <li><a class="dropdown-item" href="/dashboard/subsi">Subsi</a></li>
                    <li><a class="dropdown-item" href="/dashboard/employee">Employee</a></li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav mb-2">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="iconify" data-icon="ep:document" data-width="20" data-height="18" style="display: inline;position:static"></span>
                    Document
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="/dashboard/upload">Upload</a></li>
                    <li><a class="dropdown-item" href="/dashboard/trash">Trash</a></li>
                </ul>
            </li>
        </ul>
        
        @if(Auth::guard('admin')->check())
        <a href="/dashboard/history"><span class="iconify" data-icon="fluent:history-20-filled" data-width="20" data-height="20" style="display:inline;position:static"></span>
        History</a>
        @endif 

        <div class="logout">
            <div class="line"></div>
            <a href="{{ route('logout')}}"><span class="iconify" data-icon="carbon:logout" data-width="20" data-height="20"  style="display: inline;position:static"></span>
            Logout</a>
        </div>
    </nav>
</div>