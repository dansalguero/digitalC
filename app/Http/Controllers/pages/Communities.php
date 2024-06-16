<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Community, Debt, Report};
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


////Controlador de la página de mis comunidades y todas sus funcionalidades
class communities extends Controller
{

  public function index()
  {

    //Trabajamos con el usuario autenticado

    $user = Auth::user();

    $communities = Community::where('user_id', $user->id)->get(); 

    // Si no tenemos comunidad creada, se mostrará la ventana para crear una nueva comunidad

    if ($user->communities && $user->communities->count() > 0) {


      return view('content.pages.communities', ['communities' => $communities]);
    } else {

      return view('content.pages.communities-create');
    }

  }

  public function create()
  {

    $user = Auth::user();


    return view('content.pages.communities-create', ['userId' => $user->id]);
  }


  //Esto es importante, de esta forma controlo el operar siempre en la comunidad seleccionada (activa)
  public function setActive(Request $request)
  {

    $request->validate([
      'community_id' => 'required|exists:communities,community_id',
    ]);


    $user = Auth::user();


    Community::where('user_id', $user->id)->update(['active' => false]);


    $community = Community::where('user_id', $user->id)
      ->where('community_id', $request->community_id)
      ->first();

    if ($community) {
      $community->active = true;
      $community->save();
    }

    return redirect()->route('pages-communities');
  }

  public function store(Request $request)
  {

    $userId = $request->user()->id;

    $community = new Community();
    $community->community_name = $request->community_name;
    $community->contact_name = $request->contact_name;
    $community->contact_phone = $request->contact_phone;
    $community->contact_email = $request->contact_email;
    $community->user_id = $userId;
    $community->active = 0;
    $community->created_at = now();
    $community->updated_at = now();
    $community->save();

    return redirect()->route('pages-communities');
  }

  public function show($community_id)
  {

    $user = Auth::user();


    $community = Community::where('user_id', $user->id)
      ->where('community_id', $community_id)
      ->first();


    if ($community) {

      return view('content.pages.communities-show', ['community' => $community]);
    } else {

      return redirect()->route('pages-communities');
    }
  }

  public function update(Request $request)
  {

    $community = community::find($request->community_id);
    $community->community_name = $request->community_name;
    $community->contact_name = $request->contact_name;
    $community->contact_phone = $request->contact_phone;
    $community->contact_email = $request->contact_email;
    $community->updated_at = now();
    $community->save();
    return redirect()->route('pages-communities');
  }


  // SI se borra la comunidad, se borran todas las deudas, vecinos y propiedades asociadas a ella
  public function destroy(Request $request)
  {
    $community = Community::find($request->community_id);

    $community->debts()->delete();
    $community->neighbors()->delete();
    $community->properties()->delete();
    $community->delete();
    return redirect()->route('pages-communities');
  }

  // Reporte de deudas pendientes para la comunidad seleccionada
  public function pendingdebtsforcommunity()
  {
    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;


    $debts = Debt::where('community_id', $activeCommunity->community_id)
      ->whereNull('clearing_date') 
      ->get();


    $pdf = Pdf::loadView('content.pdf.pendingdebts', ['debts' => $debts]);

    $report = new Report();
    $report->url = 'pendingdebts.pdf';
    $report->save();

    // No se por qué, pero no siempre se me gurdaba el archivo.
    Storage::put('public/pdf/pendingdebts.pdf', $pdf->output());
    return $pdf->download('pendingdebts.pdf');


  }

    // Reporte de deudas cobradas para la comunidad seleccionada
  public function paiddebtsforcommunity()
  {
    $user = Auth::user();
    $activeCommunity = $user->activeCommunity;


    $debts = Debt::where('community_id', $activeCommunity->community_id)
      ->whereNotNull('clearing_date') 
      ->get();


    $pdf = Pdf::loadView('content.pdf.paiddebts', ['debts' => $debts]);

    $report = new Report();
    $report->url = 'paiddebts.pdf';
    $report->save();

    Storage::put('public/pdf/paiddebts.pdf', $pdf->output());
    return $pdf->download('paiddebts.pdf');

  }

}