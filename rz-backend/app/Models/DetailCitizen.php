<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class DetailCitizen extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class, 'citizen_id', 'family_card_id');
    }

    public function formdata(): BelongsTo
    {
        return $this->belongsTo(FormData::class, 'formdata_id', 'id');
    }

}
