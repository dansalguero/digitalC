<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Debt, Property, Neighbor};
use App\Mail\NuevoRecibo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Exports\DebtExport;
use Maatwebsite\Excel\Facades\Excel;

class debts extends Controller
{
  public function index()
  {


    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;


    if (!$activeCommunity) {
      return redirect()->route('pages-communities')->with('error', 'No tienes una comunidad activa asignada.');
    }


    $properties = Property::where('community_id', $activeCommunity->community_id)->get();
    $debts = $activeCommunity->debts()->orderBy('status_id', 'asc','clearing_date','desc')->get();



    return view('content.pages.debts', ['debts' => $debts, 'activeCommunity' => $activeCommunity, 'properties' => $properties]);
  }

  public function create()
  {

    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;

    $properties = Property::where('community_id', $activeCommunity->community_id)->get();

    return view('content.pages.debts-create', ['activeCommunity' => $activeCommunity, 'properties' => $properties]);
  }

  public function store(Request $request)
  {
    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;

    // Encuentra la propiedad seleccionada
    $property = Property::find($request->property_id);

    // Verifica si la propiedad tiene un vecino asignado

    // Si tiene un vecino asignado, toma su neighbor_id
    $neighbor_id = $property->neighbor->property_id;

    $debt = new Debt();
    $debt->community_id = $activeCommunity->community_id;
    $debt->property_id = $request->property_id;
    $debt->neighbor_id = $neighbor_id; // Asigna el neighbor_id
    $debt->amount = $request->amount;
    $debt->debt_description = $request->debt_description;
    $debt->maturity_date = $request->maturity_date;
    $debt->issue_date = $request->issue_date;
    $debt->status_id = 1;
    $debt->debt_type_id = 1;
    $debt->save();

    Mail::to('danimanx2@gmail.com')->send(new NuevoRecibo());
    return redirect()->route('pages-debts')->with('success', 'Deuda creada correctamente.');

  }

  public function createglobal()
  {

    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;

    $properties = Property::where('community_id', $activeCommunity->community_id)->get();

    return view('content.pages.debts-createglobal', ['activeCommunity' => $activeCommunity, 'properties' => $properties]);
  }

  public function storeglobal(Request $request)
  {
    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;

    // Encuentra la propiedad seleccionada


    $properties = Property::where('community_id', $activeCommunity->community_id)->get();

    foreach ($properties as $property) {

      $neighbor = Neighbor::where('property_id', $property->property_id)->first();

      Debt::create([
        'property_id' => $property->property_id,
        'community_id' => $property->community_id,
        'debt_description' => $request->debt_description,
        'issue_date' => $request->issue_date,
        'maturity_date' => $request->maturity_date,
        'amount' => $request->amount,
        'debt_type_id' => 2,
        'neighbor_id' => $neighbor ? $neighbor->neighbor_id : null,
        'status_id' =>1,
      ]);
    }

    return redirect()->route('pages-debts')->with('success', 'Deuda global creada con éxito para todas las propiedades.');
  }

  public function show($debt_id)
  {
    $debt = Debt::find($debt_id);

    return view('content.pages.debts-show', ['debt' => $debt]);
  }

  public function update(Request $request)
  {
    $debt = Debt::find($request->debt_id);

    $debt->amount = $request->amount;
    $debt->debt_description = $request->debt_description;
    $debt->maturity_date = $request->maturity_date;
    $debt->issue_date = $request->issue_date;
    $debt->status_id = $request->status_id;
    $debt->debt_type_id = $request->debt_type_id;
    $debt->save();

    return redirect()->route('pages-debts')->with('success', 'Deuda actualizada correctamente.');
  }

  public function pay($debt_id)
  {
    $debt = Debt::find($debt_id);

    $debt->status_id = 2;
    $debt->clearing_date = date('Y-m-d');
    $debt->save();

    return redirect()->route('pages-debts')->with('success', 'Deuda pagada correctamente.');
  }

  public function reopen($debt_id)
  {
    $debt = Debt::find($debt_id);

    $debt->status_id = 1;
    $debt->clearing_date = null;
    $debt->save();

    return redirect()->route('pages-debts')->with('success', 'Deuda reabierta correctamente.');
  }

  public function destroy($debt_id)
  {
    $debt = Debt::find($debt_id);
    $debt->delete();

    return redirect()->route('pages-debts')->with('success', 'Deuda eliminada correctamente.');
  }

}
