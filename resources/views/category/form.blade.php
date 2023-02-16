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
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        @if (isset($edit_category))
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $edit_category->name }}" required>
                        @else
                            <input type="text" class="form-control" name="name" id="name" required>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Reset</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
