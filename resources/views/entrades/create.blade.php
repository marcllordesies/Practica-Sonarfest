@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-lg">
        <h1 class="text-2xl font-bold mb-6">Comprar Entrada</h1>

        @if($errors->has('aforament'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first('aforament') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $concert->nom }}</h2>
            <p class="text-gray-600 mb-1"><strong>Artista:</strong> {{ $concert->artista->nom }}</p>
            <p class="text-gray-600 mb-1"><strong>Escenari:</strong> {{ $concert->escenari->nom }}</p>
            <p class="text-gray-600"><strong>Data i Hora:</strong> {{ $concert->data_hora }}</p>
        </div>

        <form action="{{ route('entrades.store', $concert) }}" method="POST" class="bg-white shadow rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="preu_pagat" class="block text-gray-700 font-medium mb-2">Preu pagat (€)</label>
                <input type="number" step="0.01" name="preu_pagat" id="preu_pagat" required value="25.00" class="w-full border-gray-300 rounded-md shadow-sm p-2 border">
                @error('preu_pagat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" style="background-color: #2563eb; color: white; width: 100%; padding: 12px; font-weight: bold; border: none; border-radius: 6px; cursor: pointer;">
                    Confirmar i Comprar
                </button>
            </div>
        </form>
    </div>
@endsection
