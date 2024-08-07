@extends('frontend.base.base')
@section('title', 'Home')

@section('style')
    <style>
        .featured .icon-box:hover {
            background: #184595;
        }
    </style>
@stop
@section('content')

    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
                <div class="carousel-inner" role="listbox">
                    @foreach ($sliders as $slider)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
                            style="background-image: url('{{ asset($slider->image) }}')">
                            <div class="carousel-container">
                                <div class="carousel-content">
                                    <h3 class="animate__animated animate__fadeInUp">{{ $slider->description }}</h3>
                                    <h2 class="animate__animated animate__fadeInDown"> <span>{{ $slider->title }}</span>
                                    </h2>
                                    @if ($slider->link)
                                        <a href="{{ $slider->link }}"
                                            class="btn-get-started animate__animated animate__fadeInUp">View More</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </section>
    <main id="main">


        <section id="featured" class="featured">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-3{{ $loop->first ? '' : ' mt-3 mt-lg-0' }}">
                            <a href="{{ route('categories.index', $category->slug) }}">
                                <div class="icon-box">
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


        <section id="about" class="about">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">

                        @if ($about->image)
                            <img src="{{ asset($about->image) }}" title="{{ $about->title }}" class="img-fluid"
                                alt="{{ $about->title }}">
                        @endif
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>{{ $about->title }}</h3>
                        {!! $about->description !!}
                    </div>
                </div>

            </div>
        </section>


        <section id="services" class="services">
            <div class="container">

                <div class="row g-4">
                    @foreach ($industries as $industry)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('industry', $industry->slug) }}">
                            <div class="icon-box" id="iconbox{{ $industry->id }}" onmousemove="bgChange('{{ $industry->id }}','{{ $industry->color }}')" onmouseout="ResetbgChange('{{ $industry->id }}','{{ $industry->color }}')">
                                <div class="icon" id="icon{{ $industry->id }}"
                                style="background: {{ $industry->color }};"
                                ><i class="{{ $industry->icon }}"></i></div>
                                <h4>{{ $industry->title }}</h4>
                                <p>{{ $industry->description }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </section>


        <section id="clients" class="clients">
            <div class="container">
                <x-frontend.brands :brand="$brand" :brands="$brands"/>
            </div>
        </section>

    </main>
@stop

@push('scripts')

<script>
    function bgChange(id,color) {


        document.getElementById('iconbox'+id).style.background = color;
        document.getElementById('iconbox'+id).style.color = '#fff';
        document.getElementById('iconbox'+id).style.bordercolor = color;
        document.getElementById('icon'+id).style.background = '#fff';



    }
    function ResetbgChange(id,color){

        document.getElementById('icon'+id).style.background = color;
        document.getElementById('iconbox'+id).style.background = '#fff';
        document.getElementById('iconbox'+id).style.color = '#444444';
        document.getElementById('iconbox'+id).style.bordercolor = '#fff';
    }
    </script>
@endpush
