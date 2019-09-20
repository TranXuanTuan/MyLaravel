<nav>
    <div class="container">
        <ul class="menu">
            <li><a href="{{ route('home') }}" class="{{ isset($menu_active) && $menu_active == 'home' ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('category-index') }}" class="{{ isset($menu_active) && $menu_active == 'category' ? 'active' : '' }}">Category</a></li>
            <li><a href="{{ route('book-index') }}" class="{{ isset($menu_active) && $menu_active == 'book' ? 'active' : '' }}">Book</a></li>
            <li><a href="{{ route('cart-index') }}" class="{{ isset($menu_active) && $menu_active == 'cart' ? 'active' : '' }}">Cart Info</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </div>
</nav>