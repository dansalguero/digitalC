@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Comunidades')

@section('content')
<h4>Comunidades</h4>
<a href="{{route('pages-communities-create')}}" class="btn rounded-pill btn-primary">Crear nueva comunidad</a>
<div class="mb-2"></div>
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Elegir para operar</th>
                    <th>Nombre de la comunidad</th>
                    <th>Persona de contacto</th>
                    <th>Teléfono</th>
                    <th>Email</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($communities as $community)
                    <tr>
                        <td>@if ($community->active)
                            <span class="badge bg-success">Seleccionada</span>
                        @else
                            <form action="{{ route('pages-communities-setactive') }}" method="POST">
                                @csrf
                                <input type="hidden" name="community_id" value="{{ $community->community_id }}">
                                <button type="submit" class="btn btn-secondary">Seleccionar</button>
                            </form>
                        @endif
                        <td>{{ $community->community_name }}</td>
                        <td>{{ $community->contact_name }}</td>
                        <td>{{ $community->contact_phone }}</td>
                        <td>{{ $community->contact_email }}</td>
                        <td><a href="{{ route('pages-communities-show', $community->community_id) }}"
                                class="btn btn-primary">Editar</a> |
                            <a href="#" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('pages-communities-destroy', $community->community_id) }}')">Eliminar</a>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(url) {
        if (confirm('¿Seguro que quiere borrar la comunidad? Se borrarán todas las deudas, vecinos y propiedades asociados.')) {
            window.location.href = url;
        }
    }
</script>
<div class="card-body">
    <div class="row mt-3">
        <div class="d-grid gap-2 col-lg-6 mx-auto">
            <a href="{{route('pages-communities-pendingdebtsforcommunity')}}" class="btn rounded-pill btn-warning">Generar
                reporte deuda pendiente comunidad seleccionada</a>
            <a href="{{route('pages-communities-paiddebtsforcommunity')}}" class="btn rounded-pill btn-secondary">Generar
                reporte deuda cobrada comunidad seleccionada</a>
        </div>
    </div>
</div>
</div>
@endsection