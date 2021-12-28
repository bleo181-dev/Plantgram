<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pianta;

class PiantaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$piante = Pianta::all();
        $piante = Pianta::all();
        return view('pianta.index', compact('piante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pianta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'codice_serra' => 'required', 
            'nome'         => 'required|max:100', 
            'foto'         => 'required', //discutibile, per ora lo metto per evitare di rompere l'intefaccia
            'luogo'        => 'required|max:100', 
            'stato'        => 'required'
        ]);

        $input = $request->all();
        Pianta::create($input);
        return redirect()->route('pianta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pianta = Pianta::find($id);
        // $pianta = Pianta::where('nome_campo', 'operatore', 'valore');
        return view('pianta.edit', compact('pianta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'codice_serra' => 'required', 
            'nome'         => 'required|max:100', 
            'foto'         => 'required', //discutibile, per ora lo metto per evitare di rompere l'intefaccia
            'luogo'        => 'required|max:100', 
            'stato'        => 'required'
        ]);

        $input = $request->all();
        $pianta = Pianta::find($id); 

        $pianta->Codice_serra = $input['codice_serra'];
        $pianta->Nome = $input['nome']; 
        $pianta->Luogo = $input['luogo'];
        $pianta->Foto = $input['foto'];
        $pianta->Stato = $input['stato'];

        $pianta->save();
        return redirect()->route('pianta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
