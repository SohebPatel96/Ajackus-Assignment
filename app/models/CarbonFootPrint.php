<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


class CarbonFootPrint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'carbon_foot_print';
    public $timestamps = false;

    protected $fillable = [
        'id', 'activity_type', 'activity', 'country', 'mode', 'carbon_foot_print'
    ];
}
