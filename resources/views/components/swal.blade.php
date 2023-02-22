@push('scripts')
    @if (session()->has('success'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('message') }}'
                })
            })
        </script>
    @elseif(session()->has('errors'))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 2000
                });

                Toast.fire({
                    icon: 'error',
                    title: '{{ session('message') }}'
                })
            })
        </script>
    @endif

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
