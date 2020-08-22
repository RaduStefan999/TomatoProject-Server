<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'token'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
