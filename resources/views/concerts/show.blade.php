@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h1>Detalls del Concert</h1>

        <a href="{{ route('concerts.index') }}" style="color: #4b5563; text-decoration: underline;">Tornar a la llista</a>

        <!-- Secció: Camps del concert -->
        <div style="background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; margin-top: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0; color: #1f2937;">{{ $concert->nom }}</h2>
            <p><strong>Data i hora:</strong> {{ $concert->data_hora->format('d/m/Y \a les H:i\h') }}</p>
            <p><strong>Durada:</strong> {{ $concert->durada_minuts }} minuts</p>
            <p><strong>Tipus d'esdeveniment:</strong> {{ $concert->tipus->value }}</p>
        </div>

        <!-- Secció: Informació de l'Artista relacionat -->
        <div style="background: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; margin-top: 20px;">
            <h3 style="margin-top: 0; color: #374151;">Informació de l'Artista</h3>
            @if($concert->artista)
                <p><strong>Nom:</strong>
                    <a href="{{ route('artistes.show', $concert->artista) }}" style="color: #2563eb; text-decoration: underline; font-weight: bold;">
                        {{ $concert->artista->nom }}
                    </a>
                </p>
                <p><strong>País:</strong> {{ $concert->artista->pais }}</p>
                <p><strong>Bio:</strong> {{ $concert->artista->bio }}</p>
            @else
                <p style="color: #9ca3af; font-style: italic;">Aquest concert no té cap artista assignat.</p>
            @endif
        </div>

        <!-- Secció: Informació del Concert relacionat -->
        <div style="background: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; margin-top: 20px;">
            <h3 style="margin-top: 0; color: #374151;">Informació del escenari</h3>
            @if($concert->escenari)
                <p><strong>Nom:</strong>
                        {{ $concert->escenari->nom }}
                </p>
                <p><strong>Aforament:</strong> {{ $concert->escenari->aforament_maxim }}</p>
            @else
                <p style="color: #9ca3af; font-style: italic;">Aquest concert no té cap escenari assignat.</p>
            @endif
        </div>
    </div>
@endsection
