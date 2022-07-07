<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pubblicita extends Model
{
    protected $primaryKey = 'codice_pubblicita';
    protected $table = 'pubblicita';
    protected $fillable = ['produttore', 'prodotto', 'url', 'priorita', 'foto'];
}
