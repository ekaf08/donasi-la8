@extends('layouts.app')
@section('title', 'Aplikasi Management')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Setup</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                @foreach ($role->menu as $menu)
                    @foreach ($menu->sub_menu as $sub_menu)
                        @if ($sub_menu->id_sub_menu == 11 && $sub_menu->c_insert == 't')
                            <x-slot name="header">
                                <button onclick="addForm(`{{ route('setup.store') }}`, 'Tambah Role')"
                                    class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                                    Tambah</button>
                            </x-slot>
                        @endif
                    @endforeach
                @endforeach

                <x-table id="table-role">
                    <x-slot name="thead">
                        <th class="border text-center" width=3%>No</th>
                        <th class="border text-center">Role</th>
                        <th class="border text-center" width=10%><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    <!-- Modal untuk form menu setup -->
    <x-modal size='modal-xl'>
        <x-slot name="title"></x-slot>
        @method('post')
        <x-card>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="title">Role</label>
                        <input type="text" class="form-control" name="role" id="role">
                    </div>
                </div>
            </div>

            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" data-dismis="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
            </x-slot>
        </x-card>
        <x-card>
            <x-table id="table-menu">
                <x-slot name="thead">
                    <th class="border text-center" width=3%>No</th>
                    <th class="border text-center">Menu</th>
                    <th class="border text-center" width=10%>Table</th>
                    <th class="border text-center" width=10%>Tambah</th>
                    <th class="border text-center" width=10%>Update</th>
                    <th class="border text-center" width=10%>Delete</th>
                    <th class="border text-center" width=10%>Export</th>
                    <th class="border text-center" width=10%>Import</th>
                </x-slot>
            </x-table>
        </x-card>
    </x-modal>
@endsection

<x-swal />
@includeIf('includes.datatable')

@push('scripts')
    <script>
        let modal = '#modal-form';
        let table_role;

        table_role = $('#table-role').DataTable({
            processing: true,
            autoWidth: false,
            serverside: true,
            ajax: {
                url: '{{ route('setup.data') }}',
                type: 'GET',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name',
                    searchable: false,
                    sortable: false,
                    render: function(data, type, row) {
                        if (data == null) {
                            return "Tidak Ada";
                        } else {
                            return data
                        }
                    }
                },
                {
                    data: 'action',
                    render: function(data, type, row) {
                        if (data == null) {
                            return "Tidak Ada";
                        } else {
                            return data
                        }
                    }
                },
            ],
            'columnDefs': [{
                "targets": [0],
                "className": "text-center",
                "width": "4%"
            }],
            "language": {
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "lengthMenu": "Menampilkan _MENU_ data",
                "search": "Cari:",
                "zeroRecords": "Tidak ada data yang sesuai",
                /* Kostum pagination dengan element baru */
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'></i>",
                    "next": "<i class='fas fa-angle-right'></i>"
                }
            },
            "bDestroy": true
        });

        function addForm(url, title) {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
        }

        function editForm(route, title, id_role) {
            // console.log('disini', id_role);
            $(modal).modal('show');

            let table_menu;
            table_menu = $('#table-menu').DataTable({
                processing: true,
                autoWidth: false,
                serverside: true,
                ajax: {
                    url: '{{ route('setup.menu') }}',
                    type: 'POST',
                    'data': {
                        id_role: id_role,
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_sub_menu',
                        searchable: false,
                        sortable: false,
                        render: function(data, type, row) {
                            if (data == null) {
                                return "Tidak Ada";
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'c_select',
                        render: function(data, type, row) {
                            if (data == null) {
                                return "Tidak Ada";
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'c_insert',
                        render: function(data, type, row) {
                            if (data == null) {
                                return "Tidak Ada";
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'c_update',
                        render: function(data, type, row) {
                            if (data == null) {
                                return "Tidak Ada";
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'c_delete',
                        render: function(data, type, row) {
                            if (data == null) {
                                return "Tidak Ada";
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'c_export',
                        render: function(data, type, row) {
                            if (data == null) {
                                return "Tidak Ada";
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'c_import',
                        render: function(data, type, row) {
                            if (data == null) {
                                return "Tidak Ada";
                            } else {
                                return data
                            }
                        }
                    },
                ],
                'columnDefs': [{
                    "targets": [0, 2, 3, 4, 5, 6, 7],
                    "className": "text-center",
                    "width": "4%"
                }],
                "language": {
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "lengthMenu": "Menampilkan _MENU_ data",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada data yang sesuai",
                    /* Kostum pagination dengan element baru */
                    "paginate": {
                        "previous": "<i class='fas fa-angle-left'></i>",
                        "next": "<i class='fas fa-angle-right'></i>"
                    }
                },
                "bDestroy": true
            })

            $(`${modal} .modal-title`).text(title);
            // $(`${modal} form`).attr('action', url);
            // $(`${modal} [name=_method]`).val('put');
        }

        function ceklis(route) {
            // console.log('ceklis pilih', route);
        }
    </script>
@endpush
