<div class="aside-menu flex-column-fluid" id="kt_aside_menu">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
        data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold"
            id="#kt_aside_menu" data-kt-menu="true">
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item here show py-2">
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fonticon-house fs-1"></i>
                    </span>
                    <span class="menu-title">{{ __('site.home') }}</span>
                </span>
            </div>

            @include('layouts.backend.aside.__tab-contents.includes.admin')
            @include('layouts.backend.aside.__tab-contents.includes.page')
            @include('layouts.backend.aside.__tab-contents.includes.product')
            @include('layouts.backend.aside.__tab-contents.includes.industry')
            @include('layouts.backend.aside.__tab-contents.includes.brand')
            @include('layouts.backend.aside.__tab-contents.includes.slider')


            @include('layouts.backend.aside.__tab-contents.includes.setting')

            {{-- @include('layouts.backend.aside.__tab-contents.includes.menu')

            @include('layouts.backend.aside.__tab-contents.includes.social_network_links') --}}
        </div>
    </div>
</div>
