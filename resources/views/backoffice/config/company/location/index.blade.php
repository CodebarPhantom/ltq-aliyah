@extends('layouts.main')

@section('content')
    <!-- Container -->
    @include('backoffice.config.company.partials.submenu')
    <!-- Container -->
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-bold leading-none text-gray-900">
                    {{ $data['pageTitle'] }}
                </h1>
                {{-- <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                    Central Hub for Personal Customization
                </div> --}}
            </div>
            <div class="flex items-center gap-2.5">
                <div class="relative">
                    <i
                        class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 left-0 -translate-y-1/2 ml-3">
                    </i>
                    <input class="input input-sm pl-8 text-center" data-datatable-search="#kt_remote_table"
                        placeholder="Cari Data" value="" type="text">
                </div>
                <button id="refresh-btn" class="btn btn-sm text-center btn-info">
                    <i class="ki-filled ki-arrows-circle"></i>
                </button>
                <a class="btn btn-sm text-center btn-success" href="{{ route('company.create') }}">
                    <i class="ki-filled ki-plus"></i>Tambah {{ $data['pageTitle'] }}
                </a>

            </div>
        </div>
    </div>

    @include('partials.attention')

    <div class="container-fixed">
        <div class="grid pb-7.5">
            <div class="card card-grid min-w-full">
                <div class="card-body">
                    <div id="kt_remote_table">
                        <div class="scrollable-x-auto">
                            <table class="table table-auto table-border align-middle text-gray-700 font-medium text-sm"
                                data-datatable-table="true">
                                <thead>
                                    <tr>
                                        <th class="w-1/6 text-center" data-datatable-column="name">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Nama
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-1/6 text-center" data-datatable-column="entity">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Entitas
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-3/12 text-center" data-datatable-column="address">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Alamat
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-1/12 text-center" data-datatable-column="phone">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Phone
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-1/12 text-center" data-datatable-column="status">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Status
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-2/12 text-center" data-datatable-column="action">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Action
                                                </span>
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div
                            class="card-footer justify-center md:justify-between flex-col md:flex-row gap-3 text-gray-600 text-2sm font-medium">
                            <div class="flex items-center gap-2">
                                Show
                                <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
                                </select>
                                per page
                            </div>
                            <div class="flex items-center gap-4">
                                <span data-datatable-info="true">
                                </span>
                                <div class="pagination" data-datatable-pagination="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
    @include('partials.modal-confirm-delete', [
        'mainTitle' => 'Hapus lokasi kantor?',
        'mainContent' => 'Apakah anda yakin untuk menghapus lokasi kantor ini?',
    ])
@endsection

@push('javascript')
    <!-- Begin - Define Route -->
    <script type="text/javascript">
        const showRoute = "{{ route('company.show', ':id') }}"; // Pass route pattern to JS
        const editRoute = "{{ route('company.edit', ':id') }}"; // Pass route pattern to JS
    </script>
    <!-- End - Define Route -->

    <script type="text/javascript">
        const apiUrl = '{{ route('api.v1.company.datatable') }}';
        const deleteUrl = "{{ route('api.v1.company.destroy', ':id') }}";
        const element = document.querySelector('#kt_remote_table');

        const dataTableOptions = {
            apiEndpoint: apiUrl,
            pageSize: 10,
            searchQuery: '',
            infoEmpty: 'Data Kosong',
            stateSave: false,
            columns: {
                name: {
                    title: 'Nama',
                },
                entity: {
                    title: 'Entitas',
                    render: (data, type, row) => {
                        return `${type.entityName}`;
                    },
                },
                address: {
                    title: 'Alamat',
                },
                phone: {
                    title: 'Phone',
                },
                status: {
                    title: 'Status',
                    render: (data, type, row) => {
                        return `
                    <div class="flex items-center gap-1.5">
                        <span class="badge badge-dot size-2 ${type.statusColor}"></span>
                        <span class="leading-none text-gray-700"> ${type.statusName}</span>
                    </div>
                    `;
                    },
                    createdCell(cell) {
                        cell.classList.add('text-center');
                    },
                },
                action: {
                    title: 'Action',
                    render: (data, type, row) => {

                        const showUrl = showRoute.replace(':id', type.id);
                        const editUrl = editRoute.replace(':id', type.id);

                        return `
                        <a href="${showUrl}" class="btn btn-icon btn-sm btn-clear btn-primary" data-tooltip="#show">
                            <i class="ki-filled ki-eye"></i>
                        </a>
                        <div class="tooltip transition-opacity duration-300" id="show">
                            Lihat {{ $data['pageTitle'] }}
                        </div>

                        <a href="${editUrl}" class="btn btn-icon btn-sm btn-clear btn-warning"  data-tooltip="#edit">
                            <i class="ki-filled ki-notepad-edit"></i>
                        </a>
                        <div class="tooltip transition-opacity duration-300" id="edit">
                            Ubah {{ $data['pageTitle'] }}
                        </div>
                        <button class="btn btn-icon btn-sm btn-clear btn-danger" data-tooltip="#delete" data-delete-id="${type.id}"  data-modal-toggle="#modal_confirm_delete" onclick="openDeleteModal(${type.id},'modal_confirm_delete')">
                            <i class="ki-filled ki-trash"></i>
                        </button>
                        <div class="tooltip transition-opacity duration-300" id="delete">
                            Hapus {{ $data['pageTitle'] }}
                        </div>
                        <a href="http://maps.google.com/maps?q=${type.latitude},${type.longitude}" class="btn btn-icon btn-sm btn-clear btn-dark" target="_blank"  data-tooltip="#check-maps">
                            <i class="ki-filled ki-geolocation"></i>
                        </a>
                        <div class="tooltip transition-opacity duration-300" id="check-maps">
                            Check {{ $data['pageTitle'] }}
                        </div>
                    `;
                    },
                    createdCell(cell) {
                        cell.classList.add('text-center');
                    },
                },
            }

        };
        const dataTable = new KTDataTable(element, dataTableOptions);
        dataTable.search('');

        const refreshTable = document.getElementById('refresh-btn').addEventListener('click', function() {
            const searchInput = document.querySelector('[data-datatable-search="#kt_remote_table"]');
            // Clear the search input field
            searchInput.value = '';\
            dataTable.reload();
        });
    </script>
@endpush
