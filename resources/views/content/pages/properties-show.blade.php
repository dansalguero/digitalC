@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Page 2')

@section('content')
<h4>Editando una propiedad</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="{{route('pages-properties-update')}}">
                    @csrf
                    <input type="hidden" name='property_id' value="{{$property->property_id}}" />
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Fase</label>
                        <input type="text" name='phase' value="{{$property->phase}}" class="form-control"
                            id="basic-default-fullname" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Bloque</label>
                        <input type="text" name='block' value="{{$property->block}}" class="form-control"
                            id="basic-default-fullname" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Planta</label>
                        <input type="text" name='floor' value="{{$property->floor}}" class="form-control"
                            id="basic-default-fullname" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Número o puerta</label>
                        <input type="text" name='number' value="{{$property->number}}" class="form-control"
                            id="basic-default-fullname" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Vecino</label>
                        <select name='neighbor_id' class="form-select" id="basic-default-fullname" >
                            <option value="">Selecciona un vecino</option>
                            @foreach ($neighbors as $neighbor)
                                <option value="{{ $neighbor->neighbor_id }}">{{ $neighbor->name }} - {{ $neighbor->surname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Estado</label>
                        <select name='status_id' class="form-select" id="basic-default-fullname" required>
                            <option value="">Selecciona un estado</option>
                            @foreach ($propertystatuses as $status_id => $status_name)
                                <option value="{{$status_id }}" @if($status_id == $property->status_id) selected @endif>
                                    {{ $status_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection