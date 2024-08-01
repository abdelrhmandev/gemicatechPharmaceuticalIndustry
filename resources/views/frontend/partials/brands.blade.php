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
