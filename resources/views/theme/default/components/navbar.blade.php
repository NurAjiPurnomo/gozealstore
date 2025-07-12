<div>
<style>
    /* Hover lebih halus untuk dropdown */
    #userDropdown.btn-outline-dark:hover {
        background-color: #e0e0e0;
        color: #000;
    }
</style>
<nav class="navbar navbar-expand-lg border-bottom shadow-sm py-3 fixed-top" 
     style="font-family: 'Playfair Display', serif; background: linear-gradient(90deg, #272727ff 0%, #ffffffff 100%);">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand text-dark fw-bold d-flex align-items-center" href="/">
            <img src="https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized256-png.webp" 
                 srcset="https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized128-png.webp 128w,
                         https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized256-png.webp 256w,
                         https://d2kchovjgbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized512-png.webp 512w,
                         https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized1024-png.webp 1024w,
                         https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized2048-png.webp 2048w" 
                 sizes="(max-width: 600px) 20vw, 256px" 
                 alt="Logo of GOZEAL" style="max-width: 100%; height: 24px; width: auto;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/categories">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium px-3" href="/products">Produk</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <x-cart-icon />

                @if(auth()->guard('customer')->check())
                    <div class="dropdown">
                        <a class="btn btn-outline-dark rounded-pill px-3 py-1" href="#" role="button"
                           id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::guard('customer')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('customer.logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-outline-dark rounded-pill px-3 py-1" href="{{ route('customer.login') }}">Login</a>
                    <a class="btn btn-dark rounded-pill px-3 py-1 text-white" href="{{ route('customer.register') }}">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>
</div>
