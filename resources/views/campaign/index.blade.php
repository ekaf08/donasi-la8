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
                    <button onclick="addForm(`{{ route('campaign.store') }}`)" class="btn btn-primary"><i
                            class="fas fa-plus-circle"></i>
                        Tambah</button>
                </x-slot>
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <label for="status2">Status</label>
                        <select name="status2" id="status2" class="custom-select">
                            <option disabled selected>Pilih salah satu ...</option>
                            <option value="publish">Publish</option>
                            <option value="pending">Pending</option>
                            <option value="archived">Diarsipkan</option>
                        </select>
                    </div>

                    <div class="d-flex">
                        <div class="form-group mx-3">
                            <label for="start_date2">Tanggal Awal</label>
                            <div class="input-group datepicker" id="start_date2" data-target-input="nearest">
                                <input type="text" name="start_date2" class="form-control datetimepicker-input"
                                    data-target="#start_date2" />
                                <div class="input-group-append" data-target="#start_date2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end_date2">Tanggal Akhir</label>
                            <div class="input-group datepicker" id="end_date2" data-target-input="nearest">
                                <input type="text" name="end_date2" class="form-control datetimepicker-input"
                                    data-target="#end_date2" />
                                <div class="input-group-append" data-target="#end_date2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-table>
                    <x-slot name="thead">
                        <th class="border" width=5%>No</th>
                        <th class="border" width=1%>Gambar</th>
                        <th class="border" width=30%>Deskripsi</th>
                        <th class="border" width=10%>Tgl Publish</th>
                        <th class="border text-center" width=3%>Status</th>
                        <th class="border text-center" width=10%>Penulis</th>
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
@includeIf('includes.filepond')

@push('scripts')
    <script>
        let modal = '#modal-form';

        function addForm(url, title = null) {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title ?? 'Tambah Data');
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
                    if (errors.status == 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    // showAlert(errors.responseJSON.message, 'danger');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Mohon maaf !!',
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
                            Swal.fire(
                                'Berhasil',
                                'Data Anda Telah Di Hapus',
                                'success'
                            )
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
            $('.form-control, .custom-select, .custom-checkbox, .custom-radio, .select2').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
    </script>
@endpush
