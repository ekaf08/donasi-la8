@extends('layouts.app')
@section('title', 'Kategori')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                        Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="bg-gradient-indigo">
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th width="25%">Jumlah Projek</th>
                            <th width="15%"><i class="fas fa-cog"></i></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. </td>
                                <td>Pendidikan</td>
                                <td>10</td>
                                <td class="text-center">
                                    <button class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
