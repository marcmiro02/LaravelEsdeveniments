@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Entrada generada para {{ $esdeveniment->nom }}</h1>

    <p><strong>Código QR:</strong></p>
    <img src="data:image/png;base64,{{ $qr->dibuix_qr }}" alt="Código QR">

    <p><strong>Código:</strong> {{ $qr->codi_qr }}</p>
    <p><strong>Fecha de generación:</strong> {{ $qr->data_generacio }}</p>
    <p><strong>Fecha de expiración:</strong> {{ $qr->data_expiracio }}</p>
</div>
@endsection
