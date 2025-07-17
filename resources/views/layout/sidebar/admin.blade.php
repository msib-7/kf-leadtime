{{-- @if (auth()->user()->jobLvl == 'Administrator') --}}
@foreach (auth()->user()->roles->permission as $item)
    @if (Str::is('admin.*', $item->url))
        <!--begin:Menu item-->
        <div class="menu-item pt-5">
            <!--begin:Menu content-->
            <div class="menu-content">
                <span class="text-gray-800 fw-bold text-uppercase fs-8">Admin Tools</span>
            </div>
            <!--end:Menu content-->
        </div>
        <!--end:Menu item-->
        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.permission.index', $item->url))
                {{-- Permission --}}
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/permission*') ? 'active' : '' }}"
                        href="{{ route('admin.permission.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-lock-2 fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Permission Access</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.dept.index', $item->url))
                {{-- Department --}}
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/department*') ? 'active' : '' }}"
                        href="{{ route('admin.dept.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-office-bag fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Department</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.ruang.index', $item->url))
                {{-- Ruangan --}}
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/ruangan*') ? 'active' : '' }}" href="{{ route('admin.ruang.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-clipboard fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Master Mesin</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.jenis.ruang.index', $item->url) || Str::is('admin.syarat.index', $item->url))
                {{-- Jenis Ruangan --}}
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion {{ request()->is('admin/jenis/*') || request()->is('admin/syarat*') ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-clipboard fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Master Produk</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        @foreach (auth()->user()->roles->permission as $item)
                            @if (Str::is('admin.jenis.ruang.index', $item->url))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ request()->is('admin/jenis/*') ? 'active' : '' }}"
                                        href="{{ route('admin.jenis.ruang.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title ">Nama Produk</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                @break
                            @endif
                        @endforeach

                        @foreach (auth()->user()->roles->permission as $item)
                            @if (Str::is('admin.syarat.index', $item->url))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ request()->is('admin/syarat*') ? 'active' : '' }}"
                                        href="{{ route('admin.syarat.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kode Produk</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                                @break
                            @endif
                        @endforeach
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.waktu.index', $item->url))
                {{-- Waktu --}}
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/waktu*') ? 'active' : '' }}" href="{{ route('admin.waktu.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-time fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Master Calibration Tools</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.settings.index', $item->url))
                {{-- Web Settings --}}
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/settings*') ? 'active' : '' }}"
                        href="{{ route('admin.settings.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-user-tick fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Users Manage</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.settings.index', $item->url))
                {{-- Web Settings --}}
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-gear fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Page Settings</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.settings.index', $item->url))
                {{-- Web Settings --}}
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-gear fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Form Settings</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.library.document.index', $item->url))
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/library*') ? 'active' : '' }}"
                        href="{{ route('admin.library.document.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-book fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">CR / SOP</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach

        {{-- @foreach (auth()->user()->roles->permission as $item)
            @if (Str::is('admin.db.index', $item->url))
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="text-gray-800 fw-bold text-uppercase fs-8">DB</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('admin/db*') ? 'active' : '' }}"
                        href="{{ route('admin.db.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-office-bag fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title fw-semibold">Backup</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                @break
            @endif
        @endforeach --}}

        @break
    @endif
@endforeach