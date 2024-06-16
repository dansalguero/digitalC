<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Report, Debt};
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;



class reports extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activeCommunity = $user->activeCommunity;

        $reports = Report::all();

        return view('content.pages.reports', ['reports' => $reports, 'activeCommunity' => $activeCommunity]);
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
}
