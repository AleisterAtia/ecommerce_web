@extends('layouts.main')
@section('title', 'list sepeda')
@section('navSepeda', 'active')
@section('container')

    <!-- CONTENT -->
    <div class="container my-5">
        <h2 class="text-center fw-bold mb-5">Featured Products</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card product-card border-0 shadow-sm">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                            <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.show', $product->id) }}"
                                class="btn btn-outline-primary btn-sm btn-cart">Discover</a>
                            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-primary btn-sm btn-cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
