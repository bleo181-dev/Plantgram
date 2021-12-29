<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pianta extends Model
{
    protected $primaryKey = 'codice_pianta';
    protected $table = 'pianta';
    protected $fillable = ['codice_serra', 'nome', 'luogo', 'foto', 'stato'];
}
