@extends('backend.base.base')
@section('title', __($trans . '.plural') . ' - ' . __($trans . '.add'))
@section('breadcrumbs')
    <h1 class="d-flex align-items-center text-gray-900 fw-bold my-1 fs-3">{{ __($trans . '.plural') }}</h1>
    <span class="h-20px border-gray-200 border-start mx-3"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
        <li class="breadcrumb-item text-muted"><a href="{{ route('admin.dashboard') }}"
                class="text-muted text-hover-primary">{{ __('site.home') }}</a></li>
        <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
        <li class="breadcrumb-item text-dark">{{ __($trans . '.add') }}</li>
    </ul>
@stop
@section('style')
    <link href="{{ asset('assets/backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div id="kt_content_container" class="container-xxl">
        <form id="Add{{ $trans }}" data-route-url="{{ $storeRoute }}" class="form d-flex flex-column flex-lg-row"
            data-form-submit-error-message="{{ __('site.form_submit_error') }}"
            data-form-agree-label="{{ __('site.agree') }}" enctype="multipart/form-data">
            <div class="d-flex flex-column gap-3 gap-lg-7 w-100 mb-2 me-lg-5">
                <div class="card card-flush py-0">
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-5 mt-5">
                            <x-backend.cms.masterInputs :showDescription="1" :richTextArea="1" :showSlug="1" />

                            <div class="fv-row fl">
                                <label class="form-label"
                                    for="sub_title">{{ __('site.sub_title') }}</label>
                                <input placeholder="{{ __('site.sub_title') }}" type="text" id="sub_title"
                                    name="sub_title" class="form-control mb-2"/>
                            </div>

                        </div>
                    </div>
                </div>
                <x-backend.cms.blocks :blocks="$blocks" />
                <x-backend.btns.button />
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-0 w-lg-400px gap-lg-5">
                <x-backend.cms.image />
            </div>
        </form>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('assets/backend/js/custom/Tachyons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/es6-shim.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/handleFormSubmit.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.tinyEditor',
            menubar: false,
            branding: false,
            height: 300,
            toolbar: ['styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
            ],
            plugins: 'advlist autolink link lists charmap print preview code',
            extended_valid_elements: 'i[class]'
        });
        // end of tiny editor
        KTUtil.onDOMContentLoaded(function() {
            handleFormSubmitFunc('Add{{ $trans }}','richtext');
        });
    </script>
@endpush
