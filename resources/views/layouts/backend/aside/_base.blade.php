<div id="kt_aside" class="aside overflow-visible pb-5 pt-5 pt-lg-0" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'80px', '300px': '100px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo py-8" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard')}}" class="d-flex align-items-center">
            <img alt="Logo" src="{{ asset(config('project.app.favicon')) }}" class="h-45px logo" />
        </a>
    </div>
    @include('layouts.backend.aside.__tab-contents._base')
</div>
