@extends('frontend.base.base')
@section('title', 'Indsurties')
@section('content')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('home')}}">Home</a></li>
                </ol>
                <h2>INDUSTRIES</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">



                <div class="row portfolio-container">



                    @foreach ($industries as $industry)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-lab filter-analytical">
                        <div class="portfolio-wrap">
                            <img src="{{ asset($industry->image) }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <!-- <h4>Web 3</h4> -->
                                <p>View More</p>
                                <div class="portfolio-links">
                                    <a href="{{ asset($industry->image) }}" data-gallery="portfolioGallery"
                                        class="portfolio-lightbox" title="lab"></a>
                                    <a href="{{ route('industry', $industry->slug) }}" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </section><!-- End Portfolio Section -->

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
@push('scripts')
    <script src="{{ asset('assets/frontend/vendor/JQuery/JQuery.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugin.js') }}"></script>
@endpush
