@if (auth()->user()->isUserOutstanding() || auth()->user()->jobLvl == 'Administrator')
    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ request()->is('v1/monitoring/outstanding*') ? 'active' : '' }}"
            href="{{ route('v1.monitoring.outstanding.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-tablet-up fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
            <span class="menu-title fw-semibold">Data Overdue</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
@endif