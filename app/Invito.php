<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invito extends Model
{
    protected $primaryKey = 'codice_invito';
    protected $table = 'invito';
    protected $fillable = ['email', 'token', 'codice_serra', 'id'];
}
