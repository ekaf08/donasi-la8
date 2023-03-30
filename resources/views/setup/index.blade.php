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

                <x-table>
                    <x-slot name="thead">
                        <th class="border" width=3%>No</th>
                        <th class="border">Role</th>
                        <th class="border text-center" width=10%><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
@endsection

<x-swal />
@includeIf('includes.datatable')

@push('scripts')
    <script>
        let table;
        table = $('.table').DataTable({
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
    </script>
@endpush
