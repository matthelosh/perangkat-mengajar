@extends('index')

@section('content')
    @switch($page_title)
        @case('Siswa')
            @include('home.siswaku')
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
        @default
            @include('pages.guru.home')
        @break
    @endswitch
@endsection


