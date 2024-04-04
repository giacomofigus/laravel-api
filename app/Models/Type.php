<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    // Definizione della relazione: I tipi sono in relazione one to Many
    //Un tipo appartiene a più post tramite queste righe di codice:

    public function projects(): HasMany{
        return $this->hasMany( Project::class );
    }
}
