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
                    <form class="d-flex justify-content-between">
                        <x-dropdown-table />
                        <x-filter-table />
                    </form>
                    <table class="table table-striped" id="data-table">
                        <thead class="bg-gradient-indigo text-center">
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th width="12%">Jumlah Projek</th>
                            <th width="10%">Flag</th>
                            <th width="10%"><i class="fas fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $item)
                                <tr>
                                    <td>
                                        <x-number-table :key="$key" :model="$category" /> .
                                    </td>
                                    <td>{{ $item->name }}</td>
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
                        </tbody>
                    </table>

                    <div class="float-right mt-4">
                        {{ $category->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- <x-toast /> --}}
<x-swal />

@push('scripts')
    <script>
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

                        // .done((response) => {
                        //     var Toast = Swal.mixin({
                        //         toast: true,
                        //         position: 'center',
                        //         showConfirmButton: true,
                        //         timer: 2000
                        //     });

                        //     Toast.fire({
                        //         icon: 'success',
                        //         title: '{{ session('message') }}'
                        //     })
                        //     location.reload();
                        // })

                        .done((response) => {
                            Swal.fire(
                                'Berhasil',
                                'Data Anda Telah Di Hapus',
                                'success'
                            )
                            location.reload();
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
    </script>
@endpush
