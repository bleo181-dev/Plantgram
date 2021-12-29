<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    protected $primaryKey = 'codice_diario';
    protected $table = 'diario';
    protected $fillable = ['codice_pianta', 'codice_utente', 'foto', 'testo'];
}

