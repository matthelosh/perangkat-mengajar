@extends('index')

@section('content')
    @switch($page_title)
        @case('pembelajaran')
            {{ $page_title }}
        @break
        @case('Siswa')
            <h1>Siswa</h1>
        @break
        @default
            @include('pages.guru.home')
        @break
    @endswitch
@endsection


