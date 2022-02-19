<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diario;
use App\Pianta;
use App\Serra;
use App\Collabora;
use App\User;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DiarioController extends Controller
{
    public function index($id)
    {
        $utente = Auth::user();
        $pianta=Pianta::find($id);
        $cod_utente=Serra::where('codice_serra', $pianta->codice_serra)->pluck('id')->first();
        $codici_collab=Collabora::where('codice_serra',$pianta->codice_serra)->pluck('id')->toArray();
        if(Auth::user()){
            if(Auth::user()->admin === 'AD'){
                $diario = Diario::where('codice_pianta', $id)->get();
                $pianta = Pianta::find($id);
                return view('diario.index', compact('utente', 'diario', 'pianta', 'id'));
            }else if(in_array(auth()->id(), $codici_collab)){
                $diario = Diario::where('codice_pianta', $id)->get();
                $pianta = Pianta::find($id);
                return view('diario.index', compact('utente', 'diario', 'pianta', 'id'));
            }else if(auth()->id() == $cod_utente){
                $diario = Diario::where('codice_pianta', $id)->get();
                $pianta = Pianta::find($id);
                return view('diario.index', compact('utente', 'diario', 'pianta', 'id'));
            }else if($pianta->stato == 1){ // se è pubblica
                $diario = Diario::where('codice_pianta', $id)->get();
                $pianta = Pianta::find($id);
                return view('diario.view', compact('utente', 'diario', 'pianta', 'id')); // diario.view è una versione di index senza pulsanti
            }else{
                return view('landingpage');
            }
        }else{
            return view('/auth/login');
        }

    }

    public function create($id)
    {
        $utente = Auth::user();
        return view('diario.create', compact('utente', 'id'));
    }

    public function store(Request $request, $id)
    {
        $validateData = $request->validate([
            'testo'   => 'required|max:1000',
            'foto'    => 'required',
        ]);

        $data = file_get_contents($_FILES['foto']['tmp_name']);

        Diario::create([
            'id' => auth()->id(),
            'codice_pianta' => $id,
            'testo'    => $validateData['testo'],
            'foto'   => $data,
            'data'    => (date("Y-m-d H:i:s")),
        ]);

        $diario = Diario::where('codice_pianta', $id)
                ->where('id', auth()->id())
                ->get();

        $pianta = Pianta::find($id);

        return redirect()->route('diario.index', $id);
    }

    public function edit($id)
    {
        $utente = Auth::user();
        $diario=Diario::find($id);
        $pianta=Pianta::find($diario->codice_pianta);
        $cod_utente=Serra::where('codice_serra', $pianta->codice_serra)->pluck('id')->first();
        $codici_collab=Collabora::where('codice_serra',$pianta->codice_serra)->pluck('id')->toArray();
        if(Auth::user()){
            
            if(Auth::user()->admin === 'AD'){
                $diario=Diario::find($id);
                return view('diario.edit', compact('utente', 'diario'));

            }else if(in_array(auth()->id(), $codici_collab)){
                $diario=Diario::find($id);
                return view('diario.edit', compact('utente', 'diario'));

            }else if(auth()->id() == $cod_utente){
                $diario=Diario::find($id);
                return view('diario.edit', compact('utente', 'diario'));
            }else{
                return view('landingpage');
            }
        }else{
            return view('/auth/login');
        }
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
                ->where('id', auth()->id())
                ->get();
        $pianta = Pianta::find($id);

        return redirect()->route('diario.index', $id);
        }

    public function destroy($codice_diario)
    {
        $d = Diario::find($codice_diario);
        $id=$d->codice_pianta;
        $d->delete();

        return redirect()->route('diario.index', $id);
    }
}
