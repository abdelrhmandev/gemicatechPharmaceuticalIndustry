<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">
    <span class="menu-link menu-center">
        <span class="menu-icon me-0">
            <i class="fonticon-stats fs-1"></i>
        </span>
        <span class="menu-title">{{ __('page.plural') }}</span>
    </span>
    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
        <div class="menu-item">
            <div class="menu-content">
                <span class="menu-section fs-5 fw-bolder ps-1 py-1">{{ __('page.plural') }}</span>
            </div>
        </div>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title"> {{ __('page.plural') }}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                @can('page-list', 'admin')
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.pages.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('site.all') }} {{ __('page.plural') }}</span>
                    </a>
                </div>
                @endcan
                @can('page-create', 'admin')
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.pages.create') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('page.add') }}</span>
                    </a>
                </div>
                @endcan
                @can('block-list', 'admin')
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.blocks.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('site.all') }} {{ __('block.plural') }}</span>
                    </a>
                </div>
                @endcan


            </div>
        </div>

    </div>
</div>
