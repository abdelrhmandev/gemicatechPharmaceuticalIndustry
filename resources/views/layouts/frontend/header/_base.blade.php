 <header id="header" class="d-flex align-items-center">
      <div class="container d-flex justify-content-between align-items-center">
          <div class="logo">
              <a href="{{ route('home')}}" title="{{ config('project.app.title') }}"><img src="{{ asset('assets/frontend/img/Logo-01.png')}}" alt="{{ config('project.app.title') }}" class="img-fluid"></a>
          </div>
          <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="active" href="{{ route('home') }}">Home</a></li>
                  <li class="dropdown"><a href="#"><span>Industries</span> <i class="bi bi-chevron-down"></i></a>
                      <ul>
                        @foreach ($industries as $industry)
                          <li><a href="{{ route('industry',$industry->slug)}}">{{ $industry->title}}</a></li>
                          @endforeach
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
