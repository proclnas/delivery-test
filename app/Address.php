<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'lograudoro',
        'numero',
        'cep',
        'cidade',
        'complemento',
        'bairro'
    ];

    public function client() {
        return $this->belongsTo('App\Client');
    }    
}