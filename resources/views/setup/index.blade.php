@extends('layouts.app')
@section('title', 'Aplikasi Management')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Setup</li>
@endsection

@push('css')
    <style>
        .img-thumbnail {
            /* border-color: #6610F2; */
        }

        .tombol-nav.nav-pills .nav-link.active,
        .tombol-nav.nav-pills .show>.nav-link {
            background: transparent;
            color: var(--dark);
            border-bottom: 3px solid;
            border-bottom-color: #001F3F;
            border-radius: 0;
        }

        .progress-bar {
            background-color: #001F3F;
        }
    </style>
@endpush

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
                        <th class="border text-center" width=15%><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    <!-- Modal untuk form menu setup -->
    <x-modal size='modal-xl'>
        <x-slot name="title"></x-slot>
        @method('post')

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group" id="tambahRole">
                    <label for="title">Role</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <input type="text" class="form-control" name="master" id="master" hidden>
                    <input type="text" class="form-control" name="referensi" id="referensi" hidden>
                    <input type="text" class="form-control" name="informasi" id="informasi" hidden>
                    <input type="text" class="form-control" name="report" id="report" hidden>
                    <input type="text" class="form-control" name="aktivitas" id="aktivitas" hidden>
                    <input type="text" class="form-control" name="pengaturan" id="pengaturan" hidden>
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismis="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
            </div>
        </x-slot>

        <ul class="nav nav-pills mb-3 tombol-nav" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link @if (request('pills') != 'submenu') active @endif" id="pills-menu-tab" data-toggle="pill"
                    data-target="#pills-menu" type="button" role="tab" aria-controls="pills-menu"
                    aria-selected="true">Menu</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link @if (request('pills') == 'submenu') active @endif" id="pills-submenu-tab"
                    data-toggle="pill" data-target="#pills-submenu" type="button" role="tab"
                    aria-controls="pills-submenu" aria-selected="false">Sub Menu</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show @if (request('pills') != 'password') active @endif" id="pills-menu" role="tabpanel"
                aria-labelledby="pills-menu-tab">
                <x-card>
                    <x-table id="table-menu">
                        <x-slot name="thead">
                            <th class="border text-center" width=3%>No</th>
                            <th class="border text-center">Menu</th>
                            <th class="border text-center" width=10%>Tampil</th>
                            {{-- <th class="border text-center" width=10%>Tambah</th>
                            <th class="border text-center" width=10%>Update</th>
                            <th class="border text-center" width=10%>Delete</th>
                            <th class="border text-center" width=10%>Export</th>
                            <th class="border text-center" width=10%>Import</th> --}}
                            {{-- <th class="border text-center" width=10%><i class="fas fa-cog"></th> --}}
                        </x-slot>
                    </x-table>
                </x-card>
            </div>
            <div class="tab-pane fade" id="pills-submenu" role="tabpanel" aria-labelledby="pills-submenu-tab">
                <x-card>
                    <x-table id="table-subMenu">
                        <x-slot name="thead">
                            <th class="border text-center" width=3%>No</th>
                            <th class="border text-center">Sub Menu</th>
                            <th class="border text-center" width=10%>Table</th>
                            <th class="border text-center" width=10%>Tambah</th>
                            <th class="border text-center" width=10%>Update</th>
                            <th class="border text-center" width=10%>Delete</th>
                            <th class="border text-center" width=10%>Export</th>
                            <th class="border text-center" width=10%>Import</th>
                            <th class="border text-center" width=10%><i class="fas fa-cog"></th>
                        </x-slot>
                    </x-table>
                </x-card>
            </div>
        </div>
    </x-modal>
@endsection

{{-- <x-swal /> --}}
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
            resetForm(`${modal} form`);
            $(modal).modal('show');
            $('.modal-footer').show();
            $('#tambahRole').show();
            $("#table-subMenu").hide();
            $("#table-subMenu_wrapper").hide();
            $('#pills-tab').hide();
            $('#pills-tabContent').hide()

            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('post');

            $(`${modal} [name=master]`).val('Master');
            $(`${modal} [name=referensi]`).val('Referensi');
            $(`${modal} [name=informasi]`).val('Informasi');
            $(`${modal} [name=report]`).val('Report');
            $(`${modal} [name=aktivitas]`).val('Aktivitas');
            $(`${modal} [name=pengaturan]`).val('Pengaturan');
        }

        function editForm(route, title, id_role) {
            // console.log(id_role);
            $(modal).modal('show');
            $('.modal-footer').hide();
            $('#tambahRole').hide();
            $('#pills-tab').show();
            $('#pills-tabContent').show()
            $('#table-subMenu').show();

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
                        data: 'nama_menu',
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
                    // {
                    //     data: 'action',
                    //     render: function(data, type, row) {
                    //         if (data == null) {
                    //             return "Tidak Ada";
                    //         } else {
                    //             return data
                    //         }
                    //     }
                    // },
                ],
                'columnDefs': [{
                    "targets": [0, 2],
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

            let table_subMenu;
            table_subMenu = $('#table-subMenu').DataTable({
                processing: true,
                autoWidth: false,
                serverside: true,
                ajax: {
                    url: '{{ route('setup.subMenu') }}',
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
                    "targets": [0, 2, 3, 4, 5, 6, 7, 8],
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
            $(`${modal} form`).attr('action', route);
            $(`${modal} [name=_method]`).val('put');
            $.get(route).done(response => {
                    resetForm(`${modal} form`);
                    loopForm(response.data);
                    // console.log(loopForm(response.data));
                })
                .fail(errors => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Mohon maaf !!...',
                        text: 'Data tidak dapat di tampilkan',
                    })
                });

        }

        function submitForm(originalForm) {
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    showAlert(response.message, 'success');
                    table_role.ajax.reload();
                })
                .fail(errors => {
                    // console.log(errors.responseJSON.errors);
                    // return;
                    if (errors.status == 422) {
                        gagal();
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Mohon maaf ..',
                        text: 'Data gagal disimpan !!',
                    })
                });
        }

        function resetForm(selector) {
            $(selector)[0].reset();
            $('.form-control')
                .removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }

        function loopForm(originalForm) {
            // console.log(originalForm);
            for (field in originalForm) {
                if ($(`[name=${field}]`).attr('type') != 'file') {
                    if ($(`[name=${field}]`).hasClass('summernote')) {
                        $(`[name=${field}]`).summernote('code', originalForm[field])
                    } else if ($(`[name=${field}]`).attr('type') == 'radio') {
                        $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true);
                    } else {
                        $(`[name=${field}]`).val(originalForm[field]);
                        // console.log($(`[name=${field}]`).val(originalForm[field]));
                    }
                    $('select').trigger('change');
                } else {
                    $(`.preview-${field}`).attr('src', '/storage/' +
                        originalForm[field]).show();
                }
            }
        }

        function loopErrors(errors, message = true) {
            $('.invalid-feedback').remove();

            if (errors == undefined) {
                return;
            }

            for (error in errors) {
                $(`[name=${error}]`).addClass('is-invalid');

                if ($(`[name=${error}]`).hasClass('select2')) {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                } else if ($(`[name=${error}]`).hasClass('summernote')) {
                    $('.note-editor').addClass('is-invalid');
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                } else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                } else {
                    if ($(`[name=${error}]`).length == 0) {
                        $(`[name="${error}[]"]`).addClass('is-invalid');
                        $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                            .insertAfter($(`[name="${error}[]"]`).next());
                    } else {
                        $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                            .insertAfter($(`[name=${error}]`));
                    }
                }
            }
        }

        function showAlert(message, type) {
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 1000
                });
                switch (type) {
                    case 'success':
                        Toast.fire({
                            icon: 'success',
                            title: message
                        })
                        break;
                    case 'error':
                        Toast.fire({
                            icon: 'error',
                            title: message
                        })
                        break;

                    default:
                        break;
                }


            })
        }

        function gagal() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mohon maaf telah terjadi kesalahan.',
                showConfirmButton: false,
                timer: 1000
            })
        }

        function deleteData(url, judul) {
            console.log(url, judul);
            Swal.fire({
                title: 'Yakin ?',
                text: "Menghapus " + judul + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            '_token': $('[name=csrf-token]').attr('content'),
                            '_method': 'delete'
                        })
                        .done((response) => {
                            showAlert(response.message, 'success');
                            $(modal).modal('hide');
                            table_role.ajax.reload();
                        })
                        .fail((errors) => {
                            gagal();
                            return;
                        })
                }
            })
        }

        $('.form-control').keypress(function(event) {
            var keyCode = event.which;
            if (!((keyCode >= 48 && keyCode <= 57) ||
                    (keyCode >= 65 && keyCode <= 90) ||
                    (keyCode >= 97 && keyCode <= 122)) &&
                keyCode != 8 && keyCode != 32) {
                event.preventDefault();
            }
        });

        $('#table-subMenu').on('change', 'input[type="checkbox"]', function(e) {
            var id = $(this).data('id');
            var kolom = $(this).data('kolom')

            if ($(this).is(":checked")) {
                // var value = $('#is_active').is(':checked') === true;
                var value = 'true'
            } else {
                // var value = $('#is_active').is(':checked') === false;
                var value = 'false'
            }

            $.ajax({
                url: "{{ route('setup.configMenu') }}",
                method: 'POST',
                data: {
                    // data yang ingin dikirim ke server
                    id: id,
                    kolom: kolom,
                    value: value,
                    _token: $('[name=csrf-token]').attr('content'),
                },
                success: function(response) {
                    showAlert(response.message, 'success');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    gagal();
                }
            });
        });

        $('#table-menu').on('change', 'input[type="checkbox"]', function(e) {
            var id = $(this).data('id');
            var kolom = $(this).data('kolom')

            console.log('TABEL MENU', id, kolom);
        })
    </script>
@endpush
