<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serra extends Model
{
    protected $primaryKey = 'codice_serra';
    protected $table = 'serra';
    protected $fillable = ['codice_utente', 'nome', 'capienza', 'latitudine', 'longitudine'];
}
