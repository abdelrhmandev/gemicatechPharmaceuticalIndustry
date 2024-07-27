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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/custom/file-upload/image-uploader.min.css') }}">
@stop
@section('content')
    <div id="kt_content_container" class="container-xxl">
        <form id="Edit{{ $trans }}" data-route-url="{{ $updateRoute }}" class="form d-flex flex-column flex-lg-row"
            data-form-submit-error-message="{{ __('site.form_submit_error') }}"
            data-form-agree-label="{{ __('site.agree') }}" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $row->id }}" />
            @method('PUT')
            <div class="d-flex flex-column gap-3 gap-lg-7 w-100 mb-2 me-lg-5">
                <div class="card card-flush py-0">
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-5 mt-5">
                            <x-backend.cms.masterInputs :showDescription="1" :richTextArea="0" :showSlug="1"
                                :row="$row" />
                            <div class="d-flex flex-column">
                                <label class="form-label" for="brief">{{ __('site.brief') }}</label>
                                <textarea placeholder="{{ __('site.brief') }}" class="form-control form-control-solid tinyEditor" rows="4"
                                    id="brief" name="brief" placeholder="">{{ $row->brief }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <x-backend.cms.categories :categories="$categories" :row="$row" />
                <x-backend.cms.child_categories :cids="$ids" :childcategories="$child_categories" />
                <x-backend.cms.gallery :media="$media"/>
                <x-backend.btns.button :destroyRoute="$destroyRoute" :redirectRoute="$redirect_after_destroy" :row="$row" :trans="$trans" />
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-0 w-lg-400px gap-lg-5">
                <x-backend.cms.image :image="$row->image" />
                <x-backend.cms.brands :brands="$brands" :id="$row->brand_id" />
                <x-backend.cms.industries :industries="$industries" :row="$row" />
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
    <script src="{{ asset('assets/backend/plugins/custom/file-upload/image-uploader.min.js') }}"></script> {{-- gallery --}}
    <script src="{{ asset('assets/backend/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom/deleteConfirmSwal.js') }}"></script>
    <script>
        // start drag drop gallery js
        $('.gallery').imageUploader({
            label: 'Drag & Drop files here or click to browse',
            imagesInputName: 'gallery',
            preloadedInputName: 'old',
            extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
            mimes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
            maxSize: 1 * 1024 * 1024, // 1 Mega
        });
        // end drag drop gallery js

        // start Ajax get sub categories
        $('input.category').on('change', function() {
            if ($(this).is(":checked")) {
                var category_id = $(this).val();
                if (category_id > 0) {
                    var url_x = '{{ route('admin.products.getSubCategories', ':x') }}';
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url_x.replace(":x", category_id),
                        method: 'GET',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#sub_categories_div').append('<div id="\child_div' +
                                    category_id +
                                    '" class="form-check form-check-custom form-check-solid mt-2"><input class="form-check-input subcategory" type="checkbox" name="sub_category_id[]" value="' +
                                    key + '" id="' + key +
                                    '" /><label class="form-check-label" for="flexCheckDefault">' +
                                    value + '</label></div>');
                            });
                        }
                    });
                }
            } else {
                var contentToRemove = document.querySelectorAll("#child_div" + $(this).val());
                $(contentToRemove).remove();
            }
        });
        tinymce.init({
            selector: '.tinyEditor',
            menubar: false,
            branding: false,
            height: 300,
            toolbar: ['styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
            ],
            plugins: 'advlist autolink link lists charmap print preview code'
        });




        // end of tiny editor
        KTUtil.onDOMContentLoaded(function() {
            handleFormSubmitFunc('Edit{{ $trans }}');
        });
    </script>
@endpush
