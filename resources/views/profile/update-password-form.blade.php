<form action="{{ route('user-password.update') }}" method="POST">
    @csrf
    @method('put')

    <x-card>

        <div class="row ">
            <div class="col-lg-3">
                <div class="">
                    {{-- <img src="{{  asset('storage' .auth()->user()->path_image ?? '../img/user2.png') }}" alt="" class="img-thumbnail preview-path_image" width="200" height="200"> --}}
                    {{-- <img src="{{ url('storage/'.auth()->user()->path_image ?? 'storage/user/user2.png') }}" alt="" class="img-thumbnail preview-path_image" width="200" height="200"> --}}

                    <img src="
                    @if (auth()->user()->path_image != null) {{ url('storage/' . auth()->user()->path_image) }} @else ../img/user2.png @endif
                    "
                        alt="" class="img-thumbnail preview-path_image" width="200" height="200">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="current_password">Password Aktif</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        name="current_password" id="current_password" value="">
                    @error('current_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" value="">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="password_confirmation" value="">
                    @error('password_confirmation')
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
