<form action="{{ route('user-profile-information.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    <x-card>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center">

                    {{-- <img src="{{  asset('storage' .auth()->user()->path_image ?? '../img/user2.png') }}" alt="" class="img-thumbnail preview-path_image" width="200" height="200"> --}}
                    {{-- <img src="{{ url('storage/'.auth()->user()->path_image ?? '../img/user2.png') }}" alt="" class="img-thumbnail preview-path_image" width="200" height="200"> --}}
                    <img src="
                    @if (auth()->user()->path_image != null) {{ url('storage/' . auth()->user()->path_image) }} @else ../img/user2.png @endif
                    "
                        alt="" class="img-thumbnail preview-path_image" width="200" height="200">
                </div>
                <div class="form-group mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path_image" name="path_image"
                            onchange="preview('.preview-path_image', this.files[0])">
                        <label for="path_image" class="custom-file-label">Pilih Foto</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" value="{{ old('name') ?? auth()->user()->name }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" value="{{ old('email') ?? auth()->user()->email }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="role_id">Role Jabatan</label>
                    <input type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id"
                        id="role_id" value="{{ old('role_id') ?? auth()->user()->role->name }}" disabled>
                    @error('role_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="phone">Telephone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        id="phone"
                        data-inputmask='"mask": "9999-9999-9999","removeMaskOnSubmit": true,"autoUnmask":true' data-mask
                        value="{{ old('phone') ?? auth()->user()->phone }}">
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender"
                        value="{{ old('gender') ?? auth()->user()->gender }}">
                        <option seleceted disabled>Pilih salah satu</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir</label>
                    <div class="input-group datepicker" id="birth_date" data-target-input="nearest">
                        <input type="text" name="birth_date"
                            class="form-control datepicker-input @error('birth_date') is-invalid @enderror"
                            data-target="#birth_date" value="{{ old('birth_date') ?? auth()->user()->birth_date }}" />
                        <div class="input-group-append" data-target="#birth_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @error('birth_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="job">Pekerjaan</label>
                    <input type="text" class="form-control @error('job') is-invalid @enderror" name="job"
                        id="job" value="{{ old('job') ?? auth()->user()->job }}">
                    @error('job')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5" id="address">{{ old('address') ?? auth()->user()->address }}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="about">Tentang Saya</label>
                    <textarea rows="5" class="form-control @error('about') is-invalid @enderror" name="about" id="about">
                        {{ old('about') ?? auth()->user()->about }}
                    </textarea>
                    @error('about')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button class="btn btn-primary">Simpan</button>
        </x-slot>
    </x-card>

</form>
@includeIf('includes.datepicker')
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#phone').inputmask();
        })
    </script>
@endpush
