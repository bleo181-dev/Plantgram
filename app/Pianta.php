<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pianta extends Model
{
    protected $table = 'Pianta';
    protected $fillable = ['codice_serra', 'nome', 'luogo', 'stato'];
    public $timestamps = false;
}
