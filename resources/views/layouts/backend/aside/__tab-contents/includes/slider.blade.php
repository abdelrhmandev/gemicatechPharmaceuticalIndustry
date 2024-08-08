<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">
    <span class="menu-link menu-center">
        <span class="menu-icon me-0">
            <i class="bi bi-hr fs-3"></i>
        </span>
        <span class="menu-title">{{ __('slider.plural') }}</span>
    </span>
    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
        <div class="menu-item">
            <div class="menu-content">
                <span class="menu-section fs-5 fw-bolder ps-1 py-1">{{ __('slider.plural') }}</span>
            </div>
        </div>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title"> {{ __('slider.plural') }}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                @if (Auth::guard('admin')->user()->can('slider-list', 'admin'))
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.sliders.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('site.all') }} {{ __('slider.plural') }}</span>
                    </a>
                </div>
                @endif
                @if (Auth::guard('admin')->user()->can('slider-add', 'admin'))
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.sliders.create') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('slider.add') }}</span>
                    </a>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
