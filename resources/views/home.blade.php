@extends('layouts.app')

@section('content')
<div class="card plofile" >
        <img class="photo" src="{{ asset('img/logo.png') }}" alt="Logo">
    <div class="card-body plof">
        <h5 class="card-title">お名前を取得します:tanaka</h5>
        <p class="card-text">アドレスとか:test2@gmail.com</p>
        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
</div>
@endsection
