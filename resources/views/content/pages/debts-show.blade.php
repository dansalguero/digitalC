@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Gestión de deuda')

@section('content')
<h4>Editando una deuda</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="{{route('pages-debts-update')}}">
                    @csrf
                    <input type="hidden" name='debt_id' value="{{$debt->debt_id}}" />
                    <div class="mb-3">
                        <label class="form-label" for="debt_description">Descripción</label>
                        <input type="text" value ="{{$debt->debt_description}}"  name='debt_description' class="form-control" id="debt_description" required
                           />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="issue_date">Fecha Emisión</label>
                        <input type="date" value ="{{$debt->issue_date}}" name='issue_date' class="form-control" id="issue_date" 
                            />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="maturity_date">Fecha Vencimiento</label>
                        <input type="date" value ="{{$debt->maturity_date}}" name='maturity_date' class="form-control" id="maturity_date" 
                           />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="maturity_date">Fecha cobro</label>
                        <input type="date" value ="{{$debt->clearing_date}}" name='clearing_date' class="form-control" id="maturity_date" 
                            />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="amount">Importe</label>
                        <input type="integer" value ="{{$debt->amount}}" name='amount' class="form-control" id="amount" 
                         />
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection