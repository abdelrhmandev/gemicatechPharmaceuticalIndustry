<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">
    <span class="menu-link menu-center">
        <span class="menu-icon me-0">
            <i class="bi bi-people fs-3"></i>
        </span>
        <span class="menu-title">{{ __('admin.plural') }}</span>
    </span>
    <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto" style="">
        <div class="menu-item">
            <div class="menu-content">
                <span class="menu-section fs-5 fw-bolder ps-1 py-1">{{ __('admin.plural') }}</span>
            </div>
        </div>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title"> {{ __('admin.plural') }}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.admins.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('site.all') }} {{ __('admin.plural') }}</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.admins.create') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('admin.add') }}</span>
                    </a>
                </div>
            </div>

        </div>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{ __('permission.plural') }}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.permissions.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('site.all') }} {{ __('permission.plural') }}</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.permissions.create') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('permission.add') }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{ __('role.plural') }}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.roles.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('site.all') }} {{ __('role.plural') }}</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('admin.roles.create') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('role.add') }}</span>
                    </a>
                </div>
            </div>
        </div>
     </div>
</div>
