@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 1000px; margin: 0 auto;">
        <h1>Llista de Concerts</h1>

        <!-- Botó Nou Concert -->
        <p>
            <a href="{{ route('concerts.create') }}" style="background: #2563eb; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;">
                + Nou Concert
            </a>
        </p>

        <!-- Taula de concerts -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; text-align: left;">
            <thead>
            <tr style="background-color: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                <th style="padding: 12px;">Nom</th>
                <th style="padding: 12px;">Artista</th>
                <th style="padding: 12px;">Escenari</th>
                <th style="padding: 12px;">Data i hora</th>
                <th style="padding: 12px;">Tipus</th>
                <th style="padding: 12px;">Durada</th>
                <th style="padding: 12px;">Accions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($concerts as $concert)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    {{-- Línia 30: El nom del concert --}}
                    <td style="padding: 12px; font-weight: bold;">{{ $concert->nom }}</td>

                    {{-- Línies 32-41: El bloc de l'artista --}}
                    <td style="padding: 12px;">
                        @if($concert->artista)
                            <a href="{{ route('artistes.show', $concert->artista->id) }}" style="color: #2563eb; text-decoration: underline;">
                                {{ $concert->artista->nom }}
                            </a>
                        @else
                            <span style="color: #9ca3af; font-style: italic;">Sense artista</span>
                        @endif
                    </td>

                    {{-- Línia 42: L'escenari --}}
                    <td>{{ $concert->escenari->nom ?? 'Sense escenari' }}</td>

                    {{-- Línia 43: La data --}}
                    <td style="padding: 12px;">{{ $concert->data_hora?->format('d/m/Y H:i') }}</td>

                    {{-- Línies 45 en davant: El bloc dels enums (Tipus) --}}
                    <td style="padding: 12px;">
                        @if($concert->tipus->value === 'CONCERT')
                            <span style="background-color: #dcfce7; color: #16a34a; padding: 4px 8px; border-radius: 12px; font-size: 0.85em;">CONCERT</span>
                        @elseif($concert->tipus->value === 'DJ SET')
                            <span style="background-color: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 12px; font-size: 0.85em;">DJ SET</span>
                        @elseif($concert->tipus->value === 'SHOWCASE')
                            <span style="background-color: #fef3c7; color: #b45309; padding: 4px 8px; border-radius: 12px; font-size: 0.85em;">SHOWCASE</span>
                        @elseif($concert->tipus->value === 'ACUSTIC')
                            <span style="background-color: #f3e8ff; color: #6b21a8; padding: 4px 8px; border-radius: 12px; font-size: 0.85em;">ACÚSTIC</span>
                        @endif
                    </td>
                    <td style="padding: 12px;">{{ $concert->durada_minuts }} minuts</td>
                    <td style="padding: 12px;">
                        <a href="{{ route('concerts.show', $concert->id) }}" style="color: #4b5563; text-decoration: underline;">Veure detall</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
