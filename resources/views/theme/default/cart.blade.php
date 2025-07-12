<x-layout>
    <x-slot name="title">Keranjang Belanja</x-slot>

    <style>
        .cart-item-card {
            border: 1px solid #e5e7eb;
            border-radius: .75rem;
            padding: 1rem;
            transition: box-shadow .2s;
        }
        .cart-item-card:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        .cart-img {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: .5rem;
        }
        .cart-item-name {
            font-size: .95rem;
            font-weight: 600;
            margin-bottom: .25rem;
        }
        .cart-item-price {
            font-size: .85rem;
            color: #6b7280;
        }
        .badge-qty {
            background: #333; /* hitam keabu */
            color: #fff;
            border-radius: 999px;
            padding: .3em .65em;
            font-size: .8rem;
            min-width: 28px;
            text-align: center;
        }
        .order-summary {
            border: 1px solid #e5e7eb;
            border-radius: .75rem;
        }
        .order-summary .total {
            font-weight: 600;
            font-size: 1.1rem;
        }
        .order-summary .line {
            border-top: 1px solid #e5e7eb;
            margin: .5rem 0;
        }
        .action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            font-size: .9rem;
        }
        .btn-outline-dark:hover {
            background-color: #000 !important;
            color: #fff !important;
            border-color: #000 !important;
        }
        .btn-outline-danger:hover {
            background-color: #333 !important;
            color: #fff !important;
            border-color: #333 !important;
        }
    </style>

    <div class="container my-5">
        <h2 class="mb-4 fw-semibold">🛒 Keranjang Belanja</h2>

        @if($cart && count($cart->items))
        <div class="row gy-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                @foreach($cart->items as $item)
                <div class="cart-item-card mb-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ $item->itemable->image_url ?? 'https://via.placeholder.com/80?text=Product' }}" class="cart-img me-3" alt="{{ $item->itemable->name }}">
                        <div>
                            <div class="cart-item-name">{{ $item->itemable->name }}</div>
                            <div class="cart-item-price">Rp {{ number_format($item->itemable->price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center me-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="action" value="decrease" class="btn btn-outline-dark btn-sm action-btn" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                <i class="bi bi-dash"></i>
                            </button>
                            <span class="badge-qty mx-1">{{ $item->quantity }}</span>
                            <button type="submit" name="action" value="increase" class="btn btn-outline-dark btn-sm action-btn">
                                <i class="bi bi-plus"></i>
                            </button>
                        </form>
                        <div class="fw-semibold text-dark me-3">Rp {{ number_format($item->itemable->price * $item->quantity, 0, ',', '.') }}</div>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm action-btn" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
                <a href="{{ url('/products') }}" class="btn btn-outline-dark mt-3"><i class="bi bi-arrow-left"></i> Lanjut Belanja</a>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary p-3 shadow-sm">
                    <h5 class="fw-semibold mb-3">💳 Ringkasan Pesanan</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($cart->calculatedPriceByQuantity(), 0, ',', '.') }}</span>
                    </div>
                    <div class="line"></div>
                    <div class="d-flex justify-content-between total">
                        <span>Total</span>
                        <span>Rp {{ number_format($cart->calculatedPriceByQuantity(), 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 mt-3">Lanjut ke Pembayaran</a>
                </div>
            </div>
        </div>
        @else
<div class="alert alert-light text-dark border">
    Keranjang belanja Anda kosong.
</div>
        @endif
    </div>
</x-layout>
