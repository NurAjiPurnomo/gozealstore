<x-layout>
    <x-slot name="title">Beranda</x-slot>

    <style>
        .category-card, .product-card {
            border: 0;
            border-radius: .75rem;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .category-card:hover, .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }
        .category-icon {
            width: 64px;
            height: 64px;
            background: #f0f2f5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
        }
        .category-icon img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }
        .product-img {
            height: 300px;
            max-width: 100%;
            object-fit: cover;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 0.85rem;
        }
        .carousel-inner img {
            height: 300px;
            object-fit: cover; /* ganti ini */
            background-color: #fff;
        }
        @media (max-width: 767.98px) {
            .carousel-inner img {
                height: 160px;
            }
            .product-card {
                height: 300px;
            }
            .product-img {
                height: 150px;
                width: 150px;
                margin: 0 auto;
                object-fit: cover;
            }
        }
    </style>


    {{-- Slider / Banner --}}
    <div id="heroCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow-sm w-100">
            <div class="carousel-item active">
                <img 
                    src="https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054365407-BANNER_SHOPEE_1_resized256-jpg.webp" 
                    srcset="
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054365407-BANNER_SHOPEE_1_resized128-jpg.webp 128w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054365407-BANNER_SHOPEE_1_resized256-jpg.webp 256w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054365407-BANNER_SHOPEE_1_resized512-jpg.webp 512w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054365407-BANNER_SHOPEE_1_resized1024-jpg.webp 1024w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054365407-BANNER_SHOPEE_1_resized1200-jpg.webp 1200w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054365407-BANNER_SHOPEE_1_resized2048-jpg.webp 2048w" 
                    sizes="100vw"
                    class="d-block w-100 object-cover" 
                    alt="Banner Shopee 1"
                    loading="eager" fetchpriority="auto">
            </div>
            <div class="carousel-item">
                <img 
                    src="https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054401211-BANNER_SHOPEE_3_resized256-jpg.webp"
                    srcset="
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054401211-BANNER_SHOPEE_3_resized128-jpg.webp 128w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054401211-BANNER_SHOPEE_3_resized256-jpg.webp 256w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054401211-BANNER_SHOPEE_3_resized512-jpg.webp 512w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054401211-BANNER_SHOPEE_3_resized1024-jpg.webp 1024w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054401211-BANNER_SHOPEE_3_resized2048-jpg.webp 2048w"
                    sizes="(max-width: 600px) 100vw, 256px"
                    class="d-block w-100" alt="Banner Shopee Baru">
            </div>
            <div class="carousel-item">
                <img 
                    src="https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054392427-BANNER_SHOPEE_2_resized256-jpg.webp"
                    srcset="
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054392427-BANNER_SHOPEE_2_resized128-jpg.webp 128w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054392427-BANNER_SHOPEE_2_resized256-jpg.webp 256w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054392427-BANNER_SHOPEE_2_resized512-jpg.webp 512w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054392427-BANNER_SHOPEE_2_resized1024-jpg.webp 1024w,
                        https://d2kchovjbwl1tk.cloudfront.net/vendors/240/assets/image/1752054392427-BANNER_SHOPEE_2_resized2048-jpg.webp 2048w"
                    sizes="(max-width: 600px) 100vw, 256px"
                    class="d-block w-100" alt="Banner Shopee 2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    {{-- Kategori --}}
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-semibold">Kategori Produk</h3>
            <a href="{{ url('/categories') }}" class="btn btn-outline-dark btn-sm">Lihat Semua</a>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach($categories as $category)
                <div class="col">
                    <a href="{{ url('/category/'.$category->slug) }}" class="text-decoration-none text-dark">
                        <div class="card category-card text-center p-3 shadow-sm">
                            <div class="category-icon">
                                <img 
                                    src="{{ asset('storage/' . $category->image) }}" 
                                    srcset="{{ asset('storage/' . $category->image) }} 1x, {{ asset('storage/' . $category->image) }} 2x" 
                                    sizes="(max-width: 600px) 48px, 64px" 
                                    alt="{{ $category->name }}">
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title mb-1">{{ $category->name }}</h6>
                                <p class="card-text text-muted text-truncate">{{ $category->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Produk --}}
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-semibold">Produk Kami</h3>
            <a href="{{ url('/products') }}" class="btn btn-outline-dark btn-sm">Lihat Semua</a>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @forelse($products as $product)
                <div class="col">
                    <div class="card product-card shadow-sm h-100">
                        @php
                            $imgUrl = $product->image_url ?? null;
                            if (!$imgUrl) {
                                $imgUrl = 'https://via.placeholder.com/350x200?text=No+Image';
                            }
                        @endphp
                        <img 
                            src="{{ $imgUrl }}" 
                            srcset="{{ $imgUrl }} 1x, {{ str_replace('350x200', '700x400', $imgUrl) }} 2x" 
                            sizes="(max-width: 600px) 140px, 300px" 
                            class="product-img" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                            <p class="card-text text-muted small text-truncate">{{ $product->description }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-dark btn-sm">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-light text-dark border">Belum ada produk yang tersedia.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>

    {{-- Slider auto play & pause on hover --}}
    <script>
        var myCarousel = document.querySelector('#heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 1500,
            pause: 'hover',
            wrap: true
        });
    </script>
</x-layout>
