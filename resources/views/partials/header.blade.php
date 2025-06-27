      <!--=============== HEADER ===============-->
      <header class="header">
          <nav class="nav container">
              <div class="nav__data">
                  <a href="#" class="nav__logo">
                      <i class="ri-planet-line"></i> Company
                  </a>

                  <div class="nav__toggle" id="nav-toggle">
                      <i class="ri-menu-line nav__burger"></i>
                      <i class="ri-close-line nav__close"></i>
                  </div>
              </div>

              <!--=============== NAV MENU ===============-->
              <div class="nav__menu" id="nav-menu">
                  <ul class="nav__list">
                      <li><a href="/" class="nav__link">Home</a></li>


                      <!--=============== DROPDOWN 1 ===============-->
                      {{-- <li class="dropdown__item">
                          <div class="nav__link">
                              Products <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                          </div>

                          <ul class="dropdown__menu">
                              <li>
                                  <a href="#" class="dropdown__link">
                                      <i class=""></i> E-Bike
                                  </a>
                              </li>

                              <li>
                                  <a href="#" class="dropdown__link">
                                      <i class=""></i> E-Motor
                                  </a>
                              </li>

                              <!--=============== DROPDOWN SUBMENU ===============-->
                          </ul>
                      </li> --}}

                      {{-- <li><a href="#" class="nav__link">Products</a></li> --}}

                      <!--=============== DROPDOWN 2 ===============-->
                      <li class="dropdown__item">
                          <div class="nav__link">
                              Products <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                          </div>

                          <ul class="dropdown__menu">
                              <li>
                                  <a href="{{ route('product.show', 1) }}" class="dropdown__link">
                                      <i class=""></i> E-Bike
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('product.show', 2) }}" class="dropdown__link">
                                      <i class=""></i> E-Motor
                                  </a>
                              </li>
                          </ul>

                      </li>

                      {{-- Blok untuk Pengguna yang BELUM LOGIN (Tamu) --}}
                      @guest
                          <li class="nav__item">
                              {{-- Arahkan ke halaman login customer --}}
                              <a href="{{ route('login') }}" class="nav__link">Login</a>
                          </li>
                          {{-- <li class="nav__item">
                              <a href="{{ route('register') }}" class="nav__link">Register</a>
                          </li> --}}
                      @endguest

                      {{-- Blok untuk Pengguna yang SUDAH LOGIN --}}
                      @auth
                          {{-- Cek peran pengguna yang sedang login --}}
                          @if (Auth::user()->role === 'admin')
                              {{-- Tampilkan ini jika pengguna adalah ADMIN --}}
                              <li class="nav__item">
                                  <a href="/admin" class="nav__link" style="color: #FFD700;">{{-- Beri warna berbeda untuk admin --}}
                                      <i class='bx bxs-dashboard'></i> Admin Dashboard
                                  </a>
                              </li>
                          @elseif (Auth::user()->role === 'customer')
                              {{-- Tampilkan ini jika pengguna adalah CUSTOMER --}}
                              <li class="nav__item">
                                  <a href="#" class="nav__link"> {{-- Ganti # dengan route ke halaman akun --}}
                                      <i class='bx bxs-user'></i> My Account
                                  </a>
                              </li>
                          @endif

                          {{-- Tombol Logout ini akan ditampilkan untuk SEMUA pengguna yang sudah login (admin & customer) --}}
                          <li class="nav__item">
                              <a href="{{ route('logout') }}" class="nav__link"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <i class='bx bx-log-out'></i> Logout
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </li>
                      @endauth

                      <li><a href="#" class="ri-shopping-cart-2-line nav__shop" id="cart-shop"></a></li>

                  </ul>
              </div>
          </nav>
      </header>
