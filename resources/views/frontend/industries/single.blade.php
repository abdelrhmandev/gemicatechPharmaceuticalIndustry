@extends('backend.base.base')
@section('title', __($trans . '.plural') . ' - ' . __($trans . '.edit'))
@section('breadcrumbs')
    <h1 class="d-flex align-items-center text-gray-900 fw-bold my-1 fs-3">{{ __($trans . '.plural') }}</h1>
    <span class="h-20px border-gray-200 border-start mx-3"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
        <li class="breadcrumb-item text-muted"><a href="{{ route('admin.dashboard') }}"
                class="text-muted text-hover-primary">{{ __('site.home') }}</a></li>
        <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
        <li class="breadcrumb-item text-dark">{{ __($trans . '.edit') }}</li>
    </ul>
@stop
@section('style')
    <link href="{{ asset('assets/backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/bootstrapicons-iconpicker.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/custom/file-upload/image-uploader.min.css') }}">
@stop
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs pharmaceutical" >
          <div class="container">

            <ol>
              <li><a href="industries.html">Industries</a></li>

            </ol>
            <h2>PHARMACEUTICAL</h2>

          </div>

        </section>
    <!-- End Breadcrumbs -->

            <div class="main-banner pharm-img">

            </div>

    <!--====== Start Industry Products ====== -->

    <!-- ======= Features Section ======= -->

          <section id="features" class="features">
            <div class="container" data-aos="fade-up">


              <div class="tab-content">

                <div class="tab-pane active show" id="tab-1">
                  <div class="row gy-4">

                    <section class="product" data-aos="fade-up" data-aos-delay="100">
                        <div class="container models-bg">

                          <div class="row">

                            <!-- Product 1 -->
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6 d-flex align-items-stretch">
                              <div class="model" data-aos="fade-up" data-aos-delay="200">
                                <a href="product-details.html" target="_self">
                                    <div class="model-img">
                                      <img src="assets/img/prod-models/ap-I.jpg" class="img-fluid" alt="">
                                        <div class="model-num">
                                          AP I
                                        </div>
                                    </div>
                                    <div class="model-info">
                                      <h4>Rudolph Polarimeter AUTOPOL I</h4>
                                    </div>
                                </a>
                              </div>
                            </div>

                            <!-- Product 2 -->
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6 d-flex align-items-stretch">
                              <div class="model" data-aos="fade-up" data-aos-delay="300">
                                <a href="product-details.html" target="_self">
                                  <div class="model-img">
                                    <img src="assets/img/prod-models/ap-II.jpg" class="img-fluid" alt="">
                                    <div class="model-num">
                                      AP II
                                    </div>
                                  </div>
                                  <div class="model-info">
                                    <h4>Rudolph Polarimeter AUTOPOL II</h4>
                                    <!-- <span>CTO</span> -->
                                  </div>
                                </a>
                              </div>
                            </div>

                            <!-- Product 3 -->
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6 d-flex align-items-stretch">
                              <div class="model" data-aos="fade-up" data-aos-delay="400">
                                <a href="product-details.html" target="_self">
                                  <div class="model-img">
                                    <img src="assets/img/prod-models/ap-III.jpg" class="img-fluid" alt="">
                                      <div class="model-num">
                                        AP III
                                      </div>
                                    </div>
                                  <div class="model-info">
                                    <h4>Rudolph Polarimeter AUTOPOL III</h4>
                                    <!-- <span>Accountant</span> -->
                                  </div>
                                </a>
                              </div>
                            </div>

                            <!-- Product 4 -->
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6 d-flex align-items-stretch">
                              <div class="model" data-aos="fade-up" data-aos-delay="400">
                                <a href="product-details.html" target="_self">
                                  <div class="model-img">
                                    <img src="assets/img/prod-models/ap-vplus.jpg" class="img-fluid" alt="">
                                      <div class="model-num">
                                        AP V Plus
                                      </div>
                                    </div>
                                  <div class="model-info">
                                    <h4>Rudolph Polarimeter AUTOPOL V Plus</h4>
                                    <!-- <span>Accountant</span> -->
                                  </div>
                                </a>
                              </div>
                            </div>

                          </div>

                        </div>
                      </section>

                  </div>
                </div>

                <!-- End Tab Content 1 -->


              </div>

            </div>
          </section>

    <!-- End Features Section -->


    <!--====== End Industry Products ====== -->
</main>
@stop

