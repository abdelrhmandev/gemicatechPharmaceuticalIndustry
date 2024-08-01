@extends('frontend.base.base')
@section('title', 'Products | '.$product->title)
@section('content')

<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="{{ route('industries.index')}}">Industries</a></li>
      </ol>
        <h2>
            {{-- {{ $product->industries }} --}}
        </h2>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

            <div class="col-lg-7">
                <img class="img-fluid" src="{{ asset($product->image)}}" alt="">
            </div>

            <div class="col-lg-4">
              <div class="portfolio-info">
                <h3>{{ $product->title }}</h3>
                <ul>
                  <p style="margin-top: 10px;">
                    {!! $product->brief !!}
                  </p>
                </ul>
              </div>
            </div>

          <div class="portfolio-description">
            {!! $product->description !!}

          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->
  @stop
