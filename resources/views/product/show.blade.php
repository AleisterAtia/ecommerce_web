@extends('layouts.main')

@section('container')
    <div class="container my-5">
        <h2 class="text-center fw-bold mb-4">{{ $category->name }}</h2>
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.show', $product->id) }}"
                                class="btn btn-outline-primary btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No products found in this category.</p>
            @endforelse
        </div>
    </div>
@endsection
