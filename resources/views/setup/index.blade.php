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

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="title">Role</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>
        </div>

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
        <x-slot name="footer">
            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismis="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
            </div>
        </x-slot>

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
            $("#table-menu").hide();
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            resetForm(`${modal} form`);
        }

        function editForm(route, title, id_role) {
            // console.log(id_role);
            $(modal).modal('show');
            $('#table-menu').show();

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
                    $(modal).modal(hide);
                    showAlert(response.message, 'success');
                    table_role.ajax.reload();
                })
                .fail(errors => {
                    // console.log(errors.responseJSON.errors);
                    // return;
                    if (errors.status == 422) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Mohon maaf ..',
                            text: 'Data gagal disimpan !!',
                            footer: 'Silahkan cek isian anda'
                        })
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

        $('.form-control').keypress(function(event) {
            var keyCode = event.which;
            if (!((keyCode >= 48 && keyCode <= 57) ||
                    (keyCode >= 65 && keyCode <= 90) ||
                    (keyCode >= 97 && keyCode <= 122)) &&
                keyCode != 8 && keyCode != 32) {
                event.preventDefault();
            }
        });

        function ceklis(id, kolom) {
            console.log('ceklis pilih', id, kolom, );

            var check = $('#is_active').prop('checked');
            if ($('#is_active').is(':checked')) {
                console.log('Checkbox tidak di-check!');
                var check = $('#is_active').is(':checked') === false;
                // Lakukan sesuatu jika checkbox tidak di-check
            }
            var check = $('#is_active').is(':checked') === true;
            console.log('ceklis pilih', id, kolom, check, );

            $.ajax({
                url: "{{ route('setup.configMenu') }}",
                method: 'POST',
                data: {
                    // data yang ingin dikirim ke server
                    id: id,
                    kolom: kolom,
                    check: check,
                    _token: $('[name=csrf-token]').attr('content'),
                },
                success: function(response) {
                    showAlert(response.message, 'success');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // kode yang dijalankan jika request gagal
                }
            });
        }
    </script>
@endpush
