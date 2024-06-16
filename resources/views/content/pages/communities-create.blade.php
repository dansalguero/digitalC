@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Crear Comunidad')

@section('content')
<h4>Creando una nueva comunidad</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('pages-communities-store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="community_name">Nombre de la comunidad</label>
                        <input type="text" name='community_name' class="form-control" id="community_name" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact_name">Persona de contacto</label>
                        <input type="text" name='contact_name' class="form-control" id="contact_name"  />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact_phone">Teléfono</label>
                        <input type="tel" name='contact_phone' class="form-control" id="contact_phone" pattern="[0-9]{9}"  />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact_email">Email</label>
                        <input type="email" name='contact_email' class="form-control" id="contact_email"  />
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
