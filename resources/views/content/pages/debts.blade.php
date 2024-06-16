@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Gestión de deuda')

@section('content')
<h4>Deudas de la comunidad: {{$activeCommunity->community_name}}</h4>
<a href="{{route('pages-debts-create')}}" class="btn rounded-pill btn-secondary">Crear recibo para una propiedad</a>
<a href="{{route('pages-debts-createglobal')}}" class="btn rounded-pill btn-primary">Crear derrama</a>
<div class="mb-2"></div>
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Compensar</th>
                    <th>Descripción</th>
                    <th>Propiedad</th>
                    <th>Vecino</th>
                    <th>Fecha <br> emisión</th>
                    <th>Fecha <br>vencimiento</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($debts as $debt)
                    <tr>
                        <td>
                            @if ($debt->status_id <> 2)
                                <a href="{{ route('pages-debts-pay', $debt->debt_id) }}" class="badge bg-success">Compensar</a>

                            @else
                                <a href="{{ route('pages-debts-reopen', $debt->debt_id) }}" class="badge bg-warning">Reabrir</a>

                            @endif

                        </td>
                        <td>{{$debt->debt_description}}</td>
                        <td>
                            @if ($debt->property) {{-- Verifica si la relación 'property' existe --}}
                                {{$debt->property->phase}} - {{$debt->property->block}} - {{$debt->property->floor}} -
                                {{$debt->property->number}}
                            @else
                                No hay propiedad asociada
                            @endif
                        </td>
                        <td> @if ($debt->neighbor) {{-- Verifica si la relación 'neighbor' existe --}}
                            {{$debt->neighbor->name}} {{-- Accede al atributo 'name' del vecino --}}
                        @else
                            No hay vecino asociado
                        @endif
                        </td>
                        <td>{{$debt->issue_date}}</td>
                        <td>{{$debt->maturity_date}}</td>
                        <td>{{$debt->amount}}</td>
                        <td>
                            <a href="{{route('pages-debts-show', $debt->debt_id)}}" class="btn btn-primary">Editar</a> |
                            <a href="{{route('pages-debts-destroy', $debt->debt_id)}}" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
</div>

@endsection