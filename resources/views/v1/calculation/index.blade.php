@extends('layout.master')
@section('title')
    Calculation Exclude
@endsection
@section('page_title')
    Calculation Exclude
@endsection
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted text-hover-primary">Home</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Calculation</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Exclude</li>
        <!--end::Item-->
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection
@section('main-content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h6>Actual Table Data</h6>
                    </div>
                    <div>
                        {{-- @section('action_button') --}}
                        <button class="btn btn-success btn-lg mt-3" id="excludeTable-btn">
                            <i class="ki-duotone ki-chart-pie-4 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span id="exclude-table" class="fw-semibold">
                                Exclude Table
                            </span>
                        </button>
                        {{-- @endsection --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-3">
                            <label for="filter-tahun" class="required">Year</label>
                            <select name="filter-tahun" id="filter-tahun" class="form-control">
                                <option value="">Select Year</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter-bulan" class="required">Month</label>
                            <select name="filter-bulan" id="filter-bulan" class="form-control">
                                <option value="">Select Month</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button id="apply-filter" class="btn btn-primary">
                                <i class="ki-duotone ki-filter-tick fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span id="exclude-table" class="fw-semibold">
                                    Filter Data
                                </span></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table-actual">
                            <thead>
                                <tr>
                                    {{-- <th>Parent Lot</th> --}}
                                    <th>Lot Number</th>
                                    {{-- <th>Kode Produk</th> --}}
                                    {{-- <th>Jenis Sediaan</th> --}}
                                    <th>Grup Minico</th>
                                    <th>Prod Line</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Transact Mat Awal Release</th>
                                    <th>Transact Mat Awal Akhir</th>
                                    <th>WIP Bahan Baku</th>
                                    <th>Proses Produksi</th>
                                    <th>WIP Pro Kemas</th>
                                    <th>Kemas</th>
                                    <th>BPP Release FG</th>
                                    <th>Endruah Release FG</th>
                                    <th>BPP Closed</th>
                                    <th>Closed Release FG</th>
                                    <th>Transact Mat Awal Shipping</th>
                                    <th>Release FG Shipping</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- DataTables akan mengisi ini --}}
                            </tbody>
                        </table>
                        <div>
                        {{-- @section('action_button') --}}
                        <button class="btn btn-secondary btn-lg mt-3" id="insert-excludeTable-btn">
                            <i class="ki-duotone ki-send fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span id="insert-exclude-table" class="fw-semibold">
                                Insert To Exclude Table
                            </span>
                        </button>
                        {{-- @endsection --}}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            let tableActual = null; // Variabel untuk menyimpan instance DataTables

            // Function to populate years dropdown
            function populateYears() {
                $.ajax({
                    url: "{{ route('v1.calculation.getAvailableYears') }}",
                    method: "GET",
                    success: function(response) {
                        let yearSelect = $('#filter-tahun');
                        yearSelect.empty();
                        yearSelect.append('<option value="">Select Year</option>');
                        $.each(response, function(index, year) {
                            yearSelect.append('<option value="' + year + '">' + year +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching years:", error);
                    }
                });
            }

            // Function to populate months dropdown based on selected year
            function populateMonths(tahun) {
                $.ajax({
                    url: "{{ route('v1.calculation.getAvailableMonths') }}",
                    method: "GET",
                    data: {
                        tahun: tahun
                    }, // Kirim tahun jika ada
                    success: function(response) {
                        let monthSelect = $('#filter-bulan');
                        monthSelect.empty();
                        monthSelect.append('<option value="">Select Month</option>');
                        $.each(response, function(index, month) {
                            monthSelect.append('<option value="' + month.id + '">' + month
                                .name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching months:", error);
                    }
                });
            }

            // Function to initialize or reload DataTable
            function loadDataTable(bulan, tahun) {
                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable('#table-actual')) {
                    $('#table-actual').DataTable().destroy();
                }

                // Initialize new DataTable
                tableActual = $('#table-actual').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('v1.calculation.getCalculationData') }}",
                        data: {
                            bulan: bulan,
                            tahun: tahun
                        }
                    },
                    columns: [
                        // {
                        //     data: 'parent_lot_number',
                        //     name: 'parent_lot_number'
                        // },
                        {
                            data: 'lot_number',
                            name: 'lot_number'
                        },
                        // {
                        //     data: 'kode_produk',
                        //     name: 'kode_produk'
                        // },
                        // {
                        //     data: 'jenis_sediaan',
                        //     name: 'jenis_sediaan'
                        // },
                        {
                            data: 'grup_minico',
                            name: 'grup_minico'
                        },
                        {
                            data: 'prod_line',
                            name: 'prod_line'
                        },
                        // {
                        //     data: 'status',
                        //     name: 'status'
                        // },
                        {
                            data: 'transact_mat_awal_release',
                            name: 'transact_mat_awal_release'
                        },
                        {
                            data: 'transact_mat_awal_akhir',
                            name: 'transact_mat_awal_akhir'
                        },
                        {
                            data: 'wip_bahan_baku',
                            name: 'wip_bahan_baku'
                        },
                        {
                            data: 'proses_produksi',
                            name: 'proses_produksi'
                        },
                        {
                            data: 'wip_pro_kemas',
                            name: 'wip_pro_kemas'
                        },
                        {
                            data: 'kemas',
                            name: 'kemas'
                        },
                        {
                            data: 'bpp_release_fg',
                            name: 'bpp_release_fg'
                        },
                        {
                            data: 'endruah_release_fg',
                            name: 'endruah_release_fg'
                        },
                        {
                            data: 'bpp_closed',
                            name: 'bpp_closed'
                        },
                        {
                            data: 'closed_release_fg',
                            name: 'closed_release_fg'
                        },
                        {
                            data: 'transact_mat_awal_shipping',
                            name: 'transact_mat_awal_shipping'
                        },
                        {
                            data: 'release_fg_shipping',
                            name: 'release_fg_shipping'
                        },
                    ],
                    // ... (opsi layout lainnya)
                });
            }

            // Event listener for year selection
            $('#filter-tahun').on('change', function() {
                let selectedYear = $(this).val();
                populateMonths(selectedYear); // Panggil populateMonths dengan tahun yang dipilih
            });
            // Event listener for apply filter button
            $('#apply-filter').on('click', function() {
                let selectedBulan = $('#filter-bulan').val();
                let selectedTahun = $('#filter-tahun').val();
                if (!selectedBulan || !selectedTahun) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incomplete Filters',
                        text: 'Please select the Month and Year first.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                // Reload DataTable with new parameters
                loadDataTable(selectedBulan, selectedTahun);
            });
            // Initialize the page
            // populateYears();


            // On page load, check for URL parameters and load data if present
            function checkInitialFilters() {
                const urlParams = new URLSearchParams(window.location.search);
                const bulan = urlParams.get('bulan');
                const tahun = urlParams.get('tahun');

                if (bulan && tahun) {
                    $('#filter-bulan').val(bulan);
                    $('#filter-tahun').val(tahun);
                    loadDataTable(bulan, tahun);
                }
            }

            // Initialize the page
            populateYears();
            populateMonths();
            checkInitialFilters();

        });
    </script>
    <script>
    $('#insert-excludeTable-btn').on('click', function() {
    let selectedBulan = $('#filter-bulan').val();
    let selectedTahun = $('#filter-tahun').val();

    if (!selectedBulan || !selectedTahun) {
        Swal.fire({
            icon: 'warning',
            title: 'Filter Belum Lengkap',
            text: 'Mohon pilih Bulan dan Tahun terlebih dahulu.',
            confirmButtonText: 'OK'
        });
        return;
    }

    Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah Anda yakin akan mengirim data hasil filter ke tabel exclude?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Kirim!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('v1.calculation.insertToExcl') }}",
                method: "POST",
                data: {
                    bulan: selectedBulan,
                    tahun: selectedTahun,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        icon: response.success ? 'success' : 'error',
                        title: response.success ? 'Berhasil' : 'Gagal',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});


    </script>
@endsection
