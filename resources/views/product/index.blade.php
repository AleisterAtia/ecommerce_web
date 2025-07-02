@extends('layouts.main')
@section('title', 'Toko Sepeda & Motor Listrik Terbaik')
@section('navSepeda', 'active')

{{-- Custom CSS --}}

@section('container')

    {{-- Hero Section --}}
    @if (isset($heroProduct))
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 hero-content">
                        <div class="mb-4">
                            <span class="hero-badge">
                                <i class='bx bxs-star me-1'></i>
                                BEST SELLER
                            </span>
                        </div>
                        <h1 class="hero-title">{{ $heroProduct->name }}</h1>
                        <p class="hero-description mb-4">{{ Str::limit($heroProduct->description, 150) }}</p>
                        <div class="d-flex align-items-center mb-4">
                            <span class="hero-price me-3">Rp {{ number_format($heroProduct->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex flex-wrap gap-3">
                            <form action="{{ route('cart.add', $heroProduct->id) }}" method="POST"
                                onsubmit="showLoading(this)">
                                @csrf
                                <button type="submit" class="btn hero-btn">
                                    <i class='bx bxs-cart-add me-2'></i> Beli Sekarang
                                </button>
                            </form>
                            {{-- Tombol Detail bisa diarahkan ke halaman detail produk --}}
                        </div>
                    </div>
                    <div class="col-lg-6 hero-image text-center">
                        <img src="{{ asset('storage/' . $heroProduct->image) }}" alt="{{ $heroProduct->name }}"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Products Section --}}
    <section class="products-section">
        <div class="container">
            {{-- Section Header --}}
            <div class="text-center mb-5">
                <h2 class="section-title">Koleksi Produk Kami</h2>
                <p class="section-subtitle col-lg-6 mx-auto">
                    Temukan sepeda dan motor listrik berkualitas tinggi dengan harga terbaik.
                    Pilih sesuai kebutuhan dan gaya hidup Anda.
                </p>
            </div>

            {{-- Filter Section --}}
            <div class="row justify-content-center mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="categoryFilter" class="form-label me-3 mb-0 fw-semibold">Filter Kategori:</label>
                        {{-- Ganti <select> lama Anda dengan ini --}}
                        {{-- <select class="form-select filter-dropdown" id="categoryFilter" onchange="filterProducts()">
                            <option value="all">Semua Produk</option>
                            @foreach ($categories as $category)
                                {{-- value dibuat lowercase agar cocok dengan data-category di atas --}}
                        {{-- <option value="{{ strtolower($category->name) }}">{{ $category->name }}</option>
                            @endforeach
                        </select>  --}}
                    </div>
                </div>
            </div>

            {{-- Products Grid --}}
            {{-- Products Grid --}}
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="productsContainer">

                {{-- Memulai loop untuk menampilkan produk dari database --}}
                @foreach ($products as $product)
                    {{-- Kita menggunakan strtolower() untuk memastikan data-category cocok dengan value di filter JS --}}
                    <div class="col product-item fade-in"
                        data-category="{{ strtolower($product->category->name ?? 'lainnya') }}">
                        <div class="card product-card h-100">

                            {{-- Contoh logika untuk menampilkan badge --}}
                            @if ($loop->first)
                                <span class="badge badge-bestseller product-badge">POPULAR</span>
                            @else
                                <span class="badge badge-new product-badge">NEW!</span>
                            @endif

                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}">

                            <div class="card-body d-flex flex-column">
                                <div class="mb-2">
                                    {{-- Menampilkan nama kategori secara dinamis --}}
                                    <span
                                        class="category-badge category-{{ strtolower($product->category->name ?? 'lainnya') }}">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="product-title">{{ $product->name }}</h5>
                                    <p class="product-description">{{ Str::limit($product->description, 90) }}</p>
                                </div>
                                <p class="product-price mt-3 mb-0">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                                {{-- Form Add to Cart yang sudah dinamis --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-grid"
                                    onsubmit="showLoading(this)">
                                    @csrf
                                    <button type="submit" class="btn btn-add-to-cart">
                                        <span class="spinner-border spinner-border-sm d-none me-2"></span>
                                        <i class='bx bxs-cart-add me-1'></i>
                                        <span class="button-text">Tambah ke Keranjang</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    @push('scripts')
        <script>
            // Loading function
            function showLoading(form) {
                const button = form.querySelector('button[type="submit"]');
                if (button) {
                    button.disabled = true;
                    const spinner = button.querySelector('.spinner-border');
                    const buttonText = button.querySelector('.button-text');

                    if (spinner) spinner.classList.remove('d-none');
                    if (buttonText) buttonText.textContent = 'Menambahkan...';

                    // Re-enable button after 2 seconds (simulate loading)
                    setTimeout(() => {
                        button.disabled = false;
                        if (spinner) spinner.classList.add('d-none');
                        if (buttonText) buttonText.textContent = 'Tambah ke Keranjang';
                    }, 2000);
                }
            }

            // Filter products function
            function filterProducts() {
                const filter = document.getElementById('categoryFilter').value;
                const products = document.querySelectorAll('.product-item');

                products.forEach(product => {
                    if (filter === 'all' || product.dataset.category === filter) {
                        product.style.display = 'block';
                        product.classList.add('fade-in');
                    } else {
                        product.style.display = 'none';
                    }
                });
            }

            // Add smooth scrolling to filter changes
            document.getElementById('categoryFilter').addEventListener('change', function() {
                document.getElementById('productsContainer').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });

            // Initialize animations on page load
            document.addEventListener('DOMContentLoaded', function() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in');
                        }
                    });
                });

                document.querySelectorAll('.product-item').forEach(item => {
                    observer.observe(item);
                });
            });
        </script>
    @endpush

@endsection
