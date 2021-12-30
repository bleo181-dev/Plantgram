<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;

class EventoController extends Controller
{
    public function index($id)
    {
        $eventi = Evento::where('codice_pianta', $id)
                ->where('codice_utente', auth()->id())
                ->get();

        return view('evento.index', compact('eventi'));
    }
}
