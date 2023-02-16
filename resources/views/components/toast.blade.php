<!--Toast Alert-->
@push('scripts')
    @if (session()->has('toast-success'))
        <script>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Selamat',
                body: '{{ session('message') }}'
            });

            setTimeout(() => {
                $('.toasts-top-right').remove();
            }, 3000);
        </script>
    @elseif(session()->has('toast-error'))
        <script>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Ooops...',
                body: '{{ session('message') }}'
            });

            setTimeout(() => {
                $('.toasts-top-right').remove();
            }, 3000);
        </script>
    @endif
@endpush
