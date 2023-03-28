@extends('layouts.app')

@section('title', 'Detail Profil')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profil</li>
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
                {{-- Profil --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if (request('pills') != 'password') active @endif"
                        href="{{ route('profile.show') }}">Profil</a>
                </li>
                {{-- Password --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if (request('pills') == 'password') active @endif"
                        href="{{ route('profile.show') }}?pills=password">Password</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                {{-- Profil --}}
                <div class="tab-pane fade @if (request('pills') != 'password') show active @endif" id="pills-profil"
                    role="tabpanel" aria-labelledby="pills-profil-tab">
                    @includeIf('profile.update-profile-information-form')
                </div>
                {{-- Password --}}
                <div class="tab-pane fade @if (request('pills') == 'password') show active @endif" id="pills-password"
                    role="tabpanel" aria-labelledby="pills-password-tab">
                    @includeIf('profile.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
