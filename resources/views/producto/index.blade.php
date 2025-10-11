@extends('layouts.dashboard') <!-- Si tienes un layout -->

@section('content')
    <div class="container">
        @livewire('productos') 
    </div>
@endsection