@extends('layouts.main') {{-- Pastikan ini sesuai dengan nama file layout utama Anda --}}
@section('title', 'Order Success')

@section('container')
    <div class="container text-center" style="padding-top: 120px; padding-bottom: 120px;">
        <i class='bx bx-check-circle' style="font-size: 8rem; color: #28a745;"></i>
        <h1 class="display-4 mt-3">Thank You!</h1>

        {{-- Menampilkan pesan sukses dari controller --}}
        @if (session('success'))
            <p class="lead">{{ session('success') }}</p>
        @else
            <p class="lead">Your order has been placed successfully.</p>
        @endif

        <p>We have received your order and will begin processing it shortly.</p>
        <hr>
        <p class="lead">
            <a class="btn btn-primary btn-lg mt-3" href="/" role="button">Continue Shopping</a>
        </p>
    </div>
@endsection
