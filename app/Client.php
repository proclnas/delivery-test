<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{
    protected $table = 'clients';

    protected $fillable = [
        'name', 
        'doc', 
        'bithdate',
        'email'
    ];

    public function address() {
        return $this->hasMany('App\Address', 'id_cliente');
    }
}