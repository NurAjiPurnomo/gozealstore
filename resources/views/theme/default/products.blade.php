<x-layout>
    <x-slot name="title">Products</x-slot>
    
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold" style="font-size: 1.5rem;">Produk Kami</h3>
            <form action="{{ url()->current() }}" method="GET" class="d-flex" style="max-width: 300px;">
                <input type="text" name="search" class="form-control rounded-start" placeholder="Cari produk..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary rounded-end">Cari</button>
            </form>
        </div>

        <div class="row">
            @forelse($products as $product)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0 product-card" style="transition: transform 0.3s, box-shadow 0.3s;">
                        <!-- <img src="{{ $product->image_url ?? 'https://via.placeholder.com/350x200?text=No+Image' }}" class="card-img-top" alt="{{ $product->name }}" style="height:180px;object-fit:cover;border-top-left-radius:0.5rem;border-top-right-radius:0.5rem;"> -->
                         <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : 'https://via.placeholder.com/350x200?text=No+Image' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-semibold mb-2 text-truncate">{{ $product->name }}</h6>
                            <p class="card-text small text-muted mb-2 text-truncate">{{ $product->description }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
<span class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
<a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-outline-dark">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
<div class="alert alert-light text-dark border">Belum ada produk pada kategori ini.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>

    {{-- Tambahkan CSS custom untuk efek hover --}}
    <style>
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .card-title {
            font-size: 1rem;
        }
    </style>
</x-layout>
