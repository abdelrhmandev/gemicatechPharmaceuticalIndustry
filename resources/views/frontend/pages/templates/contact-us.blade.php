@extends('frontend.base.base')
@section('title', 'Page | ' . $page->title)
@section('content')


@section('style')
    <style>
        #loading {
            background-color: #ffffff;
            background-image: url("{{ asset('assets/frontend/img/spinner.gif') }}");
            background-size: 25px 25px;
            background-position: center center;
            background-repeat: no-repeat;
            display: block;
        }
    </style>
@endsection



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


    <section id="contact" class="contact">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3>Our Address</h3>
                        <p>6A Farouk Amer Street, Block no. 1143, Masaken Sheraton Cairo, Egypt.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email Us</h3>
                        <p>info@gemicatech.com</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>Call Us</h3>
                        <p>+20 222 696 466 &nbsp / &nbsp+20 155 754 9651</p>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6 ">
                    <iframe
                        class="mb-4 mb-lg-0"src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=6A%20Farouk%20Amer,%20St.,%20Masaken,%20Cairo%20Governorate%2011799,%20Egypt+(Gemica%20Engineering)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                        frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div>



                <div class="col-lg-6">



                    <form id="contactusForm" data-route-url="{{ route('contactus.store') }}" role="form"
                        class="php-email-form" data-form-submit-error-message="{{ __('site.form_submit_error') }}"
                        data-form-agree-label="{{ __('site.agree') }}">

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Subject">
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                        </div>

                        <div class="text-center">

                            <div class="my-3">
                                <div id="loading">&nbsp;</div>
                            </div>


                            <button type="submit" id="btn-submit">Send Message</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->


@push('scripts')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#loading").hide();

        var formId = 'contactusForm';
        var form = document.getElementById('contactusForm');
        var submitButton = document.getElementById('btn-submit');

        submitButton.addEventListener('click', e => {
            e.preventDefault();
            $("#loading").show();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            ///////////
            $.ajax({
                type: "post",
                url: $("#" + formId).data("route-url"),
                data: new FormData($("#" + formId)[0]),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(xhr) {

                },

                success: function(response, textStatus, xhr) {
                    $("#loading").fadeOut(2000);

                    if (response["status"] == true) {
                        Swal.fire({
                            text: response["msg"],
                            icon: 'success',
                            buttonsStyling: true,
                            confirmButtonText: form.getAttribute("data-form-agree-label"),

                        }).then(function(result) {
                            window.location = window.location.href;
                        });
                    } else if (response["status"] == 'RequestValidation') {
                        let msgError = "";
                        $.each(response["msg"], function(key, value) {
                            msgError += "<p>" + value + "</p>";
                        });
                        Swal.fire({
                            html: msgError, // respose from controller
                            icon: "error",
                            buttonsStyling: true,
                            confirmButtonText: form.getAttribute("data-form-agree-label"),

                        })
                    } else if (response["status"] == false) {
                        Swal.fire({
                            html: response["msg"], // respose from controller
                            icon: "error",
                            buttonsStyling: true,
                            confirmButtonText: form.getAttribute("data-form-agree-label"),

                        })
                    }
                },


                complete: function() {
                    $('#loading').append('');
                }

            });
            /////////
        })
    </script>
@endpush
@stop
