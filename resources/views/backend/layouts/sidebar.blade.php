<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="/plugins/lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('admin-home') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'home' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview {{ isset($sidebar['parent']) && $sidebar['parent'] == 'user' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        User Manage
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin-user-index') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'user' && isset($sidebar['child']) && $sidebar['child'] == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-user-add') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'user' && isset($sidebar['child']) && $sidebar['child'] == 'add' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User Add</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ isset($sidebar['parent']) && $sidebar['parent'] == 'category' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Category Manage
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin-category-index') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'category' && isset($sidebar['child']) && $sidebar['child'] == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Category List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-category-add') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'category' && isset($sidebar['child']) && $sidebar['child'] == 'add' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Category Add</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ isset($sidebar['parent']) && $sidebar['parent'] == 'book' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Book Manage
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin-book-index') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'book' && isset($sidebar['child']) && $sidebar['child'] == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Book List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-book-add') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'book' && isset($sidebar['child']) && $sidebar['child'] == 'add' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Book Add</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ isset($sidebar['parent']) && $sidebar['parent'] == 'receipt' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Receipt Manage
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin-receipt-index') }}" class="nav-link {{ isset($sidebar['parent']) && $sidebar['parent'] == 'receipt' && isset($sidebar['child']) && $sidebar['child'] == 'index' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Receipt List</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>