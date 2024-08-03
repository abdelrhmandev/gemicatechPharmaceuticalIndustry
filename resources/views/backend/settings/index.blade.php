@extends('backend.base.base')
@section('title', __($trans . '.plural'))
@section('breadcrumbs')
    <h1 class="d-flex align-items-center text-gray-900 fw-bold my-1 fs-3">{{ __($trans . '.plural') }}</h1>
    <span class="h-20px border-gray-200 border-start mx-3"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
        <li class="breadcrumb-item text-muted"><a href="{{ route('admin.dashboard') }}"
                class="text-muted text-hover-primary">{{ __('site.home') }}</a></li>
        <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
        <li class="breadcrumb-item text-dark">{{ __($trans . '.plural') }}</li>
    </ul>
@stop

@section('style')
    <link href="{{ asset('assets/backend/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@stop



@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    {{ __($trans . '.edit') }}
                </div>

            </div>
            <div class="card-body pt-0">
                <form id="Add{{ $trans }}" data-route-url="{{ $storeRoute }}"
                data-form-submit-error-message="{{ __('site.form_submit_error') }}"
                data-form-agree-label="{{ __('site.agree') }}" enctype="multipart/form-data">
                    @foreach ($settings as $field)
                        @if (in_array($field->type, ['textbox', 'mobile', 'phone','google_map','email']))
                            <div class="fv-row fl">
                                <label class="form-label" for="{{ $field->name }}">{{ $field->label }}</label>
                                <input type="text" name="field_id[{{ $field->id }}-{{ $field->type }}]"
                                    value="{{ $field->value }}" class="form-control mb-2"
                                    placeholder="{{ $field->label }}" />
                            </div>
                        @elseif (in_array($field->type, ['textarea']))
                            <div class="fv-row fl">
                                <label class="form-label" for="{{ $field->name }}">{{ $field->label }}</label>
                                <textarea name="field_id[{{ $field->id }}-{{ $field->type }}]" class="form-control mb-2">{{ $field->value }}</textarea>
                            </div>
                        @elseif (in_array($field->type, ['image']))
                            <div class="row">
                                <div class="col-xl">
                                    <div class="fv-row fl">
                                        <label class="form-label" for="{{ $field->name }}">{{ $field->label }}</label>
                                        <input type="file" name="field_id[{{ $field->id }}-{{ $field->type }}]">
                                        <br>
                                        <img src="{{ asset($field->value) }}" class="lozad rounded mw-100">
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                    <x-backend.btns.button />
                </form>
            </div>
        </div>
    </div>

@stop
@push('scripts')
<script src="{{ asset('assets/backend/js/custom/Tachyons.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/custom/es6-shim.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/backend/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/backend/js/custom/handleFormSubmit.js') }}"></script>
<script>
        KTUtil.onDOMContentLoaded(function() {
            handleFormSubmitFunc('Add{{ $trans }}');
        });
</script>
@endpush
