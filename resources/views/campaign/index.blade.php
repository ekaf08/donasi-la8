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
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('campaign.store') }}`, 'Tambah Data Projek / Campaign')"
                        class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                        Tambah</button>
                </x-slot>

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
            autowidth: false,
            serverside: true,
            ajax: {
                url: "{{ route('campaign.data') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'path_image',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'short_description'
                },
                {
                    data: 'publish_date'
                },
                {
                    data: 'status'
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
            "bDestroy": true
        });


        function addForm(url, title) {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);

            resetForm(`${modal} form`);
        }

        function editForm(url, title = 'Edit Data') {
            $.get(url).done(response => {
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);

                    resetForm(`${modal} form`);
                })
                .fail(errors => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Mohon maaf !!',
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
        }

        function loopForm(originalForm) {
            for (field in originalForm) {
                if ($(`[name=${file}]`).attr('type') != 'file') {
                    if ($(`[name=${field}]`).hasClass('summernote')) {
                        $(`[name=${field}]`).summernote('code', originalForm[field])
                    }

                    $(`[name=${field}]`).val(originalForm[file]);
                    $('select').trigger('change');
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
