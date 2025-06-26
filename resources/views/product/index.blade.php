@extends('layouts.main')

@section('container')
    <section class="home" id="home">
        <div class="home__container container grid">
            <div class="home__img-bg">
                {{-- <pre>{{ dd($product) }}</pre> --}}

                <img src="{{ asset('storage/products/01JYEMFJEB2BDF10R7H263EVS0.png') }}" alt="Manual Image">

            </div>

            <div class="home__social">
                <a href="https://www.facebook.com/" target="_blank" class="home__social-link">
                    Facebook
                </a>
                <a href="https://twitter.com/" target="_blank" class="home__social-link">
                    Twitter
                </a>
                <a href="https://www.instagram.com/" target="_blank" class="home__social-link">
                    Instagram
                </a>
            </div>

            <div class="home__data">
                <h1 class="home__title">NEW E-BIKE <br> STAREER 2 MAGIC</h1>
                <p class="home__description">
                    Latest arrival of the new imported e-bike of the STAREER series,
                    with a modern and resistant design.
                </p>
                <span class="home__price">Rp 3,500,000,-00</span>

                <div class="home__btns">
                    <a href="#" class="button button--gray button--small">
                        Discover
                    </a>

                    <button class="button home__button">ADD TO CART</button>
                </div>
            </div>
        </div>
    </section>

    <section class="featured section container" id="featured">
        <h2 class="section__title">
            Featured
        </h2>

        <div class="featured__container grid">
            @foreach ($products as $product)
                <article class="featured__card">
                    <span class="featured__tag">Sale</span>

                    <img src="{{ asset('storage/products/01JYEMW22CMZBBX17XM85QP00B.png') }}" alt="{{ $product->name }}"
                        class="featured__img">


                    <div class="featured__data">
                        <h3 class="featured__title">{{ strtoupper($product->name) }}</h3>
                        <span class="featured__price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <button class="button featured__button">ADD TO CART</button>
                </article>
            @endforeach
        </div>


        <button class="button featured__button">ADD TO CART</button>
        </article>

        {{-- <div class="featured__container grid">
            @foreach ($products as $product)
                <article class="featured__card">
                    <span class="featured__tag">Sale</span>

                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                        class="featured__img">

                    <div class="featured__data">
                        <h3 class="featured__title">{{ strtoupper($product->name) }}</h3>
                        <span class="featured__price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <button class="button featured__button">ADD TO CART</button>
                </article>
            @endforeach
        </div> --}}


        {{-- <div class="featured__container grid">
            @foreach ($products as $product)
                <article class="featured__card">
                    <span class="featured__tag">Sale</span>

                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                        class="featured__img">

                    <div class="featured__data">
                        <h3 class="featured__title">{{ strtoupper($product->name) }}</h3>
                        <span class="featured__price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <button class="button featured__button">ADD TO CART</button>
                </article>
            @endforeach
        </div> --}}

        </div>
    </section>

    <section class="story section container">
        <div class="story__container grid">
            <div class="story__data">
                <h2 class="section__title story__section-title">
                    Our Story
                </h2>

                <h1 class="story__title">
                    Inspirational Watch of <br> this year
                </h1>

                <p class="story__description">
                    The latest and modern watches of this year, is available in various
                    presentations in this store, discover them now.
                </p>

                <a href="#" class="button button--small">Discover</a>
            </div>

            <div class="story__images">
                {{-- <img src="{{ asset('storage/products/01JYEKVWS3PC9QKVW1F63ZZ5NA.png') }}" alt="{{ $product->name }}"
                    class="featured__img"> --}}
                <div class="story__square"></div>
            </div>
        </div>
    </section>

    <section class="products section container" id="products">
        <h2 class="section__title">
            Products
        </h2>

        <div class="products__container grid">
            <article class="products__card">
                <img src="assets/img/product1.png" alt="" class="products__img">

                <h3 class="products__title">Spirit rose</h3>
                <span class="products__price">$1500</span>

                <button class="products__button">
                    <i class='bx bx-shopping-bag'></i>
                </button>
            </article>

            <article class="products__card">
                <img src="assets/img/product2.png" alt="" class="products__img">

                <h3 class="products__title">Khaki pilot</h3>
                <span class="products__price">$1350</span>

                <button class="products__button">
                    <i class='bx bx-shopping-bag'></i>
                </button>
            </article>

            <article class="products__card">
                <img src="assets/img/product3.png" alt="" class="products__img">

                <h3 class="products__title">Jubilee black</h3>
                <span class="products__price">$870</span>

                <button class="products__button">
                    <i class='bx bx-shopping-bag'></i>
                </button>
            </article>

            <article class="products__card">
                <img src="assets/img/product4.png" alt="" class="products__img">

                <h3 class="products__title">Fosil me3</h3>
                <span class="products__price">$650</span>

                <button class="products__button">
                    <i class='bx bx-shopping-bag'></i>
                </button>
            </article>

            <article class="products__card">
                <img src="assets/img/product5.png" alt="" class="products__img">

                <h3 class="products__title">Duchen</h3>
                <span class="products__price">$950</span>

                <button class="products__button">
                    <i class='bx bx-shopping-bag'></i>
                </button>
            </article>
        </div>
    </section>

    <section class="new section container" id="new">
        <h2 class="section__title">
            New Arrivals
        </h2>

        <div class="new__container">
            <div class="swiper new-swiper">
                <div class="swiper-wrapper">
                    <article class="new__card swiper-slide">
                        <span class="new__tag">New</span>

                        <img src="assets/img/new1.png" alt="" class="new__img">

                        <div class="new__data">
                            <h3 class="new__title">Longines rose</h3>
                            <span class="new__price">$980</span>
                        </div>

                        <button class="button new__button">ADD TO CART</button>
                    </article>

                    <article class="new__card swiper-slide">
                        <span class="new__tag">New</span>

                        <img src="assets/img/new2.png" alt="" class="new__img">

                        <div class="new__data">
                            <h3 class="new__title">Jazzmaster</h3>
                            <span class="new__price">$1150</span>
                        </div>

                        <button class="button new__button">ADD TO CART</button>
                    </article>

                    <article class="new__card swiper-slide">
                        <span class="new__tag">New</span>

                        <img src="assets/img/new3.png" alt="" class="new__img">

                        <div class="new__data">
                            <h3 class="new__title">Dreyfuss gold</h3>
                            <span class="new__price">$750</span>
                        </div>

                        <button class="button new__button">ADD TO CART</button>
                    </article>

                    <article class="new__card swiper-slide">
                        <span class="new__tag">New</span>

                        <img src="assets/img/new4.png" alt="" class="new__img">

                        <div class="new__data">
                            <h3 class="new__title">Portuguese rose</h3>
                            <span class="new__price">$1590</span>
                        </div>

                        <button class="button new__button">ADD TO CART</button>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter section container">
        <div class="newsletter__bg grid">
            <div>
                <h2 class="newsletter__title">Subscribe Our <br> Newsletter</h2>
                <p class="newsletter__description">
                    Don't miss out on your discounts. Subscribe to our email
                    newsletter to get the best offers, discounts, coupons,
                    gifts and much more.
                </p>
            </div>

            <form action="" class="newsletter__subscribe">
                <input type="email" placeholder="Enter your email" class="newsletter__input">
                <button class="button">
                    SUBSCRIBE
                </button>
            </form>
        </div>
    </section>
@endsection
