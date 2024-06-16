@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Gestión de deuda')

@section('content')
<h4>Creando una deuda nueva</h4>

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
                <form method="POST" action="{{route('pages-debts-store')}}">
                    @csrf
                    <input type="hidden" name='community_id' value="{{$activeCommunity->community_id}}" />
                    <select name="property_id" class="form-select">
                        <option value="">Selecciona una propiedad</option>
                        @foreach ($properties as $property)
                            <option value="{{$property->property_id}}">
                                {{$property->phase}} - {{$property->block}} - {{$property->floor}} -
                                {{$property->number}}
                            </option>
                        @endforeach
                    </select>
                    <div class="mb-3">
                        <label class="form-label" for="debt_description">Descripción</label>
                        <input type="text" name='debt_description' class="form-control" id="debt_description" required
                             />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="issue_date">Fecha Emisión</label>
                        <input type="date" name='issue_date' class="form-control" id="issue_date" required
                           />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="maturity_date">Fecha Vencimiento</label>
                        <input type="date" name='maturity_date' class="form-control" id="maturity_date" required
                             />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="amount">Importe</label>
                        <input type="integer" name='amount' class="form-control" id="amount" required
                           />
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection