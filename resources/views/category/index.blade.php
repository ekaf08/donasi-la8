@extends('layouts.app')
@section('title', 'Kategori')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                        Tambah</a>
                </x-slot>
                <form class="d-flex justify-content-between">
                    <x-dropdown-table />
                    <x-filter-table />
                </form>
                <x-table>
                    <x-slot name="thead" class="bg-gradient-indigo text-center">
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th width="12%">Jumlah Projek</th>
                        <th width="10%">Flag</th>
                        <th width="10%"><i class="fas fa-cog"></i></th>
                    </x-slot>
                    @foreach ($category as $key => $item)
                        <tr>
                            <td>
                                <x-number-table :key="$key" :model="$category" /> .
                            </td>
                            <td>{{ strip_tags($item->name) }}</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                @if ($item->f_status == 't')
                                    <span class="badge text-link text-success text-bold">Aktif</span>
                                @else
                                    <span class="badge text-link text-danger text-bold">Non Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{-- <form action="{{ route('category.destroy', Crypt::encryptString($item->id)) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete') --}}
                                <a href="{{ route('category.edit', Crypt::encryptString($item->id)) }}"
                                    class="btn btn-link text-info" title="Edit - {{ $item->name }}"><i
                                        class="fas fa-edit"></i> </a>
                                <button class="btn btn-link text-danger" type="button"
                                    onclick="deleteData('{{ route('category.destroy', Crypt::encryptString($item->id)) }}')"
                                    title="Hapus - {{ $item->name }}"><i class="fas fa-trash-alt"></i>
                                </button>
                                {{-- </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </x-table>
                <x-pagination-table :model="$category" />
            </x-card>
        </div>
    </div>
@endsection
{{-- <x-toast /> --}}
<x-swal />
