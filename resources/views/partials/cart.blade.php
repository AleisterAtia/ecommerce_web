<div class="cart" id="cart">
    <i class='bx bx-x cart__close' id="cart-close"></i>
    <h2 class="cart__title-center">My Cart</h2>

    {{-- Cek apakah session 'cart' ada dan tidak kosong --}}
    @if (session('cart') && count(session('cart')) > 0)
        <div class="cart__container">
            {{-- Menghitung total harga --}}
            @php $total = 0; @endphp

            @foreach (session('cart') as $id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <article class="cart__card">
                    <div class="cart__box">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="cart__img">
                    </div>

                    <div class="cart__details">
                        <h3 class="cart__title">{{ $item['name'] }}</h3>
                        {{-- Tampilkan harga dalam format Rupiah --}}
                        <span class="cart__price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                        <div class="cart__amount">
                            <div class="cart__amount-content">
                                <span class="cart__amount-number">Qty: {{ $item['quantity'] }}</span>
                            </div>
                            {{-- Tambahkan form untuk remove --}}
                            <form action="#" method="POST" style="display:inline;"> {{-- Ganti # dengan route('cart.remove', $id) nanti --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cart__amount-trash"
                                    style="background:none; border:none; cursor:pointer;">
                                    <i class='bx bx-trash-alt'></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="cart__prices">
            <span class="cart__prices-item">{{ count(session('cart')) }} items</span>
            <span class="cart__prices-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        {{-- Letakkan ini di dalam @if (session('cart')), di bawah div .cart__prices --}}
        <div class="cart__checkout mt-4">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <button type="submit" class="button" style="width: 100%;">
                    PROCEED TO CHECKOUT
                </button>
            </form>
        </div>

        {{-- Form Checkout bisa Anda letakkan di sini --}}
    @else
        <div class="cart__container">
            <p class="text-center">Your cart is empty.</p>
        </div>
    @endif
</div>
