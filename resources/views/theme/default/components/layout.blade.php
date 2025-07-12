<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ $title ?? '' }}</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

   {{ $style ?? '' }}

   <style>
      /* Style global tema hitam putih */
      body {
         background-color: #fff !important;
         color: #000 !important;
      }
      a, a:hover, a:focus {
         color: #000 !important;
         text-decoration: none !important;
      }
      .navbar, .footer {
         background-color: #000 !important;
         color: #fff !important;
      }
      .navbar a, .footer a {
         color: #fff !important;
      }
      .btn, .btn-outline-dark {
         background-color: #000 !important;
         color: #fff !important;
         border-color: #000 !important;
      }
      .btn:hover, .btn-outline-dark:hover {
         background-color: #fff !important;
         color: #000 !important;
         border-color: #000 !important;
      }
      .category-card, .product-card {
         transition: transform 0.3s;
         height: 100%;
         background-color: #fff !important;
         color: #000 !important;
      }
      .category-card:hover, .product-card:hover {
         transform: scale(1.05);
         box-shadow: 0 3px 6px rgba(0,0,0,0.15);
      }
      .footer-link {
         color: #fff;
         text-decoration: none;
         margin: 0 0.5rem;
         font-size: 0.9rem;
         transition: color 0.3s;
      }
      .footer-link:hover {
         color: #ffc107;
      }
      .social-icon {
         display: inline-flex;
         align-items: center;
         justify-content: center;
         width: 36px;
         height: 36px;
         margin: 0 0.25rem;
         background: rgba(255,255,255,0.2);
         border-radius: 50%;
         color: #fff;
         font-size: 1rem;
         transition: background 0.3s, color 0.3s;
      }
      .social-icon:hover {
         background: #ffc107;
         color: #343a40;
      }
      /* Tambahan untuk hover tombol login dan register */
      .btn-outline-dark:hover, .btn-dark:hover {
         background-color: #fff !important;
         color: #000 !important;
         border-color: #000 !important;
      }
+     /* Lebar container-fluid lebih besar di desktop */
+     @media (min-width: 1200px) {
+        .container-fluid {
+           max-width: 1400px !important;
+           padding-left: 15px;
+           padding-right: 15px;
+        }
+     }
   </style>
</head>
<body>

      {{-- Navbar --}}
   <x-navbar themeFolder="{{ $themeFolder }}"></x-navbar>

   {{-- Konten --}}
   <main class="container-fluid my-5" style="padding-top: 80px;">
      {{ $slot }}
   </main>


  <footer class="pt-5 pb-4" style="background: linear-gradient(90deg, #272727ff 0%, #ffffffff 100%); color: #000;">
  <div class="container">
    <div class="row text-center text-md-start">

      <!-- Logo & deskripsi -->
      <div class="col-md-3 mb-4">
        <h5 class="mb-3 d-flex justify-content-center justify-content-md-start align-items-center">
          <img src="https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized256-png.webp" 
               srcset="https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized128-png.webp 128w,
                       https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized256-png.webp 256w,
                       https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized512-png.webp 512w,
                       https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized1024-png.webp 1024w,
                       https://d2kchovjbwl1tk.cloudfront.net/vendors/prod/414773/assets/image/1659409259666-LOGO%202_resized2048-png.webp 2048w" 
               sizes="(max-width: 600px) 20vw, 256px" 
               alt="Logo of GOZEAL" style="max-width: 100%; height: 24px; width: auto;">
        </h5>
        <p class="small text-muted">Belanja nyaman & aman di toko online kami. Temukan produk terbaik untukmu.</p>
      </div>

      <!-- Navigasi cepat -->
      <div class="col-md-3 mb-4">
        <h6 class="text-uppercase mb-3">Navigasi</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="/" class="text-dark text-decoration-none">Beranda</a></li>
          <li class="mb-2"><a href="/products" class="text-dark text-decoration-none">Produk</a></li>
          <li class="mb-2"><a href="/categories" class="text-dark text-decoration-none">Kategori</a></li>
          <li class="mb-2"><a href="/contact" class="text-dark text-decoration-none">Kontak</a></li>
        </ul>
      </div>

      <!-- Toko Offline -->
      <div class="col-md-3 mb-4">
        <h6 class="text-uppercase mb-3">Toko Offline Kami</h6>
        <ul class="list-unstyled small">
          <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> DEPAN MAN 2, Jl. K.H. Abdul Hadi, Cipare, Serang, Banten 42117</li>
          <li class="mb-2"><i class="bi bi-clock me-2"></i> Buka: Senin - Sabtu, 09.00 - 17.00</li>
          <li class="mb-2"><i class="bi bi-telephone me-2"></i> +62 856 6100 994</li>
        </ul>
      </div>

      <!-- Sosial media -->
      <div class="col-md-3 mb-4">
        <h6 class="text-uppercase mb-3">Ikuti Kami</h6>
        <div>
          <a href="#" class="d-inline-block text-dark text-center me-2" style="width:36px;height:36px;line-height:36px;border-radius:50%;background:rgba(0,0,0,0.1);">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="#" class="d-inline-block text-dark text-center me-2" style="width:36px;height:36px;line-height:36px;border-radius:50%;background:rgba(0,0,0,0.1);">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="#" class="d-inline-block text-dark text-center me-2" style="width:36px;height:36px;line-height:36px;border-radius:50%;background:rgba(0,0,0,0.1);">
            <i class="bi bi-twitter"></i>
          </a>
          <a href="#" class="d-inline-block text-dark text-center" style="width:36px;height:36px;line-height:36px;border-radius:50%;background:rgba(0,0,0,0.1);">
            <i class="bi bi-youtube"></i>
          </a>
        </div>
      </div>

    </div>

    <hr class="border-dark">

    <div class="text-center small text-muted">
      © {{ date('Y') }} E-Commerce. All rights reserved.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
