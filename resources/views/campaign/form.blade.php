<x-modal size='modal-xl'>
    <x-slot name="title">JUDUL MODAL</x-slot>
    @method('post')
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="categories">Kategori</label>
                <select name="categories[]" id="categories" class="select2" multiple>
                    @foreach ($category as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="short_description">Deskripsi Singkat</label>
        <textarea name="short_description" id="short_description" rows="4" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="body">Isi Konten</label>
        <textarea name="body" id="body" rows="4" class="form-control summernote"></textarea>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="publish_date">Tanggal Publish</label>
                <div class="input-group datetimepicker" id="publish_date" data-target-input="nearest">
                    <input type="text" name="publish_date" class="form-control datetimepicker-input"
                        data-target="#publish_date" />
                    <div class="input-group-append" data-target="#publish_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="custom-select" id="status">
                    <option disabled selected>Pilih salah satu</option>
                    <option value="publish">Publish</option>
                    <option value="archived">Diarsipkan</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="goal">Sasaran</label>
                <input type="text" name="goal" class="form-control text-left numbering" id="goal"
                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                    data-inputmask="'alias': 'numeric','digits': 2,'groupSeparator': ',','removeMaskOnSubmit':true,'autoUnmask':true"
                    data-mask>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="end_date">Tanggal Selesai</label>
                <div class="input-group datetimepicker" id="end_date" data-target-input="nearest">
                    <input type="text" name="end_date" class="form-control datetimepicker-input"
                        data-target="#end_date" />
                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="note">Catatan singkat untuk berdonasi</label>
        <textarea type="text" rows="3" name="note" class="form-control" id="note"></textarea>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="receiver" class="mr-2">Penerima : </label>
                <div class="custom-control custom-radio">
                    <input type="radio" name="receiver" class="custom-control-input" id="pribadi" value="pribadi">
                    <label class="custom-control-label font-weight-normal" for="pribadi">Pribadi</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" name="receiver" class="custom-control-input" id="keluarga"
                        value="keluarga">
                    <label class="custom-control-label font-weight-normal" for="keluarga">Kelurga</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" name="receiver" class="custom-control-input" id="organisasi"
                        value="organisasi">
                    <label class="custom-control-label font-weight-normal" for="organisasi">Organisasi</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" name="receiver" class="custom-control-input" id="lainnya"
                        value="lainnya">
                    <label class="custom-control-label font-weight-normal" for="lainnya">Lainnya</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="path_image">Gambar</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="path_image" id="path_image"
                        onchange="preview('.preview-path_image', this.files[0])">
                    <label class="custom-file-label" for="path_image">Pilih Gambar</label>
                </div>
            </div>
            <img src="" alt="" class="img-thumbnail img-fluid preview-path_image" max-width: 50%;
                style="display: none;">
        </div>
    </div>
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
    </x-slot>
</x-modal>
