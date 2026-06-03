<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedecinController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $medecins = Medecin::when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%{$search}%")
                ->orWhere('specialite', 'like', "%{$search}%");
        })->orderBy('nom')->paginate(10);

        return view('medecins.index', compact('medecins', 'search'));
    }

    public function create(): View
    {
        return view('medecins.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
        ]);

        Medecin::create($validated);

        return redirect()->route('medecins.index')
            ->with('success', 'Médecin créé avec succès.');
    }

    public function edit(Medecin $medecin): View
    {
        return view('medecins.edit', compact('medecin'));
    }

    public function update(Request $request, Medecin $medecin): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
        ]);

        $medecin->update($validated);

        return redirect()->route('medecins.index')
            ->with('success', 'Médecin mis à jour avec succès.');
    }

    public function destroy(Medecin $medecin): RedirectResponse
    {
        $medecin->delete();

        return redirect()->route('medecins.index')
            ->with('success', 'Médecin supprimé avec succès.');
    }
}
