<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">
    <span class="menu-link menu-center">
        <span class="menu-icon me-0">
            <i class="bi bi-calendar3-event fs-3"></i>
        </span>
        <span class="menu-title">{{ __('industry.plural') }}</span>
    </span>
    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
        <div class="menu-item">
            <div class="menu-content">
                <span class="menu-section fs-5 fw-bolder ps-1 py-1">{{ __('industry.plural') }}</span>
            </div>
        </div>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title"> {{ __('industry.plural') }}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                @can('industry-list', 'admin')
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.industries.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('site.all') }} {{ __('industry.plural') }}</span>
                    </a>
                </div>
                @endcan
                @can('industry-add', 'admin')
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.industries.create') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('industry.add') }}</span>
                    </a>
                </div>
                @endcan


            </div>
        </div>
    </div>
</div>
