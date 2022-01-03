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

        $pianta = Pianta::find($id);

        return view('diario.index', compact('diario', 'pianta', 'id'));
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

        $data = file_get_contents($_FILES['foto']['tmp_name']);

        Diario::create([
            'codice_utente' => auth()->id(),
            'codice_pianta' => $id,
            'testo'    => $validateData['testo'],
            'foto'   => $data,
            'data'    => (date("Y-m-d H:i:s")),
        ]);

        $diario = Diario::where('codice_pianta', $id)
                ->where('codice_utente', auth()->id())
                ->get();

        $pianta = Pianta::find($id);

        return view('diario.index', compact('diario','pianta', 'id'));
    }

    public function edit($id)
    {
        $diario=Diario::find($id);
        return view('diario.edit', compact('diario'));
    }

    public function update(Request $request, $codice_diario)
    {
        $validateData = $request->validate([
            'testo'   => 'required|max:1000',
            'foto'    => 'nullable',
        ]);



        $input = $request->all();
        $d = Diario::find($codice_diario);

        $d->testo = $input['testo'];
        $d->data = (date("Y-m-d H:i:s"));

        if(!empty($input['foto'])){
            $data = file_get_contents($_FILES['foto']['tmp_name']);
            $d->foto = $data;
        }

        $d->save();

        $id=$d->codice_pianta;

        $diario = Diario::where('codice_pianta', $id)
                ->where('codice_utente', auth()->id())
                ->get();
        $pianta = Pianta::find($id);

        return view('diario.index', compact('diario','pianta', 'id'));
    }

    public function destroy($codice_diario)
    {
        $d = Diario::find($codice_diario);
        $id=$d->codice_pianta;
        $d->delete();

        $diario = Diario::where('codice_pianta', $id)
        ->where('codice_utente', auth()->id())
        ->get();
        $pianta = Pianta::find($id);

        return view('diario.index', compact('diario','pianta', 'id'));
    }

}
