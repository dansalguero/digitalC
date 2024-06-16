<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Debt, Property, Neighbor, Community};
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class HomePage extends Controller
{
  public function index()
  {
    $user = Auth::user();

    $roleifexist = DB::table('model_has_roles')->where('model_id', $user->id)->first();

    if (!$roleifexist) {
       DB::table('model_has_roles')->insert([
           'role_id' => 2,
           'model_type' => 'App\Models\User',
           'model_id' => $user->id
       ]);
     
    }

    $communities = Community::where('user_id', $user->id)->get(['community_id', 'community_name']);

    $communityData = [];

    foreach ($communities as $community) {
      $communityId = $community->community_id;

      $propertiesCount = Property::where('community_id', $communityId)->count();
      $neighborsCount = Neighbor::where('community_id', $communityId)->count();
      $debts = Debt::where('community_id', $communityId)->where('status_id', 1)->get();
      $debtsAmount = $debts->sum('amount');
      $debtsCount = $debts->count();

      $communityData[] = [
        'community' => $community,
        'propertiesCount' => $propertiesCount,
        'neighborsCount' => $neighborsCount,
        'debtsCount' => $debtsCount,
        'debtsAmount' => $debtsAmount
      ];
    }


    $communitiesCount = count($communities);
    $propertiesCount = Property::whereIn('community_id', $communities->pluck('community_id'))->count();
    $neighborsCount = Neighbor::whereIn('community_id', $communities->pluck('community_id'))->count();
    $debts = Debt::whereIn('community_id', $communities->pluck('community_id'))->where('status_id', 1)->get();
    $debtsAmount = $debts->sum('amount');
    $debtsCount = $debts->count();

    return view('content.pages.pages-home', [
      'communitiesCount' => $communitiesCount,
      'propertiesCount' => $propertiesCount,
      'neighborsCount' => $neighborsCount,
      'debtsCount' => $debtsCount,
      'debtsAmount' => $debtsAmount,
      'communityData' => $communityData
    ]);
  }
  public function pendingdebts()
  {
      $user = Auth::user();
      $activeCommunity = $user->activeCommunity;


      $debts = Debt::where('community_id', $activeCommunity->community_id)
          ->whereNull('clearing_date') // Asumiendo que 'fecha_cobro' es el nombre de la columna de la fecha de cobro
          ->get();


      $pdf = Pdf::loadView('content.pdf.pendingdebts', ['debts' => $debts]);

      $report = new Report();
      $report->url = 'pendingdebts.pdf';
      $report->save();

      Storage::put('public/pdf/pendingdebts.pdf', $pdf->output());
      return $pdf->download('pendingdebts.pdf');

      // return view('content.pages.reports-create', ['activeCommunity' => $activeCommunity]);
  }

  public function paiddebts()
  {
      $user = Auth::user();
      $activeCommunity = $user->activeCommunity;

    
      $debts = Debt::where('community_id', $activeCommunity->community_id)
          ->whereNotNull('clearing_date') // Asumiendo que 'fecha_cobro' es el nombre de la columna de la fecha de cobro
          ->get();


      $pdf = Pdf::loadView('content.pdf.paiddebts', ['debts' => $debts]);

      $report = new Report();
      $report->url = 'paiddebts.pdf';
      $report->save();

      Storage::put('public/pdf/paiddebts.pdf', $pdf->output());
      return $pdf->download('paiddebts.pdf');

      // return view('content.pages.reports-create', ['activeCommunity' => $activeCommunity]);
  }
}
