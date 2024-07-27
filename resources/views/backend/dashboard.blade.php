@extends('backend.base.base')
@section('title', __('site.dashboard'))
@section('breadcrumbs')
<h1 class="d-flex align-items-center text-gray-900 fw-bold my-1 fs-3">{{ __('site.dashboard')}}</h1>
<span class="h-20px border-gray-200 border-start mx-3"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">{{ __('site.home') }}</a>
    </li>
</ul>
@stop
@section('style')
<link href="{{ asset('assets/backend/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/backend/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('content')
<div id="kt_content_container" class="container-xxl">
    <!--begin::Row-->

    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xl-4">
            <!--begin::Mixed Widget 3-->
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Beader-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Site Statistics</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0 d-flex flex-column">
                    <!--begin::Stats-->
                    <div class="card-p pt-5 bg-body flex-grow-1">
                        <!--begin::Row-->
                        <div class="row g-0">
                            <!--begin::Col-->
                            <div class="col mr-8">
                                <!--begin::Label-->
                                <div class="fs-7 text-muted fw-bold">Users "Admins"</div>
                                <!--end::Label-->
                                <!--begin::Stat-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $admins_counter ?? ''}}">0</div>
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col">
                                <!--begin::Label-->
                                <div class="fs-7 text-muted fw-bold">Products</div>
                                <!--end::Label-->
                                <!--begin::Stat-->
                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $products_counter ?? ''}}">0</div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-0 mt-8">
                            <!--begin::Col-->
                            <div class="col mr-8">
                                <!--begin::Label-->
                                <div class="fs-7 text-muted fw-bold">Categories</div>
                                <!--end::Label-->
                                <!--begin::Stat-->
                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $categories_counter ?? ''}}">0</div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col">
                                <!--begin::Label-->
                                <div class="fs-7 text-muted fw-bold">Brands</div>
                                <!--end::Label-->
                                <!--begin::Stat-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $brands_counter ?? ''}}">0</div>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->

                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                    <!--begin::Chart-->
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 3-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <!--end::Col-->
        <!--begin::Col-->

        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->

    <!--end::Row-->
    <!--begin::Row-->
    <!--end::Row-->
</div>
@stop


@push('scripts')
<script src="{{ asset('assets/backend/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{ asset('assets/backend/js/widgets.bundle.js')}}"></script>
<script src="{{ asset('assets/backend/js/custom/widgets.js')}}"></script>
@endpush
