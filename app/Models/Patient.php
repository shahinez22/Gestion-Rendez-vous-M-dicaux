<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = ['nom', 'telephone'];

    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class);
    }
}
