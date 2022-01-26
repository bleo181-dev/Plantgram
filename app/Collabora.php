<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collabora extends Model
{
    protected $primaryKey = 'codice_collaborazione';
    protected $table = 'collabora';
    protected $fillable = ['id', 'codice_serra'];
}
