@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
<h4>Panel de control</h4>
<div class="row">
  <div class="col-xl-2">
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ route('pages-communities') }}" class="text-decoration-none">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-edit fs-3"></i></span>
          </div>
        </a>
        <span class="d-block mb-1 text-nowrap">Comunidades</span>
        <h2 class="mb-0">{{ $communitiesCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-xl-2">
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ route('pages-properties') }}" class="text-decoration-none">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-dock-top fs-3"></i></span>
          </div>
        </a>
        <span class="d-block mb-1 text-nowrap">Propiedades</span>
        <h2 class="mb-0">{{ $propertiesCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-xl-2">
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ route('pages-neighbors') }}" class="text-decoration-none">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-danger"><i class="bx bx-message-square-detail fs-3"></i></span>
          </div>
        </a>
        <span class="d-block mb-1 text-nowrap">Vecinos</span>
        <h2 class="mb-0">{{ $neighborsCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-xl-2">
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ route('pages-debts') }}" class="text-decoration-none">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-cube fs-3"></i></span>
          </div>
        </a>
        <span class="d-block mb-1 text-nowrap">Nº pagos pendientes</span>
        <h2 class="mb-0">{{ $debtsCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ route('pages-debts') }}" class="text-decoration-none">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-purchase-tag fs-3"></i></span>
          </div>
        </a>
        <span class="d-block mb-1 text-nowrap">Importe deuda</span>
        <h2 class="mb-0">{{ $debtsAmount }}€</h2>
      </div>
    </div>
  </div>
</div>
<div class="mb-4"></div>
<div class="card">
    <div class="table-responsive text-nowrap"></div>
<table class="table">
  <thead>
    <tr>
      <th>Nombre de la Comunidad</th>
      <th>Propiedades</th>
      <th>Vecinos</th>
      <th>Nº Pagos Pendientes</th>
      <th>Importe Deuda</th>
    </tr>
  </thead>
  <tbody class="table-border-bottom-0">
    @foreach ($communityData as $data)
      <tr>
        <td>{{ $data['community']->community_name }}</td>
        <td>{{ $data['propertiesCount'] }}</td>
        <td>{{ $data['neighborsCount'] }}</td>
        <td>{{ $data['debtsCount'] }}</td>
        <td>{{ $data['debtsAmount'] }}€</td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
<div class="card-body">
        <div class="row mt-3">
          <div class="d-grid gap-2 col-lg-6 mx-auto">
          <a href="{{route('pages-homepage-pendingdebts')}}"  class="btn rounded-pill btn-warning">Generar reporte deuda pendiente</a>
          <a href="{{route('pages-homepage-paiddebts')}}"  class="btn rounded-pill btn-secondary">Generar reporte deuda cobrada</a>
          </div>
        </div>
      </div>
</div>
@endsection
