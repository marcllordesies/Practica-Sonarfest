@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 1100px; margin: 0 auto;">
        <h1 style="margin-bottom: 20px;">Llista de Concerts</h1>


        <p style="margin-bottom: 20px;">
            <a href="{{ route('concerts.create') }}" style="background: #2563eb; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;">
                + Nou Concert
            </a>
        </p>


        <form action="{{ route('concerts.index') }}" method="GET" style="background: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; margin-bottom: 25px; display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">


            <div style="flex: 1; min-width: 180px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 0.9em;">Escenari:</label>
                <select name="escenari_id" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #d1d5db;">
                    <option value="">-- Tots els escenaris --</option>
                    @foreach($escenaris as $escenari)
                        <option value="{{ $escenari->id }}" {{ request('escenari_id') == $escenari->id ? 'selected' : '' }}>
                            {{ $escenari->nom }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div style="flex: 1; min-width: 180px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 0.9em;">Gènere:</label>
                <select name="genere_id" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #d1d5db;">
                    <option value="">-- Tots els gèneres --</option>
                    @foreach($generes as $genere)
                        <option value="{{ $genere->id }}" {{ request('genere_id') == $genere->id ? 'selected' : '' }}>
                            {{ $genere->nom }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 0.9em;">Data Inici:</label>
                <input type="date" name="data_inici" value="{{ request('data_inici') }}" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #d1d5db;">
            </div>


            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 0.9em;">Data Fi:</label>
                <input type="date" name="data_fi" value="{{ request('data_fi') }}" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #d1d5db;">
            </div>


            <div>
                <button type="submit" style="background: #4f46e5; color: white; padding: 9px 18px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    Filtrar
                </button>
                <a href="{{ route('concerts.index') }}" style="margin-left: 10px; color: #4b5563; font-size: 0.9em; text-decoration: underline;">
                    Netejar
                </a>
            </div>
        </form>


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
            @forelse($concerts as $concert)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px; font-weight: bold;">{{ $concert->nom }}</td>
                    <td style="padding: 12px;">
                        @if($concert->artista)
                            <a href="{{ route('artistes.show', $concert->artista->id) }}" style="color: #2563eb; text-decoration: underline;">
                                {{ $concert->artista->nom }}
                            </a>
                        @else
                            <span style="color: #9ca3af; font-style: italic;">Sense artista</span>
                        @endif
                    </td>
                    <td style="padding: 12px;">{{ $concert->escenari->nom ?? 'Sense escenari' }}</td>
                    <td style="padding: 12px;">{{ $concert->data_hora?->format('d/m/Y H:i') }}</td>
                    <td style="padding: 12px;">
                        @if($concert->tipus->value === 'CONCERT')
                            <span style="background-color: #dcfce7; color: #16a34a; padding: 4px 8px; border-radius: 12px; font-size: 0.85em;">CONCERT</span>
                        @elseif($concert->tipus->value === 'DJ_SET')
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
            @empty
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center; color: #6b7280; font-style: italic;">
                        No s'ha trobat cap concert amb els filtres seleccionats.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
