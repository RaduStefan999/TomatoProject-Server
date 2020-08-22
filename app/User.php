<?php

namespace App;

use App\Token;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function token() {
        return $this->hasOne(Token::class);
    }
}
