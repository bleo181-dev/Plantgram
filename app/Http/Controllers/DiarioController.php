<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diario;
use App\Pianta;
use App\Serra;

class DiarioController extends Controller
{
    public function index($id)
    {
        $diario = Diario::where('codice_pianta', $id)
                ->where('codice_utente', auth()->id())
                ->get();

        return view('diario.index', compact('diario', 'id'));
    }

    public function create($id)
    {
        return view('diario.create', compact('id'));
    }

    public function store(Request $request, $id)
    {
        $validateData = $request->validate([
            'testo'   => 'required|max:1000', 
            'foto'    => 'required',
        ]);

        Diario::create([
            'codice_utente' => auth()->id(),
            'codice_pianta' => $id,
            'testo'    => $validateData['testo'],
            'foto'   => $validateData['foto'],
        ]);

        $diario = Diario::where('codice_pianta', $id)
                ->where('codice_utente', auth()->id())
                ->get();

        return view('diario.index', compact('diario', 'id'));
    }

    public function edit($id)
    {
        $diario=Diario::find($id);
        return view('diario.edit', compact('diario'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'testo'   => 'required|max:1000', 
            'foto'    => 'required',
        ]);

        $input = $request->all();
        $d = Diario::find($id); 

        $d->testo = $input['testo'];
        $d->foto = $input['foto']; 

        $d->save();

        $diario = Diario::where('codice_pianta', $id)
                ->where('codice_utente', auth()->id())
                ->get();

        return view('diario.index', compact('diario', 'id'));
    }
    
}
