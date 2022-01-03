<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Bisogno;

class EventoController extends Controller
{
    public function index($id)
    {
        $eventi = Bisogno::
                Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                ->where('evento.codice_pianta', $id)
                ->where('evento.codice_utente', auth()->id())
                ->get();



        return view('evento.index', compact('eventi'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nome'          => 'required|max:100'
        ]);

        $input = $request->all();
        $evento = Evento::find($id); 

        $evento->nome = $input['nome'];
        $evento->data = (date("Y-m-d H:i:s")); 

        $evento->save();

        $eventi = Bisogno::
                Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                ->where('evento.codice_pianta', $evento->codice_pianta)
                ->where('evento.codice_utente', auth()->id())
                ->get();

        return view('evento.index', compact('eventi'));
    }
}
