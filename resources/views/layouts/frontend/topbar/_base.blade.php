<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            @foreach ($socialnetworks as $socialnetwork)
            <a href="{{ $socialnetwork->link }}" class="{{ $socialnetwork->class }}"><i class="bi bi-{{ $socialnetwork->icon }}"></i></a>
            @endforeach
        </div>
    </div>
</section>
