@extends('dashboard')

@section('content')
  <div class="mdc-card info-card info-card--success">
    <div class="card-inner">
      <h5 class="card-title">{{ Auth::user()->nama_siswa }}</h5>
      <h5 class="font-weight-light pb-2 mb-1 border-bottom">{{ Auth::user()->nis }} / {{ Auth::user()->nisn }}</h5>
      <p class="tx-12 text-muted">{{ Auth::user()->rombel_id}}</p>
      <div class="card-icon-wrapper">
        <i class="material-icons">dvr</i>
      </div>
    </div>
  </div>
@endsection
