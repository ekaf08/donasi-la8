@extends('layouts.app')
@section('title', 'Projek')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Projek</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                @foreach ($role->menu as $menu)
                    @foreach ($menu->sub_menu as $sub_menu)
                        @if ($sub_menu->id_sub_menu == 2 && $sub_menu->c_insert == 't')
                            <x-slot name="header">
                                <button onclick="addForm(`{{ route('campaign.store') }}`, 'Tambah Data Projek / Campaign')"
                                    class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                                    Tambah</button>
                            </x-slot>
                        @endif

                        @if ($sub_menu->id_sub_menu == 2 && $sub_menu->c_select == 't')
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <label for="status2">Status</label>
                                    <select name="status2" class="custom-select" id="status2">
                                        <option disabled selected>Pilih salah satu</option>
                                        <option value="publish">Publish</option>
                                        <option value="archived">Diarsipkan</option>
                                        <option value="pending">Pending</option>
                                        <option value="">Semua</option>
                                    </select>
                                </div>
                                <div class="d-flex">
                                    <div class="form-group mx-3">
                                        <label for="start_date2">Tanggal Awal</label>
                                        <div class="input-group datepicker" id="start_date2" data-target-input="nearest">
                                            <input type="text" name="start_date2"
                                                class="form-control datetimepicker-input" data-target="#start_date2" />
                                            <div class="input-group-append" data-target="#start_date2"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date2">Tanggal akhir</label>
                                        <div class="input-group datepicker" id="end_date2" data-target-input="nearest">
                                            <input type="text" name="end_date2" class="form-control datetimepicker-input"
                                                data-target="#end_date2" />
                                            <div class="input-group-append" data-target="#end_date2"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <x-table>
                                <x-slot name="thead">
                                    <th class="border" width=3%>No</th>
                                    <th class="border" width=10%>Gambar</th>
                                    <th class="border" width=30%>Deskripsi</th>
                                    <th class="border" width=10%>Tgl Publish</th>
                                    <th class="border text-center" width=3%>Status</th>
                                    <th class="border text-center" width=3%>Penulis</th>
                                    <th class="border text-center" width=10%><i class="fas fa-cog"></i></th>
                                </x-slot>
                            </x-table>
                        @endif
                    @endforeach
                @endforeach
            </x-card>
        </div>
    </div>

    @includeIf('campaign.form')
@endsection
{{-- <x-toast /> --}}

<x-swal />
@includeIf('includes.datatable')
@includeIf('includes.summernote')
@includeIf('includes.select2')
@includeIf('includes.datepicker')
@includeIf('includes.numbering')
{{-- @includeIf('includes.filepond') --}}

@push('scripts')
    <script>
        let modal = '#modal-form';
        let table;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            serverside: true,
            ajax: {
                url: '{{ route('campaign.data') }}',
                type: 'GET',
                data: function(d) {
                    d.filter_status = $('[name=status2]').val();
                    d.filter_start_date = $('[name=start_date2]').val();
                    d.filter_end_date = $('[name=end_date2]').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'path_image',
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
                    data: 'short_description',
                    render: function(data, type, row) {
                        if (data == null) {
                            return "Tidak Ada";
                        } else {
                            return data
                        }
                    }
                },
                {
                    data: 'publish_date',
                    render: function(data, type, row) {
                        if (data == null) {
                            return "Tidak Ada";
                        } else {
                            return data
                        }
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        if (data == null) {
                            return "Tidak Ada";
                        } else {
                            return data
                        }
                    }
                },
                {
                    data: 'author'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ],
            'columnDefs': [{
                "targets": [0, 4, 5],
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


        $('[name=status2]').on('change', function() {
            table.ajax.reload();
        });

        $('.datepicker').on('change.datetimepicker', function() {
            table.ajax.reload();
        })

        function addForm(url, title) {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);

            resetForm(`${modal} form`);
        }

        function editForm(url, title) {
            $.get(url).done(response => {
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('put');

                    resetForm(`${modal} form`);
                    loopForm(response.data);
                    // $(`[name=receiver]`).filter(`[value="${response.data.receiver}"]`).prop('checked', true);

                    let selectedCategories = [];
                    response.data.categories.forEach(item => {
                        selectedCategories.push(item.id);
                    });
                    $('#categories').val(selectedCategories).trigger('change');
                })
                .fail(errors => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Mohon maaf !!...',
                        text: 'Data tidak dapat di tampilkan',
                        // footer: '<a href="">Why do I have this issue?</a>'
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
                    table.ajax.reload();
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
                    // showAlert(errors.responseJSON.message, 'danger');
                    Swal.fire({
                        icon: 'error',
                        title: 'Mohon maaf ..',
                        text: 'Data gagal disimpan !!',
                        // footer: '<a href="">Why do I have this issue?</a>'
                    })
                });
        }

        function deleteData(url) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Menghapus Data Ini ?",
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
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            Swal.fire(
                                'Oops',
                                'Data Gagal Di Hapus',
                                'error'
                            )
                            return;
                        })
                }
            })
        }

        // script helper
        function resetForm(selector) {
            $(selector)[0].reset();
            $('.select2').trigger('change');
            $(`[name=body]`).summernote('code', '');
            $('.form-control, .custom-select, [type=radio], [type=checkbox], [type=file], .custom-radio, .select2, .note-editor')
                .removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $(`.preview-path_image`).attr('src', '').hide();
        }

        function loopForm(originalForm) {
            for (field in originalForm) {
                if ($(`[name=${field}]`).attr('type') != 'file') {
                    if ($(`[name=${field}]`).hasClass('summernote')) {
                        $(`[name=${field}]`).summernote('code', originalForm[field])
                    } else if ($(`[name=${field}]`).attr('type') == 'radio') {
                        $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true);
                    } else {
                        $(`[name=${field}]`).val(originalForm[field]);
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
                    timer: 2000
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

            /* 
            48-57 - (0-9)Numbers
            65-90 - (A-Z)
            97-122 - (a-z)
            8 - (backspace)
            32 - (space)
            */
            // Not allow special 
            if (!((keyCode >= 48 && keyCode <= 57) ||
                    (keyCode >= 65 && keyCode <= 90) ||
                    (keyCode >= 97 && keyCode <= 122)) &&
                keyCode != 8 && keyCode != 32) {
                event.preventDefault();
            }
        });
    </script>
@endpush
