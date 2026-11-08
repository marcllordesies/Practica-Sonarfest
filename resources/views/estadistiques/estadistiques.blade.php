@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">📊 Panell d'Estadístiques del SonarFest</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4 text-indigo-600">1. Top 5 Concerts més venuts</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach($topConcerts as $concert)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="font-semibold">{{ $concert->nom }}</p>
                                <p class="text-sm text-gray-500">{{ $concert->artista->nom ?? '' }}</p>
                            </div>
                            <span class="bg-indigo-100 text-indigo-800 text-sm font-bold px-3 py-1 rounded-full">
                            {{ $concert->entrades_count }} entrades
                        </span>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4 text-indigo-600">2. Top 5 Artistes amb més concerts</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach($topArtistes as $artista)
                        <li class="py-3 flex justify-between items-center">
                            <span class="font-semibold">{{ $artista->nom }}</span>
                            <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded-full">
                            {{ $artista->concerts_count }} concerts
                        </span>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4 text-indigo-600">3. Recaptació per Escenari</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach($recaptacioEscenaris as $escenari)
                        <li class="py-3 flex justify-between items-center">
                            <span class="font-semibold">{{ $escenari->nom }}</span>
                            <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full">
                            {{ number_format($escenari->entrades_sum_preu_pagat ?? 0, 2) }} €
                        </span>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4 text-indigo-600">4. Gèneres més populars</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach($generesPopulars as $genere)
                        <li class="py-3 flex justify-between items-center">
                            <span class="font-semibold">{{ $genere->nom }}</span>
                            <span class="bg-purple-100 text-purple-800 text-sm font-bold px-3 py-1 rounded-full">
                            {{ $genere->total_entrades }} entrades
                        </span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>


        <div class="bg-white shadow rounded-lg p-6 mt-8">
            <h2 class="text-xl font-bold mb-4 text-indigo-600">5. Ocupació mitjana per Escenari</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Escenari</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aforament Màxim</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Concerts</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entrades Venudes</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ocupació Mitjana</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($ocupacioEscenaris as $escenari)
                        @php
                            $totalPossible = $escenari->aforament_maxim * max($escenari->concerts_count, 1);
                            $ocupacio = $totalPossible > 0 ? ($escenari->entrades_count / $totalPossible) * 100 : 0;
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $escenari->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $escenari->aforament_maxim }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $escenari->concerts_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $escenari->entrades_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold {{ $ocupacio >= 80 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ number_format($ocupacio, 1) }}%
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
