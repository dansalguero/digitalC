@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Page 2')

@section('content')
<h4>Creando una propiedad nueva</h4>

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
                <form method="POST" action="{{route('pages-properties-store')}}">
                    @csrf
                    <input type="hidden" name='community_id' value="{{$activeCommunity->community_id}}" />
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Fase</label>
                        <input type="text" name='phase' class="form-control" id="basic-default-fullname" required
                            placeholder="Primera" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Bloque</label>
                        <input type="text" name='block' class="form-control" id="basic-default-fullname" required
                            placeholder="Segundo" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Planta</label>
                        <input type="text" name='floor' class="form-control" id="basic-default-fullname" required
                            placeholder="Tercera" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Número o puerta</label>
                        <input type="text" name='number' class="form-control" id="basic-default-fullname" required
                            placeholder="431 / D" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Vecino</label>
                        <select name='neighbor_id' class="form-select" id="basic-default-fullname" >
                            <option value="">Selecciona un vecino</option>
                            @foreach ($neighbors as $neighbor)
                                <option value="{{ $neighbor->id }}">{{ $neighbor->name }} - {{ $neighbor->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Estado</label>
                        <select name='status_id' class="form-select" id="basic-default-fullname" required>
                            <option value="">Selecciona un estado</option>
                            @foreach ($propertystatuses as $status_id => $status_name)
                                <option value="{{$status_id }}">{{ $status_name }}</option>
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