<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'cover_image',
        'type_id'
    ];

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    // Un progetto può avere solo un tipo (One to many)

    public function type(): BelongsTo{
        return $this->belongsTo( Type::class );
    }

    public function technologies(): BelongsToMany{
        return $this->belongsToMany( Technology::class );
    }
}
