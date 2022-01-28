<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pubblicita extends Model
{
    protected $primaryKey = 'codice_pubblcita';
    protected $table = 'pubblicita';
    protected $fillable = ['produttore', 'body', 'priorita', 'foto'];
}
