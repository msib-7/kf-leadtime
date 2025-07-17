<div id="kt_app_sidebar" class="app-sidebar flex-column shadow" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6 pt-10" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a>
            <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                class="w-100 app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                class="w-100 app-sidebar-logo-default theme-dark-show" style="filter: contrast(0);" />
            <img alt="Logo" src="{{asset('assets/logo/logo_only.png')}}" class="h-50px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->

        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate 
            {{-- {{ request()->is('v1/formulir') ? 'active' : '' }} --}}"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">

                    <div class="separator mt-5"></div>
                    {{-- <div class="menu-item pt-5">
                        <div class="card card-flush border-2">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div> --}}
                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="text-gray-800 fw-bold text-uppercase fs-8">Navigation</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    {{-- Dashboard --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('v1') ? 'active' : '' }}" href="{{ route('v1.dashboard') }}">
                            <span class="menu-icon">
                                {{-- <i class="ki-outline ki-element-11 fs-2"></i> --}}
                                <i class="ki-outline ki-home-2 fs-2"></i>
                            </span>
                            <span class="menu-title fw-semibold">Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    {{-- Sidebar Admin --}}
                    @include('layout.sidebar.admin') 

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="text-gray-800 fw-bold text-uppercase fs-8">Form Pengukuran</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    {{-- Penguukuran Awal --}}
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('v1/pengukuran-awal*') ? 'here show' : '' }}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user-tick fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Data Pengukuran Awal</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            {{-- @foreach (auth()->user()->roles->permission as $item)
                                @if (Str::is('admin.user.outstanding.index', $item->url)) --}}
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('v1/pengukuran-awal/punch/atas*') ? 'active' : '' }}"
                                            href="{{ route('v1.pengukuran-awal.punch.atas.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title ">Punch Atas</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    {{-- @break
                                @endif
                            @endforeach --}}
                    
                            {{-- @foreach (auth()->user()->roles->permission as $item)
                                @if (Str::is('admin.user.revisi.index', $item->url)) --}}
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('v1/pengukuran-awal/punch/bawah*') ? 'active' : '' }}"
                                            href="{{ route('v1.pengukuran-awal.punch.bawah.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Punch Bawah</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    {{-- @break
                                @endif
                            @endforeach --}}

                            {{-- @foreach (auth()->user()->roles->permission as $item)
                                @if (Str::is('admin.user.revisi.index', $item->url)) --}}
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('v1/pengukuran-awal/dies*') ? 'active' : '' }}"
                                            href="{{ route('v1.pengukuran-awal.dies.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Dies</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    {{-- @break
                                @endif
                            @endforeach --}}
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    {{-- Penguukuran Rutin --}}
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is('admin/users*') ? 'here show' : '' }}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user-tick fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Data Pengukuran Rutin</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            {{-- @foreach (auth()->user()->roles->permission as $item)
                            @if (Str::is('admin.user.outstanding.index', $item->url)) --}}
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->is('admin/users/outstanding*') ? 'active' : '' }}"
                                    href="{{ route('admin.user.outstanding.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title ">Punch Atas</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            {{-- @break
                            @endif
                            @endforeach --}}
                    
                            {{-- @foreach (auth()->user()->roles->permission as $item)
                            @if (Str::is('admin.user.revisi.index', $item->url)) --}}
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->is('admin/users/revisi*') ? 'active' : '' }}"
                                    href="{{ route('admin.user.revisi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Punch Bawah</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            {{-- @break
                            @endif
                            @endforeach --}}
                    
                            {{-- @foreach (auth()->user()->roles->permission as $item)
                            @if (Str::is('admin.user.revisi.index', $item->url)) --}}
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->is('admin/users/revisi*') ? 'active' : '' }}"
                                    href="{{ route('admin.user.revisi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Dies</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            {{-- @break
                            @endif
                            @endforeach --}}
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="text-gray-800 fw-bold text-uppercase fs-8">Approval Pengukuran</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    
                    {{-- Approval pengukuran awal --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('v1') ? 'active' : '' }}" href="{{ route('v1.dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-check-square fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Approval Pengukuran Awal</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    {{-- Approval pengukuran rutin --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('v1') ? 'active' : '' }}" href="{{ route('v1.dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-check-square fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Approval Pengukuran Rutin</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    {{-- Approval Disposal --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('v1') ? 'active' : '' }}" href="{{ route('v1.dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-check-square fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Approval Disposal</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="text-gray-800 fw-bold text-uppercase fs-8">Disposals</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    
                    {{-- Approval pengukuran awal --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('v1') ? 'active' : '' }}" href="{{ route('v1.dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-check-square fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Master Disposal</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    {{-- Dashboard Outstanding --}}
                    {{-- @include('layout.sidebar.outstanding')  --}}

                    {{-- Dashboard Revisi --}}
                    {{-- @include('layout.sidebar.revisi') --}}

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="text-gray-800 fw-bold text-uppercase fs-8">Other</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    {{-- Contact Us --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('v1/contactUs*') ? 'active' : '' }}" href="{{ route('v1.contactUs') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-address-book fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Contact US</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    {{-- Audit Trail --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('v1/auditTrail*') ? 'active' : '' }}" href="{{ route('v1.auditTrail.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-files-tablet fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title fw-semibold">Audit Trail</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
</div>