@extends('frontend.base.base')
@section('title', 'Categories')
@section('style')

@stop

@section('content')
    <section id="breadcrumbs" class="breadcrumbs pharmaceutical">
        <div class="container">
            <ol>
                <li><a href="{{ route('industries.index') }}">Industries</a></li>
                <li>Products</li>
            </ol>
            <h2>Categories</h2>
        </div>
    </section>


    <main id="main">

        <div class="main-banner" style="background-image: url('{{ asset($page->image) }}')"></div>


        <section id="featured" class="featured">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-3{{ $loop->first ? '' : ' mt-3 mt-lg-0' }}">
                            <a href="{{ route('categories.index', $category->slug) }}" title="{{ $category->title }}">
                                @if ($slug)
                                    <div class="icon-box"
                                        style="{{ $category->slug == $slug ? 'background-color: #184595; color: #fff;' : '' }}">
                                    @else
                                        <div class="icon-box"
                                            style="{{ $loop->first && $slug == '' ? 'background-color: #184595; color: #fff;' : '' }}">
                                @endif
                                <i class="{{ $category->icon }}"></i>
                                <h3>{{ $category->title }}</h3>
                                <p>{{ $category->description }} </p>
                        </div>
                        </a>
                </div>
                @endforeach
            </div>
            </div>
        </section>

        @if (isset($childcategories))
            <div class="container">
                <div id="cat" class="row">
                    <div class="col-lg-12 cat-links">
                        <ul class="row">
                            @foreach ($childcategories as $category)
                                <li class="col-lg-4 col-md-6"><i class="bi bi-check-lg"></i>
                                    <a title="{{ $category->title }}"
                                        href="{{ route('products.byCategory', $category->slug) }}">{{ $category->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <br>
        @endif

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container">

                <div class="section-title">
                    <h2>Our Brands</h2>
                    <p>Gemicatech partners with the world’s most trusted manufacturers of high-precision instruments for
                        General Lab & Lab Testing, Analytical & Measuring, Production Machines and Material Processing.</p>
                </div>

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach ($brands as $brand)
                            <div class="swiper-slide">
                                <a href="{{ route('brand', $brand->slug) }}" title="{{ $brand->title }}"><img
                                        src="{{ asset($brand->image) }}" class="img-fluid" alt="{{ $brand->title }}"></a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Clients Section -->

    </main><!-- End #main -->

@stop
