<form action="{{ route('setting.update', encrypt($setting->id)) }}?pills=logo" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('put')

    <x-card>
        <!--Start Gambar Favicon-->
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <strong class="d-block text-center">Favicon</strong>
                <div class="text-center">
                    <img src="{{ url($setting->path_image ?? '../img/user2.png') }}" alt=""
                        class="img-thumbnail preview-path_image" width="200">
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" name="path_image" id="path_image" class="custom-file-input"
                            onchange="preview('.preview-path_image', this.files[0])">
                        <label for="path_image" class="custom-file-label">Pilih gambar</label>
                    </div>
                </div>
            </div>
            <!--End Gambar Favicon-->

            <!--Start Gambar Header-->
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                <strong class="d-block text-center">Header</strong>
                <div class="text-center">
                    <img src="{{ url($setting->path_image_header ?? '../img/user2.png') }}" alt=""
                        class="img-thumbnail preview-path_image_header" width="200">
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="path_image_header" id="path_image_header"
                            onchange="preview('.preview-path_image_header', this.files[0])">
                        <label for="path_image_header" class="custom-file-label">Pilih Gambar</label>
                    </div>
                </div>
            </div>
        </div>
        <!--End Gambar Header-->

        <!--Start Gambar Footer-->
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <strong class="d-block text-center">Footer</strong>
                <div class="text-center">
                    <img class="img-thumbnail preview-path_image_footer"
                        src="{{ url($setting->path_image_footer ?? '../img/user2.png') }}" alt=""
                        width="200">
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" name="path_image_footer" id="path_image_footer" class="custom-file-input"
                            onchange="preview('.preview-path_image_footer', this.files[0])">
                        <label for="path_image_footer" class="custom-file-label">Pilih Gambar</label>
                    </div>
                </div>
            </div>
        </div>
        <!--End Gambar Footer-->

        <x-slot name="footer">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button class="btn btn-primary">Simpan</button>
        </x-slot>
    </x-card>

</form>
@includeIf('includes.datepicker')
<x-swal />
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#phone').inputmask();
        })
    </script>
@endpush
