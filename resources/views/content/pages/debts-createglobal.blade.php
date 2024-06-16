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
            <form method="POST" action="{{route('pages-debts-storeglobal')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="debt_description">Descripción</label>
                        <input type="text" name='debt_description' class="form-control" id="debt_description" required
                            placeholder="Descripción de la deuda" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="issue_date">Fecha Emisión</label>
                        <input type="date" name='issue_date' class="form-control" id="issue_date" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="maturity_date">Fecha Vencimiento</label>
                        <input type="date" name='maturity_date' class="form-control" id="maturity_date" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="amount">Importe</label>
                        <input type="number" name='amount' class="form-control" id="amount" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
        </div>
    </div>
</div>

@endsection