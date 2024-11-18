@extends('layouts.app')
@section('content')
<div class="card plofile" >
        <img class="photo" src="{{ asset('img/logo.png') }}" alt="Logo">
    <div class="card-body plof">
        <h5 class="card-title">ユーザー名: {{ Auth::user()->name }}</h5>
        <p class="card-text">アドレス: {{ Auth::user()->email }}</p>
        {{-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> --}}
    </div>
</div>
@endsection
