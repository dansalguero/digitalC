@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Page 2')

@section('content')
<h4>Creando un vecino nuevo</h4>

<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="{{route('pages-neighbors-store')}}">
                    @csrf
                    <input type="hidden" name='community_id' value="{{$activeCommunity->community_id}}" />
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Porcentaje de propiedad</label>
                        <input type="percentage" name='ownership_percentage' class="form-control"
                            id="ownership_percentage" placeholder="Primera" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Propietario principal</label>
                        <select name="is_primary_owner" id="is_primary_owner" class="form-select" placeholder="Segundo">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nombre</label>
                        <input type="text" name='name' class="form-control" id="name" required
                            placeholder="Daniel" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Apellidos</label>
                        <input type="text" name='surname' class="form-control" id="surname" required
                            placeholder="Salguero Fuentes" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">NIF</label>
                        <input type="text" name='nif' class="form-control" id="nif" required
                            placeholder="0000000A" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Teléfono</label>
                        <input type="text" name='phone' class="form-control" id="basic-default-fullname" 
                            placeholder="645555555" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="email" name='email' class="form-control" id="basic-default-fullname" required
                            placeholder="vecino@correo.com"/>
                    </div>
                    <select name="property_id" class="form-select" >
                        <option value="">Selecciona una propiedad</option>
                        @foreach ($properties as $property)
                            <option value="{{$property->property_id}}">
                                {{$property->phase}} - {{$property->block}} - {{$property->floor}} -
                                {{$property->number}}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection