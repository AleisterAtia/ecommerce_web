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

                      <li><a href="/admin" class="nav__link">Login</a></li>

                      <li><a href="#" class="ri-shopping-cart-2-line nav__link"></a></li>

                  </ul>
              </div>
          </nav>
      </header>
