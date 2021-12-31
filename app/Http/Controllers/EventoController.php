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

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nome'          => 'required|max:100' 
        ]);

        $input = $request->all();
        $evento = Evento::find($id); 

        $evento->nome = $input['nome']; 

        $evento->save();

        $eventi = Evento::where('codice_pianta', $evento->codice_pianta)
                ->where('codice_utente', auth()->id())
                ->get();

        return view('evento.index', compact('eventi'));
    }
}
