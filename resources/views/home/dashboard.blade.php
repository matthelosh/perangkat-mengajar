@extends('index')

@section('content')
    @switch($page_title)
        @case('Siswa')
            @include('home.siswa')
        @break
        @case('Nilai')
            @include('home.nilai')
        @break
        @case('Rombel')
            @include('home.rombel')
        @break
        @case('Kompetensi')
            @include('home.kompetensi')
        @break
        @case('Pemetaan KD')
            @include('home.pemetaan')
        @break
        @case('Kaldik')
            @include('home.kaldik')
        @break
        @case('Entri Nilai')
            @include('home.entri-nilai')
        @break
        @case('Entri Nilai Ekskul')
            @include('home.entri-nilai-ekskul')
        @break
        @case('Rapor')
            @include('home.rapor')
        @break
        @case('Pengguna')
            @include('home.pengguna')
        @break
        @case('Sekolah')
            @include('home.sekolah')
        @break
        @case('Siswaku')
            @include('home.siswaku')
        @break
        @case('Rapor')
            @include('home.rapor')
        @break
        @case('Cetak Rapor')
            @include('home.cetak_rapor')
        @break
        @default
            @include('pages.guru.home')
        @break
    @endswitch
@endsection


