@extends('layouts.app')

@section('title', 'Setting')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Setting</li>
@endsection

@push('css')
    <style>
        .img-thumbnail {
            /* border-color: #6610F2; */
        }

        .tombol-nav.nav-pills .nav-link.active,
        .tombol-nav.nav-pills .show>.nav-link {
            background: transparent;
            color: var(--dark);
            border-bottom: 3px solid;
            border-bottom-color: #001F3F;
            border-radius: 0;
        }

        .progress-bar {
            background-color: #001F3F;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3 tombol-nav" id="pills-tab" role="tablist">
                {{-- general --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if (request('pills') == '') active @endif"
                        href="{{ route('setting.index') }}">General</a>
                </li>
                {{-- logo --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if (request('pills') == 'logo') active @endif"
                        href="{{ route('setting.index') }}?pills=logo">logo</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                {{-- General --}}
                <div class="tab-pane fade @if (request('pills') == '') show active @endif" id="pills-general"
                    role="tabpanel" aria-labelledby="pills-general-tab">
                    @includeIf('setting.general')
                </div>
                {{-- logo --}}
                <div class="tab-pane fade @if (request('pills') == 'logo') show active @endif" id="pills-logo"
                    role="tabpanel" aria-labelledby="pills-logo-tab">
                    @includeIf('setting.logo')
                </div>
            </div>
        </div>
    </div>
@endsection
