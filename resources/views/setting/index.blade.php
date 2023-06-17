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
                {{-- Identitas --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if (request('pills') == '') active @endif"
                        href="{{ route('sistem.index') }}">Identitas</a>
                </li>
                {{-- logo --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if (request('pills') == 'logo') active @endif"
                        href="{{ route('sistem.index') }}?pills=logo">logo</a>
                </li>
                {{-- Sosial Media --}}
                <li class="nav-item">
                    <a href="{{ route('sistem.index') }}?pills=sosial-media"
                        class="nav-link @if (request('pills') == 'sosial-media') active @endif">Sosial Media</a>
                </li>
                {{-- Bank --}}
                <li class="nav-item">
                    <a class="nav-link @if (request('pills') == 'bank') active @endif"
                        href="{{ route('sistem.index') }}?pills=bank">Bank</a>
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
                {{-- sosial media --}}
                <div class="tab-pane fade @if (request('pills') == 'sosial-media') show active @endif" id="pills-sosial-media"
                    role="tabpanel" aria-labelledby="pills-sosial-media-tab">
                    @includeIf('setting.sosial_media')
                </div>
                {{-- BANK --}}
                <div class="tab-pane fade @if (request('pills') == 'bank') show active @endif" id="pills-bank"
                    role="tabpanel" aria-labelledby="pills-bank-tab">
                    @includeIf('setting.bank')
                </div>
            </div>
        </div>
    </div>
@endsection

@includeIf('indcludes.summernote')
