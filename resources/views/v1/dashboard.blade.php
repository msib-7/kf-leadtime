@extends('layout.master')
@section('title')
    Dashboard
@endsection
@section('main-content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-sm">
            <div class="card card-flush  shadow-sm border-0 mb-5">
                <div class="card-body">
                    <div class="card-content">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="text-gray-800 fs-2 mb-2 fw-bold">Dashboard</span>
                                    </div>
                                    <div class="col-12 my-4">
                                        <span class="fw-bolder fs-2x">Formulir Monitoring Ruangan</span>
                                    </div>
                                    <div class="col-12 mb-6">
                                        <p class="text-gray-500 fs-3 w-75">
                                            Pantau kondisi Suhu, RH, dan DP secara real-time dan akurat dengan sistem monitoring kami yang mudah digunakan.
                                        </p>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <span class="fw-bold fs-4">Tanggal: </span><span id="current-date" class="text-gray-700 fs-4"></span>
                                    </div>
                                    <div class="col-12 mb-6">
                                        <div class="badge badge-light-dark p-5 fs-6 fw-semibold">
                                            {{-- @foreach ($dokumen as $index => $item)
                                                {{ $item->nomor_dokumen }}@if($index < count($dokumen) - 1) / @endif
                                            @endforeach --}}
                                        </div>
                                    </div>
                                    <div class="separator mb-5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentDateElement = document.getElementById('current-date');
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            currentDateElement.textContent = today.toLocaleDateString('en-ID', options);
        });
    </script>
@endsection