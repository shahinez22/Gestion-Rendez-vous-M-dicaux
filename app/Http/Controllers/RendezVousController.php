<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RendezVousController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $rendezVous = RendezVous::with(['medecin', 'patient'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('medecin', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%");
                })->orWhereHas('patient', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%");
                })->orWhere('date_rdv', 'like', "%{$search}%");
            })
            ->orderBy('date_rdv', 'desc')
            ->paginate(10);

        return view('rendez_vous.index', compact('rendezVous', 'search'));
    }

    public function create(): View
    {
        $medecins = Medecin::orderBy('nom')->get();
        $patients = Patient::orderBy('nom')->get();

        return view('rendez_vous.create', compact('medecins', 'patients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'date_rdv' => 'required|date|after_or_equal:today',
            'medecin_id' => 'required|exists:medecins,id',
            'patient_id' => 'required|exists:patients,id',
        ]);

        RendezVous::create($validated);

        return redirect()->route('rendez-vous.index')
            ->with('success', 'Rendez-vous créé avec succès.');
    }

    public function edit(RendezVous $rendezVou): View
    {
        $medecins = Medecin::orderBy('nom')->get();
        $patients = Patient::orderBy('nom')->get();

        return view('rendez_vous.edit', compact('rendezVou', 'medecins', 'patients'));
    }

    public function update(Request $request, RendezVous $rendezVou): RedirectResponse
    {
        $validated = $request->validate([
            'date_rdv' => 'required|date',
            'medecin_id' => 'required|exists:medecins,id',
            'patient_id' => 'required|exists:patients,id',
        ]);

        $rendezVou->update($validated);

        return redirect()->route('rendez-vous.index')
            ->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    public function destroy(RendezVous $rendezVou): RedirectResponse
    {
        $rendezVou->delete();

        return redirect()->route('rendez-vous.index')
            ->with('success', 'Rendez-vous supprimé avec succès.');
    }

    public function calendrier(): View
    {
        $rendezVous = RendezVous::with(['medecin', 'patient'])
            ->orderBy('date_rdv')
            ->get()
            ->groupBy(function ($rdv) {
                return $rdv->date_rdv->format('Y-m-d');
            });

        return view('rendez_vous.calendrier', compact('rendezVous'));
    }
}
