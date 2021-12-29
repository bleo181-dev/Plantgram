<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bisogno extends Model
{
    protected $primaryKey = 'codice_bisogno';
    protected $table = 'bisogno';
    protected $fillable = ['codice_pianta', 'nome', 'cadenza'];
}
