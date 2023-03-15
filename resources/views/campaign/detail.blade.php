@extends('layouts.app')
@section('title', 'Detail')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('campaign.index') }}">Projek</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name=header>
                    <h3>{{ $campaign->title }}</h3>
                    <p class="font-weight-bold mb-0">Dibuat oleh <span class="text-primary">{{ $campaign->user->name }}</span>
                        <small class="d-block">
                            {{ tanggal_indonesia($campaign->publish_date) }} |
                            {{ date('H:i', strtotime($campaign->publish_date)) }}
                        </small>
                    </p>
                </x-slot>

                {!! $campaign->body !!}
            </x-card>
        </div>

        <!--Start Kategori-->
        <div class="col-lg-4">
            <x-card>
                <x-slot name="header">
                    <h5 class="card-title">Kategori</h5>
                </x-slot>

                <ul>
                    @foreach ($campaign->category_campaign as $item)
                        @dd($item)
                        <li>{{ $item->name }}</li>
                    @endforeach
                </ul>
            </x-card>
            <!--End Kategori-->

            <!--Start Gambar Unggulan-->
            <x-card>
                <x-slot name="header">
                    <h5 class="card-title">Gambar Unggulan</h5>
                </x-slot>
            </x-card>
            <!--End Gambar Unggulan-->

            <!--Start Detail Donasi-->
            <x-card>

            </x-card>
            <!--End Detail Donasi-->
        </div>
    </div>
@endsection
