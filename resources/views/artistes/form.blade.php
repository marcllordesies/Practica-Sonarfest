@extends('layouts.app')

@section('content')
    <div style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h1>{{ isset($artista) ? 'Editar Artista' : 'Crear Nou Artista' }}</h1>

        <a href="{{ route('artistes.index') }}">Tornar</a>

        <form action="{{ isset($artista) ? route('artistes.update', $artista) : route('artistes.store') }}" method="POST" style="margin-top: 20px;">
            @csrf

            @if(isset($artista))
                @method('PUT')
            @endif

            <p>
                <label style="font-weight: bold;">Nom:</label><br>
                <input type="text" name="nom" value="{{ old('nom', $artista->nom ?? '') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('nom') <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span> @enderror
            </p>

            <p>
                <label style="font-weight: bold;">País:</label><br>
                <input type="text" name="pais" value="{{ old('pais', $artista->pais ?? '') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('pais') <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span> @enderror
            </p>

            <p>
                <label style="font-weight: bold;">Biografia:</label><br>
                <textarea name="bio" style="width: 100%; padding: 8px; margin-top: 5px; height: 100px;">{{ old('bio', $artista->bio ?? '') }}</textarea>
                @error('bio') <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span> @enderror
            </p>

            <p>
                <label style="font-weight: bold;">Imatge (URL):</label><br>
                <input type="url" name="imatge_url" value="{{ old('imatge_url', $artista->imatge_url ?? '') }}" style="width: 100%; padding: 8px; margin-top: 5px;">
                @error('imatge_url') <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span> @enderror
            </p>

            <!-- SELECCIÓ DE GÈNERES -->
            <div style="margin-top: 20px;">
                <label style="font-weight: bold;">Gèneres:</label><br>
                <div style="margin-top: 8px; display: flex; flex-wrap: wrap; gap: 15px;">
                    @foreach($generes as $genere)
                        <label style="cursor: pointer; display: inline-flex; align-items: center; font-weight: normal;">
                            <input type="checkbox" name="generes[]" value="{{ $genere->id }}" style="margin-right: 6px;"
                                @checked(isset($artista) && $artista->generes->contains($genere->id))>
                            {{ $genere->nom }}
                        </label>
                    @endforeach
                </div>
                @error('generes') <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span> @enderror
            </div>

            <p style="margin-top: 20px;">
                <input type="hidden" name="actiu" value="0">
                <label style="cursor: pointer; display: inline-flex; align-items: center;">
                    <input type="checkbox" name="actiu" value="1" style="margin-right: 8px;"
                        {{ old('actiu', isset($artista) ? $artista->actiu : true) ? 'checked' : '' }}>
                    <strong>Actiu (Confirmat al festival)</strong>
                </label>
                @error('actiu') <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span> @enderror
            </p>

            <p style="margin-top: 25px;">
                <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    {{ isset($artista) ? 'Actualitzar' : 'Crear' }}
                </button>
            </p>
        </form>
    </div>
@endsection
