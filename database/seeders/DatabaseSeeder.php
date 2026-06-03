<?php

namespace Database\Seeders;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@medic.com',
            'password' => bcrypt('password'),
        ]);

        $medecins = [
            ['nom' => 'Dr. Dupont', 'specialite' => 'Cardiologie'],
            ['nom' => 'Dr. Martin', 'specialite' => 'Pédiatrie'],
            ['nom' => 'Dr. Bernard', 'specialite' => 'Dermatologie'],
            ['nom' => 'Dr. Petit', 'specialite' => 'Neurologie'],
            ['nom' => 'Dr. Dubois', 'specialite' => 'Ophtalmologie'],
        ];

        foreach ($medecins as $medecin) {
            Medecin::create($medecin);
        }

        $patients = [
            ['nom' => 'Jean Dupuis', 'telephone' => '0612345678'],
            ['nom' => 'Marie Curie', 'telephone' => '0623456789'],
            ['nom' => 'Paul Durand', 'telephone' => '0634567890'],
            ['nom' => 'Sophie Lefevre', 'telephone' => '0645678901'],
            ['nom' => 'Lucas Moreau', 'telephone' => '0656789012'],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }

        RendezVous::create(['date_rdv' => now()->addDay(), 'medecin_id' => 1, 'patient_id' => 1]);
        RendezVous::create(['date_rdv' => now()->addDays(2), 'medecin_id' => 2, 'patient_id' => 2]);
        RendezVous::create(['date_rdv' => now()->addDays(3), 'medecin_id' => 3, 'patient_id' => 3]);
    }
}
