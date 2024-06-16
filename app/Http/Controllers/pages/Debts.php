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


////Controlador de la página de Gestión de pagos y todas sus funcionalidades
class debts extends Controller
{
  public function index()
  {

    // Siempre me quedo con el usuario autenticado, esto se va a ver en todos los controladores.

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


    //Esto lo hagopor si una propiedad no tiene vecino asignado que no tenga problemas al crear la deuda.
    $property = Property::find($request->property_id);

    $neighbor_id = null;


    if ($property->neighbor) {
        $neighbor_id = $property->neighbor->neighbor_id;
    }

    $debt = new Debt();
    $debt->community_id = $activeCommunity->community_id;
    $debt->property_id = $request->property_id;
    $debt->neighbor_id = $neighbor_id; 
    $debt->amount = $request->amount;
    $debt->debt_description = $request->debt_description;
    $debt->maturity_date = $request->maturity_date;
    $debt->issue_date = $request->issue_date;
    $debt->status_id = 1;
    $debt->save();

    //Por razones obvias, y para demostrar el envío de emails, he puesto siempre el mío personal.
    Mail::to('danimanx2@gmail.com')->send(new NuevoRecibo($debt));
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
    $debt->issue_date = $request->issue_date;
    $debt->maturity_date = $request->maturity_date;
    $debt->clearing_date = $request->clearing_date;
    $debt->save();

    return redirect()->route('pages-debts')->with('success', 'Deuda actualizada correctamente.');
  }

  public function pay($debt_id)
  {

    //Estado 1 lo uso como pendiente de pago y 2 como pagado.
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
