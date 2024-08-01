@extends('frontend.base.base')
@section('title', 'Page | ' . $page->title)
@section('content')
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $page->title }}</li>
                </ol>
                <h2>{{ $page->title }}</h2>
            </div>
        </section>
        <section id="about" class="about">
            <div class="container">
                <div class="row">
                    @isset($page->image)
                        <div class="col-lg-6">
                            <img src="{{ asset($page->image) }}" class="img-fluid" alt="{{ $page->title }}"
                                title="{{ $page->title }}">
                        </div>
                    @endisset
                    <div class="col-lg-{{ isset($page->image) ? '6' : '12' }} pt-4 pt-lg-0 content">
                        {!! $page->description !!}
                    </div>
                </div>
            </div>
        </section>
        @if($page->block->count())
        <section id="more-services" class="more-services">
            <div class="container">
                <div class="section-title">
                    <h2>{{ $page->sub_title }}</h2>
                </div>
                <div class="row">
                    @foreach ($page->block as $block)
                    <div class="col-md-6 d-flex align-items-stretch mt-4">
                        <div class="card" style="background-image: url('{{ asset($block->image) }}')"
                            data-aos="fade-up" data-aos-delay="200">
                            <div class="card-body">
                                <h5 class="card-title">{{ $block->title }}</h5>
                                <p class="card-text">
                                    {{ $block->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>
@stop
