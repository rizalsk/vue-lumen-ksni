<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};


class Citizen extends Model
{
    protected $fillable = ['family_card_id'];

    protected $primaryKey = 'family_card_id';
    protected $keyType = 'string';
    public $incrementing = false;
    
    public function details(): HasMany
    {
        return $this->hasMany(DetailCitizen::class, 'citizen_id', 'family_card_id');
    }

}
