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
                    <table class="table table-striped" id="data-table">
                        <thead class="bg-gradient-indigo text-center">
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th width="12%">Jumlah Projek</th>
                            <th width="10%">Flag</th>
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
<<<<<<< HEAD
                                            <a href="{{ route('category.edit', Crypt::encryptString($key->id)) }}"
                                                class="btn btn-info" title="Edit - {{ $key->name }}"><i
                                                    class="fas fa-edit"></i> </a>
                                            <button class="btn btn-danger" onclick="deleteData('{{ route('category.destroy', Crypt::encryptString($key->id)) }}')" title="Hapus -  $key->name  }}"><i
                                                    class="fas fa-trash-alt"></i> </button>
=======
                                        <form action="{{ route('category.destroy', Crypt::encryptString($key->id)) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('category.edit', Crypt::encryptString($key->id)) }}"
                                                class="btn btn-info" title="Edit - {{ $key->name }}"><i
                                                    class="fas fa-edit"></i> </a>
                                            <button class="btn btn-danger" type="button"
                                                onclick="deleteData('{{ route('category.destroy', Crypt::encryptString($key->id)) }}')"
                                                title="Hapus - {{ $key->name }}"><i class="fas fa-trash-alt"></i>
                                            </button>
>>>>>>> b7e66be1088436b177d54c79a9077d5377cff11e
                                        </form>
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
<<<<<<< HEAD
@push('scripts')
<script>
    function deleteData(url) {
                Swal.fire({
=======

@push('scripts')
    <script>
        function deleteData(url) {
            Swal.fire({
>>>>>>> b7e66be1088436b177d54c79a9077d5377cff11e
                title: 'Yakin ?',
                text: "Menghapus Data Ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
<<<<<<< HEAD
                cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response)=> {
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
=======
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
>>>>>>> b7e66be1088436b177d54c79a9077d5377cff11e
