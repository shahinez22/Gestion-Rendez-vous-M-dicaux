<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medecin extends Model
{
    protected $fillable = ['nom', 'specialite'];

    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class);
    }
}
