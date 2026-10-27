@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h1>Fitxa de l'Artista</h1>

        <div style="background: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; margin-top: 20px;">
            <p><strong>Nom:</strong> {{ $artista->nom }}</p>
            <p><strong>País:</strong> {{ $artista->pais }}</p>
            <p><strong>Biografia:</strong> {{ $artista->bio ?? 'Sense biografia' }}</p>

            <p><strong>Imatge:</strong><br>
                @if($artista->imatge_url)
                    <img src="{{ $artista->imatge_url }}" alt="Imatge de {{ $artista->nom }}" style="max-width: 200px; margin-top: 10px; border-radius: 4px;">
                @else
                    <span style="color: #9ca3af; font-style: italic;">Sense imatge</span>
                @endif
            </p>

            <p><strong>Estat:</strong>
                @if($artista->actiu)
                    <span style="background-color: #dcfce7; color: #16a34a; padding: 4px 8px; border-radius: 12px; font-weight: bold;">Actiu</span>
                @else
                    <span style="background-color: #f3f4f6; color: #4b5563; padding: 4px 8px; border-radius: 12px; font-weight: bold;">Inactiu</span>
                @endif
            </p>

            <!-- GÈNERES DE L'ARTISTA -->
            <p style="margin-top: 15px;"><strong>Gèneres Musicals:</strong><br>
                @forelse($artista->generes as $genere)
                    <span style="background-color: #e5e7eb; color: #1f2937; padding: 3px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 500; margin-right: 4px; margin-top: 5px; display: inline-block;">
                        {{ $genere->nom }}
                    </span>
                @empty
                    <span style="color: #9ca3af; font-style: italic; font-size: 0.95em;">Aquest artista no té cap gènere assignat.</span>
                @endforelse
            </p>
        </div>

        <!-- Llista de concerts de l'artista -->
        <div style="margin-top: 30px; background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb;">
            @if ($artista->concerts && $artista->concerts->count() > 0)
                <h3 style="margin-top: 0; color: #1f2937;">Concerts programats</h3>
                <ul style="padding-left: 20px; line-height: 1.6;">
                    @foreach ($artista->concerts as $concert)
                        <li>
                            <strong>{{ $concert->nom }}</strong> —
                            <span style="color: #4b5563;">{{ $concert->data_hora->format('d/m/Y H:i') }}</span>
                            <a href="{{ route('concerts.show', $concert->id) }}" style="color: #2563eb; font-size: 0.9em; margin-left: 10px; text-decoration: underline;">Veure concert</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p style="color: #6b7280; font-style: italic; margin: 0;">Encara no té concerts programats.</p>
            @endif
        </div>

        <!-- Enllaços de navegació -->
        <p style="margin-top: 25px;">
            <a href="{{ route('artistes.index') }}" style="color: #4b5563; text-decoration: underline; margin-right: 20px;">Tornar a la llista</a>
            <a href="{{ route('artistes.edit', $artista) }}" style="background: #d97706; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; font-weight: bold;">Editar Artista</a>
        </p>
    </div>
@endsection
