@extends('layout.master')
@section('title')
    Calculation Exclude Problem
@endsection
@section('page_title')
    Calculation Exclude Problem
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
        <li class="breadcrumb-item text-muted">Exclude Problem</li>
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
                        <h6>Exclude Problem Table Data</h6>
                    </div>
                    <div>
                        {{-- @section('action_button') --}}
                        <a class="menu-link" href="{{ route('v1.calculation.problem.index') }}">
                            <button class="btn btn-danger btn-lg mt-3" id="menuProblemTable-btn">
                                <i class="ki-duotone ki-exit-left fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span id="menu-problem-table" class="fw-semibold">
                                    Back to Exclude Table
                                </span>
                            </button>
                        </a>
                        {{-- @endsection --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-1">
                            <label for="filter-tahun" class="required">Year</label>
                            <select name="filter-tahun" id="filter-tahun" class="form-control">
                                <option value="">Select Year</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="filter-bulan" class="required">Month</label>
                            <select name="filter-bulan" id="filter-bulan" class="form-control">
                                <option value="">Select Month</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="filter-line" class="required">Line</label>
                            <select name="filter-line" id="filter-line" class="form-control">
                                <option value="">All Line</option>
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
                        <table class="table table-bordered table-striped table-responsive" id="table-menu-problem">
                            <thead>
                                <tr>
                                    {{-- <th>Parent Lot</th> --}}
                                    <th>Lot Number</th>
                                    <th>Kode Produk</th>
                                    {{-- <th>Jenis Sediaan</th> --}}
                                    <th>Minico</th>
                                    <th>Line</th>
                                    <th>Line After</th>
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
                                    <th>Tag</th>
                                    <th>Reason</th>
                                    <th>Excluded By</th>
                                    <th class="text-center" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- DataTables akan mengisi ini --}}
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="excludeModal" tabindex="-1" aria-labelledby="excludeModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="excludeModalLabel">Exclude Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="tag" class="form-label">Tag</label>
                                            <select id="tag" class="form-select">
                                                <option value="">Select Tag</option>
                                                <!-- Options will be populated from the database -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reason" class="form-label">Reason</label>
                                            <textarea id="reason" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="modal-footer d-flex justify-content-between"> --}}
                                    <div class="modal-footer">
                                        {{-- <div>
                                            <button type="button" class="btn btn-warning"
                                                id="confirmRollback">Rollback</button>
                                        </div> --}}

                                        <div>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"
                                                id="confirmExclude">Exclude</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            {{-- @section('action_button') --}}
                            {{-- <button class="btn btn-secondary btn-lg mt-3" id="insert-excludeTable-btn">
                                <i class="ki-duotone ki-send fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span id="insert-exclude-table" class="fw-semibold">
                                    Insert To Exclude Table
                                </span>
                            </button> --}}
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
            let tableExclude = null; // Variabel untuk menyimpan instance DataTables

            // Function to populate years dropdown
            function populateYears() {
                $.ajax({
                    url: "{{ route('v1.calculation.exclude.getAvailableYears') }}",
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
                    url: "{{ route('v1.calculation.exclude.getAvailableMonths') }}",
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

            // Function to populate lines dropdown
            function populateLines() {
                $.ajax({
                    url: "{{ route('v1.calculation.exclude.getAvailableLines') }}",
                    method: "GET",
                    success: function(response) {
                        let lineSelect = $('#filter-line');
                        lineSelect.empty();
                        lineSelect.append('<option value="ALL">All Line</option>');
                        $.each(response, function(index, line) {
                            if (line) { // Pastikan line tidak null/undefined
                                lineSelect.append('<option value="' + line + '">' + line +
                                    '</option>');
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching lines:", error);
                    }
                });
            }

            // Helper function to render numeric columns with red text if value > target
            function renderNumericColumn(data, type, row, targetColumnName) {
                // console.log('Data:', data, 'Type:', type, 'Row:', row);
                if (type === 'display' || type === 'filter') {
                    const value = parseFloat(data);
                    const target = row.target_produk ? parseFloat(row.target_produk[targetColumnName]) : null;
                    if (target !== null && !isNaN(value) && !isNaN(target) && value > target) {
                        return '<span style="color: red;">' + data + '</span>';
                    }
                }
                return data;
            }


            // Function to initialize or reload DataTable
            function loadDataTable(bulan, tahun, line) {
                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable('#table-menu-problem')) {
                    $('#table-menu-problem').DataTable().destroy();
                }

                // Initialize new DataTable
                tableExclude = $('#table-menu-problem').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('v1.calculation.exclude.getCalculationData') }}",
                        data: {
                            bulan: bulan,
                            tahun: tahun,
                            line: line
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
                        }, {
                            data: 'kode_produk',
                            name: 'kode_produk',
                            visible: false
                        }, // Sembunyikan jika tidak ingin ditampilkan
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
                        {
                            data: 'prod_line_after',
                            name: 'prod_line_after'
                        },
                        // {
                        //     data: 'status',
                        //     name: 'status'
                        // },
                        {
                            data: 'transact_mat_awal_release',
                            name: 'transact_mat_awal_release',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, 'filter', row,
                                    'transact_mat_awal_release');
                            }
                        },
                        {
                            data: 'transact_mat_awal_akhir',
                            name: 'transact_mat_awal_akhir',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row,
                                    'transact_mat_awal_akhir');
                            }
                        },
                        {
                            data: 'wip_bahan_baku',
                            name: 'wip_bahan_baku',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'wip_bahan_baku');
                            }
                        },
                        {
                            data: 'proses_produksi',
                            name: 'proses_produksi',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'proses_produksi');
                            }
                        },
                        {
                            data: 'wip_pro_kemas',
                            name: 'wip_pro_kemas',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'wip_pro_kemas');
                            }
                        },
                        {
                            data: 'kemas',
                            name: 'kemas',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'kemas');
                            }
                        },
                        {
                            data: 'bpp_release_fg',
                            name: 'bpp_release_fg',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'bpp_release_fg');
                            }
                        },
                        {
                            data: 'endruah_release_fg',
                            name: 'endruah_release_fg',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'endruah_release_fg');
                            }
                        },
                        {
                            data: 'bpp_closed',
                            name: 'bpp_closed',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'bpp_closed');
                            }
                        },
                        {
                            data: 'closed_release_fg',
                            name: 'closed_release_fg',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'closed_release_fg');
                            }
                        },
                        {
                            data: 'transact_mat_awal_shipping',
                            name: 'transact_mat_awal_shipping',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row,
                                    'transact_mat_awal_shipping');
                            }
                        },
                        {
                            data: 'release_fg_shipping',
                            name: 'release_fg_shipping',
                            render: function(data, type, row) {
                                return renderNumericColumn(data, type, row, 'release_fg_shipping');
                            }
                        },
                        {
                            data: 'tag', // Ini masih akan mengembalikan ID
                            name: 'tag',
                            render: function(data, type, row) {
                                // Akses nama tag melalui relasi
                                return row.tag_relation ? row.tag_relation.name :
                                    ''; // Sesuaikan dengan nama relasi dan kolom nama tag Anda
                            }
                        },
                        {
                            data: 'remark',
                            name: 'remark'
                        },
                        {
                            data: 'excluded_by',
                            name: 'excluded_by'
                        },
                        // Kolom terakhir - Action
                        // {
                        //     data: null,
                        //     name: 'action',
                        //     orderable: false,
                        //     searchable: false,
                        //     render: function(data, type, row) {
                        //         // Tentukan teks dan kelas tombol berdasarkan nilai prod_line_after
                        //         let buttonText = 'Line X';
                        //         let buttonClass = 'btn-info';
                        //         let buttonIcon = 'ki-abstract-11';
                        //         if (row.prod_line_after === 'LINE X') {
                        //             buttonText = 'Rollback X';
                        //             buttonClass = 'btn-warning'; // Atau warna lain yang sesuai
                        //             buttonIcon = 'ki-arrows-circle'; // Icon untuk rollback
                        //         }
                        //         // Tentukan teks dan kelas tombol untuk "Exclude/Rollback Exclude"
                        //         let excludeButtonText = 'Exclude';
                        //         let excludeButtonClass = 'btn-danger';
                        //         let excludeButtonIcon =
                        //             'ki-duotone ki-cross-circle'; // Icon untuk Exclude
                        //         if (row.is_excluded) { // Jika data sudah di-exclude
                        //             excludeButtonText = 'Rollback';
                        //             excludeButtonClass =
                        //                 'btn-success'; // Warna hijau untuk rollback
                        //             excludeButtonIcon =
                        //                 'ki-duotone ki-arrows-circle'; // Icon untuk Rollback
                        //         }
                        //         return `
                        //         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        //             <button class="btn ${excludeButtonClass} btn-sm exclude-toggle-btn ms-1 w-100"
                        //                     data-lot-number="${row.lot_number}"
                        //                     data-is-excluded="${row.is_excluded}">
                        //                 <i class="${excludeButtonIcon} fs-2">
                        //                     <span class="path1"></span>
                        //                     <span class="path2"></span>
                        //                 </i>
                        //             </button>
                        //             <button class="btn ${buttonClass} btn-sm toggle-line-x-btn ms-1 w-100"
                        //                     data-lot-number="${row.lot_number}"
                        //                     data-current-prod-line-after="${row.prod_line_after}">
                        //                 <i class="ki-duotone ${buttonIcon} fs-2">
                        //                     <span class="path1"></span>
                        //                     <span class="path2"></span>
                        //                 </i>
                        //             </button>
                        //         </div>`;
                        //     }
                        // }
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
                let selectedLine = $('#filter-line').val();
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
                loadDataTable(selectedBulan, selectedTahun, selectedLine);
            });
            // Initialize the page
            // populateYears();


            // On page load, check for URL parameters and load data if present
            function checkInitialFilters() {
                const urlParams = new URLSearchParams(window.location.search);
                const bulan = urlParams.get('bulan');
                const tahun = urlParams.get('tahun');
                const line = urlParams.get('line');

                if (bulan && tahun) {
                    $('#filter-bulan').val(bulan);
                    $('#filter-tahun').val(tahun);
                    $('#filter-line').val(line);
                    loadDataTable(bulan, tahun, line);
                }
            }

            // Initialize the page
            populateYears();
            populateMonths();
            populateLines();
            checkInitialFilters();

        });
    </script>

    {{-- <script>
        
        // Event listener baru untuk tombol Exclude/Rollback yang dinamis
        $(document).on('click', '.exclude-toggle-btn', function() {
            const lotNumber = $(this).data('lot-number');
            const isExcluded = $(this).data('is-excluded'); // Ambil status is_excluded
            const tableExclude = $('#table-exclude').DataTable();

            if (isExcluded) {
                // Jika data sudah di-exclude, langsung panggil fungsi rollback
                Swal.fire({
                    title: 'Confirm Rollback',
                    text: "Are you sure you want to rollback this data to its original state?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, rollback it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        $.ajax({
                            url: "{{ route('v1.calculation.exclude.rollback', '') }}/" + lotNumber,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: response.success ? 'success' : 'error',
                                    title: response.success ? 'Success' : 'Failed',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                });
                                // Tidak perlu menutup modal karena tidak ada modal yang dibuka
                                tableExclude.ajax.reload(); // Reload current page
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON?.message ||
                                        'An error occurred',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            } else {
                // Jika data belum di-exclude, tampilkan modal exclude
                $('#excludeModal').data('lot-number', lotNumber); // Simpan lot_number di modal
                populateTags(); // Populate tag dropdown
                $('#excludeModal').modal('show');
            }
        });

        // Function to populate tags dropdown
        function populateTags() {
            $.ajax({
                url: "{{ route('v1.calculation.exclude.getAvailableTags') }}", // Ganti dengan route yang sesuai
                method: "GET",
                success: function(response) {
                    let tagSelect = $('#tag');
                    tagSelect.empty();
                    tagSelect.append('<option value="">Select Tag</option>');
                    $.each(response, function(index, tag) {
                        tagSelect.append('<option value="' + tag.id + '">' + tag.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching tags:", error);
                }
            });
        }

        // Handle Exclude button click in modal
        $('#confirmExclude').on('click', function() {
            const lotNumber = $('#excludeModal').data('lot-number');
            const tag = $('#tag').val();
            const reason = $('#reason').val();
            const tableExclude = $('#table-exclude').DataTable();

            if (!tag || !reason) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Information',
                    text: 'Please select a tag and provide a reason.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Send AJAX request to exclude data
            $.ajax({
                url: "{{ route('v1.calculation.exclude.destroy', '') }}/" +
                    lotNumber, // Ganti dengan route yang sesuai
                method: "POST",
                data: {
                    tag: tag,
                    reason: reason,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        icon: response.success ? 'success' : 'error',
                        title: response.success ? 'Success' : 'Failed',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                    $('#excludeModal').modal('hide');
                    $('#reason').val('');
                    tableExclude.ajax.reload();
                    // Reload DataTable or perform other actions as needed
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });



        // New: Handle Rollback button click in modal
        // $('#confirmRollback').on('click', function() {
        //     const lotNumber = $('#excludeModal').data('lot-number');
        //     Swal.fire({
        //         title: 'Confirm Rollback',
        //         text: "Are you sure you want to rollback this data to its original state?",
        //         icon: 'question',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, rollback it!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire({
        //                 title: 'Processing...',
        //                 allowOutsideClick: false,
        //                 didOpen: () => {
        //                     Swal.showLoading();
        //                 }
        //             });
        //             $.ajax({
        //                 url: "{{ route('v1.calculation.exclude.rollback', '') }}/" +
        //                     lotNumber, // New route for rollback
        //                 method: "POST",
        //                 data: {
        //                     _token: "{{ csrf_token() }}"
        //                 },
        //                 success: function(response) {
        //                     Swal.fire({
        //                         icon: response.success ? 'success' : 'error',
        //                         title: response.success ? 'Success' : 'Failed',
        //                         text: response.message,
        //                         confirmButtonText: 'OK'
        //                     });
        //                     $('#excludeModal').modal('hide');
        //                     tableExclude.ajax.reload(null, false); // Reload current page
        //                 },
        //                 error: function(xhr) {
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Error',
        //                         text: xhr.responseJSON?.message || 'An error occurred',
        //                         confirmButtonText: 'OK'
        //                     });
        //                 }
        //             });
        //         }
        //     });
        // });



        // Modifikasi script untuk tombol "Line X" menjadi "Toggle Line X"
        $(document).on('click', '.toggle-line-x-btn', function() {
            const lotNumber = $(this).data('lot-number');
            const currentProdLineAfter = $(this).data('current-prod-line-after');
            const tableExclude = $('#table-exclude').DataTable();

            if (currentProdLineAfter === 'LINE X') {
                // Jika saat ini "LINE X", tawarkan rollback
                Swal.fire({
                    title: 'Confirm Rollback',
                    text: "Are you sure you want to rollback 'Prod Line After' for lot number " +
                        lotNumber + " to its original value?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, rollback it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        $.ajax({
                            url: "{{ route('v1.calculation.exclude.rollbackLineX', '') }}/" +
                                lotNumber,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: response.success ? 'success' : 'error',
                                    title: response.success ? 'Success' : 'Failed',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                });
                                tableExclude.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON?.message ||
                                        'An error occurred',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            } else {
                // Jika bukan "LINE X", tawarkan untuk mengubah ke "LINE X"
                Swal.fire({
                    title: 'Confirm Update',
                    text: "Are you sure you want to change 'Prod Line After' to 'Line X' for lot number " +
                        lotNumber + "?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Updating...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        $.ajax({
                            url: "{{ route('v1.calculation.exclude.updateLineX', '') }}/" +
                                lotNumber,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: response.success ? 'success' : 'error',
                                    title: response.success ? 'Success' : 'Failed',
                                    text: response.message,
                                    confirmButtonText: 'OK'
                                });
                                tableExclude.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON?.message ||
                                        'An error occurred',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            }
        });
    </script> --}}


    {{-- <script>
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
    </script> --}}
@endsection
