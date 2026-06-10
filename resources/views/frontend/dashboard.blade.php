@extends('frontend.layouts.app')

@section('content')

    <!-- ==================== TAB 1: BERANDA ==================== -->
    @include('frontend.home.index')

    <!-- ==================== TAB 2: ANTREAN ==================== -->
    @include('frontend.antrean.index')

    <!-- ==================== TAB 2.5: DAFTAR ANTREAN FORM ==================== -->
    @include('frontend.antrean.daftar')

    <!-- ==================== TAB 2.7: DETAIL ANTREAN ==================== -->
    @include('frontend.antrean.detail')

    <!-- ==================== TAB 3: RIWAYAT ==================== -->
    @include('frontend.riwayat.index')

    <!-- ==================== TAB 4: AKUN ==================== -->
    @include('frontend.profil.index')

@endsection
