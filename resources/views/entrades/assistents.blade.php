@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">{{ $concert->nom }}</h1>
            <p class="text-gray-600">Escenari: {{ $concert->escenari->nom }} (Aforament màxim: {{ $concert->escenari->aforament_maxim }})</p>

            <div class="mt-3 flex items-center gap-3">
            <span class="font-semibold text-lg">
                {{ $concert->entrades->count() }} / {{ $concert->escenari->aforament_maxim }} entrades venudes
            </span>
                @if($concert->entrades->count() >= $concert->escenari->aforament_maxim)
                    <span class="bg-red-100 text-red-800 text-sm font-bold px-3 py-1 rounded-full">
                    Esgotades
                </span>
                @endif
            </div>
        </div>

        @if($concert->entrades->isEmpty())
            <p class="text-gray-600">Encara no hi ha cap assistent registrat per a aquest concert.</p>
        @else
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom d'usuari</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data de compra</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Codi d'entrada</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($concert->entrades as $entrada)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $entrada->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $entrada->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm bg-gray-100 rounded px-2 py-1 inline-block">{{ $entrada->codi_entrada }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
