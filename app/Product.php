<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestampts = false;

    protected $filleble = [
        'name', 'price', 'priceUnit', 'image',
    ];
}
