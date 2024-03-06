<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

class FormData extends Model
{
    protected $table = "formdata";
    public $timestamps = false;

    protected $appends = [
        'data_parameter'
    ];

    protected function dataParameter(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value, array $attributes) {
                if(!is_null($attributes['data_table']) && $attributes['data_table'] !== ''){
                    return DB::table($attributes['data_table'])->get();
                }
                
                return [];
            },
        )->withoutObjectCaching();
    }

}
