<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Bisogno;

class EventoController extends Controller
{
    public function index($id)
    {
        $eventi = Evento::
                Join('bisogno', 'bisogno.codice_bisogno', '=', 'evento.codice_bisogno')
                ->where('evento.codice_pianta', $id)
                ->where('evento.codice_utente', auth()->id())
                ->get();



        return view('evento.index', compact('eventi'));
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set("Europe/Rome");
        $validateData = $request->validate([
            'nome'          => 'required|max:100'
        ]);

        $input = $request->all();
        $evento = Evento::find($id); 

        $evento->nome = $input['nome'];
        $evento->data = (date("Y-m-d H:i:s")); 

        $evento->save();

        $eventi = Evento::
                Join('bisogno', 'bisogno.codice_bisogno', '=', 'evento.codice_bisogno')
                ->where('evento.codice_pianta', $evento->codice_pianta)
                ->where('evento.codice_utente', auth()->id())
                ->get();

        return view('evento.index', compact('eventi'));
    }
}
