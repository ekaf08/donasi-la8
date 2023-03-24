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
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                // ['insert', ['link', 'picture', 'video']],
                ['insert', ['picture', ]],
            ],
            codeviewFilter: false,
            codeviewIframeFilter: true,
            codeviewFilterRegex: 'custom-regex',
            codeviewIframeWhitelistSrc: ['www.youtube.com',
                'www.youtube-nocookie.com',
                'www.facebook.com',
                'vine.co',
                'instagram.com',
                'player.vimeo.com',
                'www.dailymotion.com',
                'player.youku.com',
                'v.qq.com',
            ],

        });
        $('.note-btn-group.note-fontname').remove();
        setTimeout(() => {
            $('.note-btn-group.note-fontname').remove();
            $('.note-btn-group.note-view').remove();
            // $('.note-btn-group.note-insert').remove();


        }, 300);
    </script>
@endpush
