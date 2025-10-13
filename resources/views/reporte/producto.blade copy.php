@extends('layouts.dashboard')

@section('content')
    <h2>Reporte de Ventas</h2>
    
    {{-- Aquí insertas el componente Livewire --}}
    @livewire('reporte-ventas')
@endsection