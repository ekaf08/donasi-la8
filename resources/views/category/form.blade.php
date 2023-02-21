@extends('layouts.app')
@section('title', 'Kategori')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategori</a></li>
    @if (isset($edit_category))
        <li class="breadcrumb-item active">Edit Kategori</li>
    @else
        <li class="breadcrumb-item active">Tambah Kategori</li>
    @endif

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (isset($edit_category))
                <form action="{{ route('category.update', Crypt::encryptString($edit_category->id)) }}" method="post">
                    @method('put')
                @else
                    <form action="{{ route('category.store') }}" method="post">
            @endif
            @csrf
            <x-card>
                <div class="form-group">
                    <label for="name">Nama</label>
                    @if (isset($edit_category))
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $edit_category->name }}" required>
                    @else
                        <input type="text" class="form-control" name="name" id="name" required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="f_status">Flag Status</label>
                    <div class="d-flex flex-row">
                        @if (isset($edit_category))
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="f_status" id="cek_aktif" value="true"
                                    {{ $edit_category->f_status ? 'checked' : '' }} />
                                <label for="cek_aktif" class="mb-0">Aktif</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="f_status" id="non_aktif" value="false"
                                    {{ !$edit_category->f_status ? 'checked' : '' }} />
                                <label for="non_aktif" class="mb-0">Non Aktif</label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="f_status" id="cek_aktif" value="true"
                                    checked />
                                <label for="cek_aktif" class="mb-0">Aktif</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="f_status" id="non_aktif"
                                    value="false" />
                                <label for="non_aktif" class="mb-0">Non Aktif</label>
                            </div>
                        @endif

                    </div>
                </div>
                <x-slot name="footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</button>
                </x-slot>
            </x-card>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
