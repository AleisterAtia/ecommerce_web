{{-- Menggunakan komponen Offcanvas Bootstrap untuk sidebar keranjang --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="shoppingCartOffcanvas" aria-labelledby="shoppingCartOffcanvasLabel">

    {{-- Header Offcanvas dengan Tombol Close --}}
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="shoppingCartOffcanvasLabel">
            <i class="bx bxs-cart-alt me-2"></i>My Cart
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    {{-- Body Offcanvas, tempat konten keranjang --}}
    <div class="offcanvas-body">

        {{-- Cek apakah session 'cart' ada dan tidak kosong --}}
        @if (session('cart') && count(session('cart')) > 0)

            {{-- List Group untuk menampung item-item keranjang --}}
            <ul class="list-group list-group-flush">
                @php $total = 0; @endphp

                @foreach (session('cart') as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp

                    {{-- Setiap item keranjang dalam satu list-group-item --}}
                    <li class="list-group-item py-3">
                        <div class="row g-3 align-items-center">
                            {{-- Kolom untuk Gambar Produk --}}
                            <div class="col-3">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                    class="img-fluid rounded">
                            </div>

                            {{-- Kolom untuk Detail Produk --}}
                            <div class="col-7">
                                <h6 class="mb-1 fw-bold">{{ $item['name'] }}</h6>
                                <p class="text-muted mb-1" style="font-size: 0.9em;">
                                    Qty: {{ $item['quantity'] }}
                                </p>
                                <p class="mb-0 fw-bold text-primary">
                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Kolom untuk Tombol Hapus --}}
                            <div class="col-2 text-end">
                                <form action="{{ route('cart.remove', $id) }}" method="POST"> {{-- Ganti # dengan route('cart.remove', $id) nanti --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0"
                                        title="Remove item">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <hr class="my-4">

            {{-- Bagian Rincian Total Harga --}}
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Subtotal</span>
                <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Shipping</span>
                <span class="fw-bold">FREE</span>
            </div>
            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            {{-- Tombol Checkout --}}
            <div class="d-grid gap-2 mt-4">
                <form action="{{ route('checkout.store') }}" method="POST" class="d-grid">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="button-text">PROCEED TO CHECKOUT</span>
                    </button>
                </form>
            </div>
        @else
            {{-- Tampilan jika keranjang kosong --}}
            <div class="text-center mt-5">
                <i class="bx bx-cart" style="font-size: 5rem; color: #ccc;"></i>
                <h5 class="mt-3">Keranjang Anda Kosong</h5>
                <p class="text-muted">Sepertinya kamu belum menambahkan apapun ke dalam keranjang.</p>
            </div>
        @endif
    </div>
</div>

{{-- Sedikit JavaScript untuk menampilkan spinner saat tombol ditekan --}}
<script>
    function showLoading(button) {
        button.querySelector('.spinner-border').classList.remove('d-none');
        button.querySelector('.button-text').textContent = 'Processing...';
        button.disabled = true;
    }
</script>
