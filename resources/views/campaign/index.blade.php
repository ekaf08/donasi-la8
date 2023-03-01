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

    <x-modal size='modal-xl'>
        <x-slot name="title">Tambah Projek</x-slot>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="categories">Kategori</label>
                    <select name="categories" id="categories" class="form-control select2">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="short_description">Deskripsi Singkat</label>
            <textarea name="short_description" id="short_description" rows="4" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="body">Isi Konten</label>
            <textarea name="body" id="body" rows="4" class="form-control summernote"></textarea>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tanggal Publish</label>
                    <div class="input-group datetimepicker" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="publish_date" class="form-control datetimepicker-input"
                            data-target="#datetimepicker1" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6"></div>
        </div>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button class="btn btn-primary">Simpan</button>
        </x-slot>
    </x-modal>
@endsection
{{-- <x-toast /> --}}

<x-swal />
@includeIf('includes.datatable')
@includeIf('includes.summernote')
@includeIf('includes.select2')
@includeIf('includes.datepicker')

@push('scripts')
    <script>
        function addForm(url, title = 'judul 123') {
            $('#modal-form').modal('show');
        }
    </script>
@endpush
