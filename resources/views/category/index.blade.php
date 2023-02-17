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
                        <thead class="bg-gradient-indigo text-center">
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th width="12%">Jumlah Projek</th>
                            <th width="10%">F Status</th>
                            <th width="10%"><i class="fas fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($category as $item => $key)
                                <tr>
                                    <td>{{ $item + 1 }} .</td>
                                    <td>{{ $key->name }}</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">
                                        @if ($key->f_status == 't')
                                            <span class="badge badge-pill badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('category.edit', Crypt::encryptString($key->id)) }}"
                                            class="btn btn-info" title="Edit - {{ $key->name }}"><i
                                                class="fas fa-edit"></i> </a>
                                        <button class="btn btn-danger" title="Hapus - {{ $key->name }}"><i
                                                class="fas fa-trash-alt"></i> </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- <x-toast /> --}}
<x-swal />
