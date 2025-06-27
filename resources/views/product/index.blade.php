@extends('layouts.main')
@section('title', 'Featured Products')
@section('navSepeda', 'active')

{{-- Menambahkan section untuk custom CSS --}}
@push('styles')
    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e9ecef;
            /* Garis batas yang halus */
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .product-card .card-img-top {
            aspect-ratio: 1 / 1;
            /* Membuat gambar selalu persegi */
            object-fit: contain;
            /* Gambar akan pas di dalam kotak, tidak terpotong */
            padding: 1rem;
        }

        .product-card .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--bs-primary);
        }

        .btn-add-to-cart .button-text,
        .btn-add-to-cart .spinner-border {
            transition: opacity 0.2s ease-in-out;
        }
    </style>
@endpush


@section('container')

    <div class="container text-center py-5 mt-5 my-5">
        <h1 class="display-4 fw-bold">Featured Products</h1>
        <p class="lead text-muted col-lg-6 mx-auto">
            Discover our handpicked selection of premium watches, crafted with precision and style for the modern
            individual.
        </p>
    </div>

    <div class="container mb-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

            @foreach ($products as $product)
                <div class="col">
                    {{-- Menggunakan d-flex dan flex-column untuk membuat semua card sama tinggi --}}
                    <div class="card product-card h-100 shadow-sm">

                        {{-- Badge untuk produk baru atau diskon --}}
                        <span class="badge bg-danger product-badge">NEW!</span>

                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">

                        <div class="card-body d-flex flex-column">
                            {{-- flex-grow-1 membuat bagian ini mengisi ruang yang tersedia --}}
                            <div class="flex-grow-1">
                                <h5 class="card-title text-uppercase fw-bold">{{ $product->name }}</h5>
                                <p class="card-text small text-muted">{{ Str::limit($product->description, 90) }}</p>
                            </div>
                            <p class="product-price mt-3 mb-0">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Card Footer untuk Tombol Aksi --}}
                        <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-grid">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-add-to-cart" onclick="showLoading(this)">
                                    <span class="spinner-border spinner-border-sm d-none me-2" role="status"
                                        aria-hidden="true"></span>
                                    <i class='bx bxs-cart-add me-1'></i>
                                    <span class="button-text">Add to Cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- Script untuk loading spinner di tombol, bisa diletakkan di layout utama jika dipakai di banyak tempat --}}
    @push('scripts')
        <script>
            function showLoading(button) {
                button.disabled = true;
                let spinner = button.querySelector('.spinner-border');
                let buttonText = button.querySelector('.button-text');

                spinner.classList.remove('d-none');
                if (buttonText) buttonText.textContent = 'Adding...';

                // Untuk demo, kita set timeout. Di aplikasi nyata, ini tidak perlu.
                // Form submission akan otomatis menghentikan ini saat halaman berpindah.
                setTimeout(() => {
                    button.disabled = false;
                    spinner.classList.add('d-none');
                    if (buttonText) buttonText.textContent = 'Add to Cart';
                }, 3000); // Reset setelah 3 detik jika halaman tidak berpindah
            }
        </script>
    @endpush

@endsection
