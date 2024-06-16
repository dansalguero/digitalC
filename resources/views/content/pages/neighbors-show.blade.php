@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Vecinos')

@section('content')
<h4>Editando un vecino</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="{{route('pages-neighbors-update')}}">
                    @csrf
                    <input type="hidden" name="neighbor_id" value="{{ $neighbor->neighbor_id }}">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Porcentaje de propiedad</label>
                        <input type="percentage" name='ownership_percentage' class="form-control"
                            value="{{$neighbor->ownership_percentage}}" id="basic-default-fullname"
                            placeholder="Primera" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Propietario principal</label>
                        <input type="text" name='is_primary_owner' class="form-control" id="basic-default-fullname"
                            value="{{$neighbor->is_primary_owner}}" placeholder="Segundo" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nombre</label>
                        <input type="text" name='name' class="form-control" id="basic-default-fullname"
                            value="{{$neighbor->name}}" required placeholder="Tercera" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Apellidos</label>
                        <input type="text" name='surname' class="form-control" id="basic-default-fullname"
                            value="{{$neighbor->surname}}" required placeholder="431 / D" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">NIF</label>
                        <input type="text" name='nif' class="form-control" id="basic-default-fullname"
                            value="{{$neighbor->nif}}" required placeholder="431 / D" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="email" name='email' class="form-control" id="basic-default-fullname"
                            value="{{$neighbor->email}}" required placeholder="431 / D" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Teléfono</label>
                        <input type="text" name='phone' class="form-control" id="basic-default-fullname"
                            value="{{$neighbor->phone}}" required placeholder="431 / D" />
                    </div>
                    <select name="property_id" class="form-control">
                        @if($neighbor->property)
                            <option value="{{ $neighbor->property->property_id }}">
                                {{ $neighbor->property->phase }} - {{ $neighbor->property->block }} -
                                {{ $neighbor->property->floor }} - {{ $neighbor->property->number }}
                            </option>
                        @else
                            <option value="">Selecciona una propiedad</option>
                        @endif

                        <!-- Listar todas las propiedades disponibles -->
                        @foreach ($properties as $property)
                            <option value="{{ $property->property_id }}">
                                {{ $property->phase }} - {{ $property->block }} - {{ $property->floor }} -
                                {{ $property->number }}
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