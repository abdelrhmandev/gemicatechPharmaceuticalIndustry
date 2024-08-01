@extends('frontend.base.base')
@section('title', 'Brand | ' . $brand->title)
@section('content')
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs pharmaceutical">
            <div class="container">
                <div class="logo cLogo">
                    <a href="{{ route('home') }}"><img src="{{ asset($brand->image) }}" alt="{{ $brand->title }}"
                            class="img-fluid"></a>
                </div>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a>
                    <li><a href="{{ route('categories.index') }}">Products</a>
                </ol>
                <h2>All "{{ $brand->title }}" Products</h2>
            </div>
        </section>
        <section class="product">


            @if ($brand->products->count())
                <div class="container models-bg">
                    <div class="row">
                        <!-- Product 1 -->
                        @foreach ($brand->products as $product)
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6 d-flex align-items-stretch">
                                <div class="model" data-aos="fade-up" data-aos-delay="200">
                                    <a href="{{ route('product', $product->slug) }}" target="_self">
                                        <div class="model-img">
                                            <img src="{{ asset($product->image) }}" class="img-fluid"
                                                alt="{{ $product->title }}" title="{{ $product->title }}">
                                            <div class="model-num">
                                                Read more
                                            </div>
                                        </div>
                                        <div class="model-info">
                                            <h4>{{ $product->title }} </h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @else
                <div class="container alert alert-primary" role="alert">
                    {{ __('product.empty') }}
                </div>
            @endif
        </section>
    </main>
@stop
@push('scripts')
    <script src="{{ asset('assets/frontend/vendor/JQuery/JQuery.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugin.js') }}"></script>
@endpush
