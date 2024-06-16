@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Reportes en PDF')

@section('content')
<h4>Reporte para la comunidad: {{$activeCommunity->community_name}}</h4>
<a href="{{route('pages-reports-pendingdebts')}}" class="btn rounded-pill btn-secondary">Crear nuevo reporte</a>
<div class="mb-2"></div>
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Creado en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->created_at}}</td>
                        <td> <a href="/storage/pdf/{{$report->url}}">Download</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection