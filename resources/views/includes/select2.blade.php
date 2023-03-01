@push('css_vendor')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts_vendor')
    <!-- Select2 -->
    <script src="{{ asset('/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Salah Satu ..',
            closeOnSelect: true,
            allowClear: true,
        })
    </script>
@endpush
