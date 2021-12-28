<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pianta extends Model
{
    protected $primaryKey = 'Codice_pianta';
    protected $table = 'Piantas';
    protected $fillable = ['codice_serra', 'nome', 'foto', 'luogo', 'stato'];
    public $timestamps = false;
}
