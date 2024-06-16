@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Propiedades')

@section('content')
<h4>Propiedades de la comunidad: {{$activeCommunity->community_name}}</h4>
<a href="{{route('pages-properties-create')}}" class="btn rounded-pill btn-primary">Crear nueva propiedad </a>
<div class="mb-2"></div>
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Fase</th>
                    <th>Bloque</th>
                    <th>Planta</th>
                    <th>Número</th>
                    <th>Estado</th>
                    <th>Vecino <br> asignado </th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($properties as $property)
                    <tr>
                        <td>{{$property->phase}}</td>
                        <td>{{$property->block}}</td>
                        <td>{{$property->floor}}</td>
                        <td>{{$property->number}}</td>
                        <td>{{$property->status ? $property->status->name : 'N/A' }}</td>
                        <td>{{$property->neighbor ? $property->neighbor->name . ' ' . $property->neighbor->surname : 'N/A' }}
                        </td>

                        <td><a href="{{route('pages-properties-show', $property->property_id)}}"
                                class="btn btn-primary">Editar</a> |
                            <a href="{{route('pages-properties-destroy', $property->property_id)}}"
                                class="btn btn-danger">ELIMINAR</a>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection