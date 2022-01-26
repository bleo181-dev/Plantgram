<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Bisogno;
use App\Pianta;
use App\Diario;
use App\Serra;

class EventoController extends Controller
{
    public function index($codice_pianta)
    {
        $eventi = Bisogno::
                join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                ->where('evento.codice_pianta', $codice_pianta)
                ->orderBy('data', 'desc')
                ->get()
                ->unique('nome');

        $pianta = Pianta::find($codice_pianta);

        return view('evento.index', compact('eventi', 'pianta'));
    }

    public function store(Request $request, $id)
    {
        $validateData = $request->validate([
            'nome'          => 'required|max:100'
        ]);

        $input = $request->all();
        $evento_scorso = Evento::find($id);

        Evento::create([
            'id'    => auth()->id(),
            'codice_bisogno'   => $evento_scorso->codice_bisogno,
            'codice_pianta'    => $evento_scorso->codice_pianta,
            'nome'             => $validateData['nome'],
            'data'             => date('Y-m-d H:i:s'),
        ]);

        return back();
    }
}
