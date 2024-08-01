 <header id="header" class="d-flex align-items-center">
      <div class="container d-flex justify-content-between align-items-center">
          <div class="logo">
              <a href="{{ route('home')}}"><img src="{{ asset('assets/frontend/img/Logo-01.png')}}" alt="" class="img-fluid"></a>
          </div>
          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="active" href="{{ route('home')}}">Home</a></li>
                  <li class="dropdown"><a href="#"><span>Industries</span> <i class="bi bi-chevron-down"></i></a>
                      <ul>
                          <li><a href="industry-details.html">Pharmaceuticals</a></li>
                          <li><a href="industry-details.html">Oil & Gas</a></li>
                          <li><a href="industry-details.html">Fragrance & Flavour</a></li>
                          <li><a href="industry-details.html">Sugar</a></li>
                          <li><a href="industry-details.html">Food & Beverage</a></li>
                          <li><a href=" industry-details.html">Cosmetics</a></li>
                          <li><a href="industry-details.html">Material Processing</a></li>
                          <li><a href="industry-details.html">Light Measurement</a></li>
                          <li><a href="industry-details.html">Environment & Energy</a></li>
                      </ul>
                  </li>
                  <li><a href="{{ route('categories.index')}}">Products</a></li>
                  <li><a href="{{ route('page','support')}}">Support</a></li>
                  <li><a href="{{ route('page','contact-us')}}">Contact</a></li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav>
          <!-- .navbar -->
      </div>
  </header><!-- End Header -->
