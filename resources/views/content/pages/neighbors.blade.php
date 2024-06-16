@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Vecinos')

@section('content')
<h4>Vecinos de la comunidad: {{$activeCommunity->community_name}}</h4>
<a href="{{route('pages-neighbors-create')}}" class="btn rounded-pill btn-primary">Crear nuevo vecino</a>
<div class="mb-2"></div>
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table ">
            <thead>
                <tr>
                    <th>Vivienda</th>
                    <th>% Propiedad</th>
                    <th>Propietario <br> principal</th>
                    <th>Nombre</th>
                    <th>NIF</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($neighbors as $neighbor)
                    <tr>
                         @if ($neighbor->property)
                            <td>{{ $neighbor->property->phase }} <br>{{ $neighbor->property->block }} -
                                {{ $neighbor->property->floor }} - {{ $neighbor->property->number }}</td>
                        @else
                            <td>Propiedad no asignada</td>
                        @endif
                        <td>{{$neighbor->ownership_percentage}}%</td>
                        <td>{{$neighbor->is_primary_owner ? 'Sí' : 'No' }}</td>
                        <td>{{$neighbor->name}}<br> {{$neighbor->surname}}</td>
                        <td>{{$neighbor->nif}}</td>
                        <td>{{$neighbor->phone}}</td>
                        <td>{{$neighbor->email}}</td>
                        <td><a href="{{route('pages-neighbors-show', $neighbor->neighbor_id)}}"
                                class="btn btn-primary">Editar</a> | <a
                                href="{{route('pages-neighbors-destroy', $neighbor->neighbor_id)}}"
                                class="btn btn-danger">Eliminar</a></td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection