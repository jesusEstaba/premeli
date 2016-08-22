<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class References extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'references';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product', 
        'numProcRef',
        'price',
    ];
}
