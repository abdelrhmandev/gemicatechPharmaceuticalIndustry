@extends('frontend.base.base')
@section('title', 'Products')
@section('content')
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs pharmaceutical">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home')}}">Home</a>
                    <li><a href="{{ route('categories.index')}}">Products</a>
                </ol>
                <h2>Viscometer & Rheometers</h2>
            </div>
        </section>
        <section class="product">
            <div class="container models-bg">
                <div class="row">
                    <!-- Product 1 -->
                    @foreach ($products as $product)
                    <div class="col-lg-2 col-md-6 col-sm-6 col-6 d-flex align-items-stretch">
                        <div class="model" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('product',$product->slug) }}" target="_self">
                                <div class="model-img">
                                    <img src="{{ asset($product->image) }}" class="img-fluid" alt="">
                                    <div class="model-num">
                                        View More
                                    </div>
                                </div>
                                <div class="model-info">
                                    <h4>{{ $product->title }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@stop
@push('scripts')
    <script src="{{ asset('assets/frontend/vendor/JQuery/JQuery.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugin.js') }}"></script>
@endpush
