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
@endpush
