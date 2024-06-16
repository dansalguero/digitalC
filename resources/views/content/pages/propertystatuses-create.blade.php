@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Estados de Propiedades')

@section('content')
<h4>Creando un nuevo estado</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="{{route('pages-propertystatuses-store')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Nombre</label>
                        <input type="text" name='name'  class="form-control"
                            id="basic-default-fullname" />
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection