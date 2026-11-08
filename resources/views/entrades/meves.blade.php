@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Les meves entrades</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($entrades->isEmpty())
            <p class="text-gray-600">Encara no has comprat cap entrada.</p>
        @else
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Concert</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Artista</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preu pagat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Codi d'entrada</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($entrades as $entrada)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-indigo-600">
                                <a href="{{ route('concerts.show', $entrada->concert) }}">{{ $entrada->concert->nom }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $entrada->concert->artista->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $entrada->concert->data_hora }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($entrada->preu_pagat, 2) }} €</td>
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-sm bg-gray-100 rounded px-2 py-1 inline-block">{{ $entrada->codi_entrada }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
