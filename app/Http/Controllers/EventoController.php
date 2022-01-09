<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Bisogno;
use App\Pianta;
use App\Diario;

class EventoController extends Controller
{
    public function index($codice_pianta)
    {
        $eventi = Bisogno::
                Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                ->where('evento.codice_pianta', $codice_pianta)
                ->where('evento.codice_utente', '=', auth()->id())
                ->get();

        $pianta = Pianta::find($codice_pianta);

        return view('evento.index', compact('eventi', 'pianta'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nome'          => 'required|max:100'
        ]);

        $input = $request->all();
        $evento = Evento::find($id);

        $evento->nome = $input['nome'];
        $evento->data = date('Y-m-d H:i:s');

        $evento->save();

        $pianta = Pianta::find($evento->codice_pianta);

        $diario = Diario::where('codice_pianta',$evento->codice_pianta)->get();

        $eventi = Bisogno::
                Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                ->where('evento.codice_pianta', $evento->codice_pianta)
                ->where('evento.codice_utente', auth()->id())
                ->get();

        return view('pianta.show', compact('pianta','diario','eventi'));
    }
}
