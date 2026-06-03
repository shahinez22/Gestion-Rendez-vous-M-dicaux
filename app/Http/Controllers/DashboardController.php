<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;

class DashboardController extends Controller
{
    public function index()
    {
        $medecinsCount = Medecin::count();
        $patientsCount = Patient::count();
        $rendezVousCount = RendezVous::count();

        $rendezVous = RendezVous::with(['medecin', 'patient'])
            ->orderBy('date_rdv')
            ->paginate(10);

        return view('dashboard', compact(
            'medecinsCount',
            'patientsCount',
            'rendezVousCount',
            'rendezVous'
        ));
    }
}
