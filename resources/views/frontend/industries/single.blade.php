@extends('frontend.base.base')
@section('title', 'Indsurty | '. $industry->title)
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs pharmaceutical">
            <div class="container">

                <ol>
                    <li><a href="{{ route('industries') }}">Industries</a></li>

                </ol>
                <h2>{{ $industry->title }}</h2>

            </div>

        </section>
        <!-- End Breadcrumbs -->

        <div class="main-banner" style="background-image: url('{{ asset($industry->image) }}')">
        </div>

        <!--====== Start Industry Products ====== -->

        <!-- ======= Features Section ======= -->

        <section id="features" class="features">
            <div class="container" data-aos="fade-up">


                <div class="tab-content">

                    <div class="tab-pane active show" id="tab-1">
                        <div class="row gy-4">

                            <section class="product" data-aos="fade-up" data-aos-delay="100">
                                @if ($industry->product->count())
                                    <div class="container models-bg">
                                        <div class="row">
                                            @foreach($industry->product as $product)
                                            <div class="col-lg-2 col-md-4 col-sm-6 col-6 d-flex align-items-stretch">
                                                <div class="model" data-aos="fade-up" data-aos-delay="400">
                                                    <a href="{{ route('product',$product->slug)}}" target="_self">
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
                                    <div class="alert alert-primary" role="alert">
                                        {{ __('product.empty')}}
                                    </div>
                                @endif
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop
@push('scripts')
<script src="{{ asset('assets/frontend/vendor/JQuery/JQuery.js') }}"></script>
<script src="{{ asset('assets/frontend/js/plugin.js') }}"></script>
@endpush
