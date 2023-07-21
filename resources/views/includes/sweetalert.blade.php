@push('css_vendor')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
@endpush

@push('scripts_vendor')
    <script>
        function showAlert(message, type) {
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                });
                switch (type) {
                    case 'success':
                        Toast.fire({
                            icon: 'success',
                            position: 'center',
                            title: message,
                        })
                        break;
                    case 'gagal':
                        Toast.fire({
                            icon: 'error',
                            position: 'center',
                            title: message,
                        })
                        break;

                    default:
                        break;
                }


            })
        }
    </script>
@endpush
