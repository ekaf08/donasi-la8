<form action="{{ route('setting.update', encrypt($setting->id)) }}?pills=bank" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('put')

    <x-card>
        <!--BANK-->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="bank_id">Bank</label>
                    <select name="bank_id" id="bank_id" class="custom-select @error('bank_id') is-invalid @enderror">
                        <option value="" disabled selected>Pilih salah satu</option>
                        @foreach ($bank as $key => $item)
                            <option value="{{ $key }}" {{ old('bank_id') == $key ? 'selected' : '' }}>
                                {{ $item }}</option>
                        @endforeach
                    </select>
                    @error('bank_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <!--End BANK-->

        <!--Nomor Rekening-->
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="account">Nomor Rekening</label>
                    <input type="text" name="account" id="account"
                        class="form-control @error('account') is-invalid @enderror" value="{{ old('account') }}">
                    @error('account')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!--End Nomor Rekenig-->

            <!--Nama-->
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!--End Nama-->
        </div>

        <!--Is Main-->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input  @error('is_main') is-invalid @enderror"
                        id="is_main" name="is_main" value="{{ old('is_main') ?? 1 }}"
                        {{ old('is_main') == 1 ? 'checked' : '' }}>
                    <label for="custom-control-label" for="is_main">Akun Utama ?</label>
                    @error('is_main')
                        <span class="invalid-feedback">{{ $message }} </span>
                    @enderror
                </div>
            </div>
        </div>
        <!--End Is Main-->

        <x-slot name="footer">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button class="btn btn-primary">Simpan</button>
        </x-slot>
    </x-card>

</form>

<x-card>
    <x-slot name='header'>
        <h5 class="card-title">Daftar Bank</h5>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <th width="5%">No</th>
            <th>Nama</th>
            <th>Nomor Rekening</th>
            <th>Bank</th>
            <th width="15%"><i class="fas fa-cog"></i></th>
        </x-slot>

        @foreach ($setting->bank_setting as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $key->pivot->name }}</td>
                <td>{{ $item->pivot->account }} {!! $item->pivot->is_main ? '<small class="text-primary"><i class="fas fa-check-circle"></i></small>' : '' !!}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <form action="{{ route('setting.bank.destroy', ['setting' => $setting->id, 'id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        @method('delete')

                        <button class="btn btn-link text-danger"
                            onclick="return confirm('Yakin ingin menghapus data ?')"><i
                                class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-table>
</x-card>
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
