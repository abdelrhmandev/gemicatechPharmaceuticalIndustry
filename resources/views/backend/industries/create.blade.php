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
    <link rel="stylesheet" href="https://appolodev.github.io/vanilla-icon-picker/dist/themes/bootstrap-5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/scss/forms/_input-group.scss">
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
                            <x-backend.cms.masterInputs :showDescription="1" :richTextArea="0" :showSlug="1" />
                        </div>
                    </div>
                </div>


                <x-backend.btns.button />
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-0 w-lg-400px gap-lg-5">
                <x-backend.cms.image />
                <x-backend.cms.colors />
                <x-backend.cms.iconsind />

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

    <script src="https://appolodev.github.io/vanilla-icon-picker/dist/icon-picker.min.js"></script>
    <script>
        KTUtil.onDOMContentLoaded(function() {
            handleFormSubmitFunc('Add{{ $trans }}');
        });
        // Initialize icon picker for form 1
        const iconPickerInput = new IconPicker('#Add{{ $trans }} #icon-picker', {
            theme: 'bootstrap-5',
            iconSource: [
                'Iconoir',
                'FontAwesome Solid 6',
                {
                    key: 'academicons',
                    prefix: 'ai ai-',
                    url: 'https://raw.githubusercontent.com/iconify/icon-sets/master/json/academicons.json'
                }
            ],
            closeOnSelect: true
        });

        const iconElementInput = document.querySelector('.input-group-text');
        iconPickerInput.on('select', (icon) => {
            console.log('Icon Selected', icon);

            if (iconElementInput.innerHTML !== '') {
                iconElementInput.innerHTML = '';
            }

            iconElementInput.className = `input-group-text ${icon.name}`;
            iconElementInput.innerHTML = icon.svg;
        });
    </script>
@endpush
