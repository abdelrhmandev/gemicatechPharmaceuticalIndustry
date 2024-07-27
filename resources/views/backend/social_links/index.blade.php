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

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-table-toolbar="base">


                        <a class="btn btn-primary" href="{{ $createRoute }}">
                            <span class="svg-icon svg-icon-2 svg-icon-primary me-0 me-md-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM16 13.5L12.5 13V10C12.5 9.4 12.6 9.5 12 9.5C11.4 9.5 11.5 9.4 11.5 10L11 13L8 13.5C7.4 13.5 7 13.4 7 14C7 14.6 7.4 14.5 8 14.5H11V18C11 18.6 11.4 19 12 19C12.6 19 12.5 18.6 12.5 18V14.5L16 14C16.6 14 17 14.6 17 14C17 13.4 16.6 13.5 16 13.5Z"
                                        fill="currentColor"></path>
                                    <rect x="11" y="19" width="10" height="2" rx="1"
                                        transform="rotate(-90 11 19)" fill="currentColor"></rect>
                                    <rect x="7" y="13" width="10" height="2" rx="1" fill="currentColor">
                                    </rect>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            {{ __($trans . '.add') }}</a>
                    </div>

                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-bordered fs-6 gy-5" id="{{ __($trans . '.plural') }}">
                    <thead>
                        <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                            <th>{{ __('site.title') }}</th>
                            <th>{{ __('site.link') }}</th>
                            <th>{{ __('site.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($rows as $social)
                            <tr>
                                <td>{{ $social->title }}</td>
                                <td><a href="{{ $social->link }}">{{ $social->link }}</a></td>
                                <td>

                                    <a href="{{ route('admin.socialnetworks.edit', $social->id) }}" class="menu-link px-3"
                                        data-kt-table-filter="edit_row">
                                        <i class="fa fa-pencil-alt m-1 w-1 h-1 mr-1 rtl:ml-1"></i>
                                        {{ __('site.edit') }}
                                    </a>

                                    <form id="form-id" method="post" action="{{ route('admin.socialnetworks.destroy', $social->id) }}">
                                        @csrf
                                        @method('delete')
                                        <a href="#" onclick="document.getElementById('form-id').submit();"

                                            class="menu-link px-3">

                                            <i class="fa fa-trash-alt m-1 w-1 h-1 mr-1 rtl:ml-1"></i>
                                            {{ __('site.delete') }}
                                        </a>
                                    </form>




                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
