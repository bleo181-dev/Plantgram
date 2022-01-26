<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $primaryKey = 'codice_evento';
    protected $table = 'evento';
    protected $fillable = ['codice_pianta','codice_bisogno', 'id', 'data', 'nome'];
}
