@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Propiedades')

@section('content')
@role('admin')
<h4>Estados de propiedades</h4>
<a href="{{route('pages-propertystatuses-create')}}" class="btn rounded-pill btn-primary">Crear nuevo estado </a>
<div class="mb-2"></div>
<div class="card"></div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha creación</th>
                    <th>Fecha actualización</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($propertystatuses as $propertystatus)
                    <tr>
                        <td>{{$propertystatus->status_id}}</td>
                        <td>{{$propertystatus->name}}</td>
                        <td>{{$propertystatus->created_at}}</td>
                        <td>{{$propertystatus->updated_at}}</td>
                        <td><a href="{{route('pages-propertystatuses-show', $propertystatus->status_id)}}"
                                class="btn btn-primary">Editar</a></td>
                        <td><a href="{{route('pages-propertystatuses-destroy', $propertystatus->status_id)}}"
                                class="btn btn-danger">ELIMINAR</a></td>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endrole
@role('user')
<h1>No tienes permisos para ver esta sección</h1>
@endrole
@endsection