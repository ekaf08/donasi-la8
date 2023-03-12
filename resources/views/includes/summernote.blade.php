@push('css_vendor')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('scripts_vendor')
    <!-- summernote -->
    <script src="{{ asset('/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $('.summernote').summernote({
            fontNames: [''],
            height: 300,

        });
        $('.note-btn-group.note-fontname').remove();
        setTimeout(() => {
            $('.note-btn-group.note-fontname').remove();
            $('.note-btn-group.note-view').remove();
            $('.note-btn-group.note-insert').remove();

        }, 300);
    </script>
@endpush
