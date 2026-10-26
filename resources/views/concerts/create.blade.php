@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h1>Crear Nou Concert</h1>

        <a href="{{ route('concerts.index') }}">Tornar a la llista</a>

        <form action="{{ route('concerts.store') }}" method="POST" style="margin-top: 20px;">
            @csrf

            <!-- Desplegable d'Artistes Actius -->
            <p>
                <label style="font-weight: bold;">Artista:</label><br>
                <select name="artista_id" style="width: 100%; padding: 8px; margin-top: 5px;">
                    <option value="">-- Selecciona un artista --</option>
                    @foreach ($artistes as $artista)
                        <option value="{{ $artista->id }}" {{ old('artista_id') == $artista->id ? 'selected' : '' }}>
                            {{ $artista->nom }}
                        </option>
                    @endforeach
                </select>
                @error('artista_id')
                <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </p>

            <!-- Desplegable d'Escenaris Actius -->
            <p>
                <label style="font-weight: bold;">Escenari:</label><br>
                <select name="escenari_id" style="width: 100%; padding: 8px; margin-top: 5px;">
                    <option value="">-- Selecciona un escenari --</option>
                    @foreach ($escenaris as $escenari)
                        <option value="{{ $escenari->id }}" {{ old('escenari_id') == $escenari->id ? 'selected' : '' }}>
                            {{ $escenari->nom }}
                        </option>
                    @endforeach
                </select>
                @error('escenari_id')
                <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </p>

            <!-- Camp: Nom del Concert -->
            <p>
                <label style="font-weight: bold;">Nom del concert o gira:</label><br>
                <input type="text" name="nom" value="{{ old('nom') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('nom')
                <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </p>

            <!-- Camp: Data i Hora -->
            <p>
                <label style="font-weight: bold;">Data i hora:</label><br>
                <input type="datetime-local" name="data_hora" value="{{ old('data_hora') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('data_hora')
                <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </p>

            <!-- Camp: Durada -->
            <p>
                <label style="font-weight: bold;">Durada (en minuts):</label><br>
                <input type="number" name="durada_minuts" value="{{ old('durada_minuts') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('durada_minuts')
                <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </p>

            <!-- Desplegable de Tipus (Enum) -->
            <p>
                <label style="font-weight: bold;">Tipus d'esdeveniment:</label><br>
                <select name="tipus" style="width: 100%; padding: 8px; margin-top: 5px;">
                    <option value="">-- Selecciona el tipus --</option>
                    @foreach (['CONCERT', 'DJ_SET', 'SHOWCASE', 'ACUSTIC'] as $t)
                        <option value="{{ $t }}" {{ old('tipus') == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
                @error('tipus')
                <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </p>

            <!-- Botó de Crear -->
            <p style="margin-top: 25px;">
                <button type="submit" style="background: #22c55e; color: white; padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    Crear Concert
                </button>
            </p>
        </form>
    </div>
@endsection
