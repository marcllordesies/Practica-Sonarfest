@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 1000px; margin: 0 auto;">
        <h1>Llista d'Artistes</h1>

        <p>
            <a href="{{ route('artistes.create') }}" style="background: #22c55e; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;">
                + Nou Artista
            </a>
        </p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; text-align: left;">
            <thead>
            <tr style="background-color: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                <th style="padding: 12px;">Nom</th>
                <th style="padding: 12px;">País</th>
                <th style="padding: 12px;">Gèneres</th>
                <th style="padding: 12px;">Actiu</th>
                <th style="padding: 12px;">Accions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($artistes as $artista)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">{{ $artista->nom }}</td>
                    <td style="padding: 12px;">{{ $artista->pais }}</td>
                    <td style="padding: 12px;">
                        @forelse($artista->generes as $genere)
                            <span style="background-color: #e5e7eb; color: #1f2937; padding: 3px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 500; margin-right: 4px; display: inline-block;">
                                {{ $genere->nom }}
                            </span>
                        @empty
                            <span style="color: #9ca3af; font-style: italic; font-size: 0.9em;">Sense gènere</span>
                        @endforelse
                    </td>
                    <td style="padding: 12px;">
                        @if($artista->actiu)
                            <span style="background-color: #dcfce7; color: #16a34a; padding: 4px 8px; border-radius: 12px; font-size: 0.85em; font-weight: bold;">Actiu</span>
                        @else
                            <span style="background-color: #f3f4f6; color: #4b5563; padding: 4px 8px; border-radius: 12px; font-size: 0.85em; font-weight: bold;">Inactiu</span>
                        @endif
                    </td>
                    <td style="padding: 12px;">
                        <a href="{{ route('artistes.show', $artista) }}" style="color: #2563eb; text-decoration: underline; margin-right: 15px;">Veure</a>
                        <a href="{{ route('artistes.edit', $artista) }}" style="color: #d97706; text-decoration: underline;">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
