@extends('layouts.app')
@section('content')
<div id="app"></div>
@endsection
@section('spa')
    @vite(['resources/js/app.js'])
@endsection
