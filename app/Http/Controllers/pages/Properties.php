<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Property_status;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Neighbor;
use Illuminate\Support\Facades\Auth;

class properties extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;

    if (!$activeCommunity) {
      return redirect()->route('pages-communities')->with('error', 'No tienes una comunidad activa asignada.');
    }

    // Cargar las propiedades con sus vecinos y estados asociados
    $properties = $activeCommunity->properties()->with(['neighbor', 'status'])->get();
    $neighbors = $activeCommunity->neighbors;

    return view('content.pages.properties', [
      'properties' => $properties,
      'activeCommunity' => $activeCommunity,
      'neighbors' => $neighbors
    ]);
  }

  public function create()
  {

    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;
    $neighbors = Neighbor::whereNull('property_id')
      ->where('community_id', $activeCommunity->community_id)
      ->get();

    $propertystatuses = Property_status::pluck('name', 'status_id');
    return view('content.pages.properties-create', ['propertystatuses' => $propertystatuses, 'activeCommunity' => $activeCommunity, 'neighbors' => $neighbors]);
  }

  public function store(Request $request)
  {
    $validator = $request->validate([
      'phase' => 'required',
      'block' => 'required',
      'floor' => 'required',
      'number' => 'required'
    ]);
    $property = new Property();
    $property->community_id = $request->community_id;
    $property->phase = $request->phase;
    $property->block = $request->block;
    $property->floor = $request->floor;
    $property->number = $request->number;
    $property->status_id = $request->status_id;
    $property->created_at = now();
    $property->updated_at = now();
    $property->save();
    return redirect()->route('pages-properties');
  }

  public function show($property_id)
  {
    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;

    $propertystatuses = Property_status::pluck('name', 'status_id');
    $property = Property::find($property_id);

    $neighbors = Neighbor::whereNull('property_id')
      ->where('community_id', $activeCommunity->community_id)
      ->get();
    return view('content.pages.properties-show', ['property' => $property], ['propertystatuses' => $propertystatuses, 'neighbors' => $neighbors]);
  }

  public function update(Request $request)
  {

    $property = Property::find($request->property_id);
    $property->phase = $request->phase;
    $property->block = $request->block;
    $property->floor = $request->floor;
    $property->number = $request->number;
    $property->status_id = $request->status_id;
    $property->updated_at = now();

    $property->save();

    $neighbor = Neighbor::find($request->neighbor_id);
    if ($neighbor) {
      $neighbor->property_id = $property->property_id;
      $neighbor->save();
    }
    return redirect()->route('pages-properties');
  }

  public function destroy($property_id)
  {
    $property = Property::find($property_id);

    if (!$property) {
        return redirect()->route('pages-properties')->with('error', 'La propiedad no existe.');
    }

    // Obtener el vecino asociado a esta propiedad, si existe
    $neighbor = $property->neighbor;

    // Eliminar la propiedad
    $property->delete();

    // Si hay un vecino asociado, actualizar el campo property_id a null
    if ($neighbor) {
        $neighbor->property_id = null;
        $neighbor->save();
    }
    return redirect()->route('pages-properties');
  }
}