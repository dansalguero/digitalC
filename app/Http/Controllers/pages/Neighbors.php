<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Neighbor;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;


////Controlador de la página de mis vecinos y todas sus funcionalidades
class neighbors extends Controller
{
  public function index()
  {

    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;


    if (!$activeCommunity) {
      return redirect()->route('pages-communities')->with('error', 'No tienes una comunidad activa asignada.');
    }

    $properties = $activeCommunity->properties;
    $neighbors = $activeCommunity->neighbors;
    return view('content.pages.neighbors', ['neighbors' => $neighbors, 'activeCommunity' => $activeCommunity, 'properties' => $properties]);
  }

  public function create()
  {

    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;

    $properties = Property::whereDoesntHave('neighbor')->where('community_id', $activeCommunity->community_id)->get();

    return view('content.pages.neighbors-create', ['properties' => $properties, 'activeCommunity' => $activeCommunity]);
  }

  public function store(Request $request)
  {
    $validator = $request->validate([
      'name' => 'required',
      'surname' => 'required'
    ]);
    $neighbor = new Neighbor();
    $neighbor->community_id = $request->community_id;
    $neighbor->property_id = $request->property_id;
    $neighbor->is_primary_owner = $request->is_primary_owner;
    $neighbor->ownership_percentage = $request->ownership_percentage;
    $neighbor->name = $request->name;
    $neighbor->surname = $request->surname;
    $neighbor->email = $request->email;
    $neighbor->phone = $request->phone;

    $neighbor->created_at = now();
    $neighbor->updated_at = now();
    $neighbor->save();
    return redirect()->route('pages-neighbors');
  }

  public function show($neighbor_id)
  {
    $neighbor = Neighbor::find($neighbor_id);
    $community_id = $neighbor->community_id;
    $properties = Property::where('community_id', $community_id)->get();

    return view('content.pages.neighbors-show', ['neighbor' => $neighbor, 'properties' => $properties]);
  }


  public function update(Request $request)
  {
    $neighbor = Neighbor::find($request->neighbor_id);

    $neighbor->ownership_percentage = $request->ownership_percentage;
    $neighbor->is_primary_owner = $request->is_primary_owner;
    $neighbor->name = $request->name;
    $neighbor->surname = $request->surname;
    $neighbor->nif = $request->nif;
    $neighbor->email = $request->email;
    $neighbor->phone = $request->phone;
    $neighbor->property_id = $request->property_id;
    $neighbor->updated_at = now();
    $neighbor->save();
    return redirect()->route('pages-neighbors');
  }

  public function destroy($neighbor_id)
  {
    $neighbor = Neighbor::find($neighbor_id);
    $neighbor->delete();
    return redirect()->route('pages-neighbors');
  }
}