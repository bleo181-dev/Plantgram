<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Bisogno;
use App\Evento;
use App\Pianta;
use Illuminate\Support\Facades\DB;

class BisognoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codice_pianta)
    {
        $utente = Auth::user();
        $bisogni = Bisogno::where('codice_pianta', $codice_pianta)->get();
        $pianta = Pianta::find($codice_pianta);

        return view('bisogno.index', compact('utente', 'bisogni' , 'pianta', 'codice_pianta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($codice_pianta)
    {
        $utente = Auth::user();
        $bisogni = Bisogno::where('codice_pianta', $codice_pianta)->pluck('nome')->toArray();
        $pianta = Pianta::find($codice_pianta);

        return view('bisogno.create', compact('utente', 'codice_pianta', 'bisogni', 'pianta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if($request->custom == null){
            $validateData = $request->validate([
                'tipologia'      => 'required|max:100',
                'cadenza'  => 'required'
            ]);
            $nome = $validateData['tipologia'];
        }else{
            $validateData = $request->validate([
                'custom'          => 'required|max:100',
                'cadenza'  => 'required'
            ]);
            $nome = $validateData['custom'];
        }

            if (Bisogno::where('codice_pianta', $request->codice_pianta)->where('nome', $nome)->exists()) {
                return back()->withErrors(['msg'=>'Hai già un bisogno di questa tipologia per questa pianta']);
            }

        $var = Bisogno::create([
            'codice_pianta'   => $request->codice_pianta,
            'nome'            => $nome,
            'cadenza'         => ($validateData['cadenza'])*86400,
        ]);

        Evento::create([
            'id'    => auth()->id(),
            'codice_bisogno'   => $var->codice_bisogno,
            'codice_pianta'    => $request->codice_pianta,
            'nome'             => $nome,
            'data'             => $var->created_at,
        ]);

        return redirect()->action([PiantaController::class, 'show'], $request->codice_pianta);
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
        $utente = Auth::user();
        $bisogno = Bisogno::find($id);
        return view('bisogno.edit', compact('utente', 'bisogno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codice_bisogno)
    {
        if($request->custom == null){
            $validateData = $request->validate([
                'nome'      => 'required|max:100',
                'cadenza'        => 'required'
            ]);
            $nome = $validateData['nome'];
        }else{
            $validateData = $request->validate([
                'custom'          => 'required|max:100',
                'cadenza'        => 'required'
            ]);
            $nome = $validateData['custom'];
        }

        $bisogno = Bisogno::find($codice_bisogno);

        $bisogno->codice_pianta = $request->codice_pianta;
        $bisogno->nome = $nome;
        $bisogno->cadenza = ($request->cadenza)*86400;

        $bisogno->save();
        return redirect()->route('pianta.show', $request->codice_pianta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bisogno = Bisogno::find($id)->delete();
        return redirect()->back();
    }
}
