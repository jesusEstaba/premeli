<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use References;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user',
        'numProduct',
        'price',
        'title',
        'thumbnail',
    ];

    public function references()
    {
        return $this->hasMany('App\models\References', 'product');
    }
}
