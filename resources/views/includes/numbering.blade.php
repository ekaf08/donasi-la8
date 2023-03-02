@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.numbering').inputmask();
        })
        $(document).ready(function() {
            $('#form').submit(function(e) {
                e.preventDefault();
                $(".numbering").inputmask('unmaskedvalue');
                $(".numbering").inputmask({
                    removeMaskOnSubmit: true
                });
            })
        })
    </script>
@endpush
