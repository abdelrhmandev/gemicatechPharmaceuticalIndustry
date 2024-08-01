@extends('backend.base.guest')
@section('title', 'Internal Server Error')
@section('style')
    <style>
        body {
            background-image: url('{{ asset('assets/backend/media/auth/bg2.jpg') }}');
        }

        [data-theme="dark"] body {
            background-image: url('{{ asset('assets/backend/media/auth/bg2-dark.jpg') }}');
        }
    </style>
@stop
@section('content')

<div class="d-flex flex-column flex-center flex-column-fluid">
  <!--begin::Content-->
  <div class="d-flex flex-column flex-center text-center p-10">
    <!--begin::Wrapper-->
    <div class="card card-flush w-lg-650px py-5">
      <div class="card-body py-15 py-lg-20">
        <!--begin::Title-->
        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
        <!--end::Title-->
        <!--begin::Text-->
        <div class="fw-semibold fs-6 text-gray-500 mb-7">Error</div>
        <!--end::Text-->
        <!--begin::Illustration-->
         <!--end::Illustration-->
        <!--begin::Link-->
        <div class="mb-0">
          <a href="{{ url('/') }}" class="btn btn-sm btn-primary">{{ __('site.home') }}</a>
        </div>
        <!--end::Link-->
      </div>
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Content-->
</div>

    <!--end::Authentication - Sign-in-->
@stop
