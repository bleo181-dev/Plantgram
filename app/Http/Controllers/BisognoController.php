<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bisogno;

class BisognoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codice_pianta)
    {
        $bisogni = Bisogno::where('codice_pianta', $codice_pianta)->get();

        return view('bisogno.index', compact('bisogni', 'codice_pianta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function create($id)
=======
    public function create($codice_pianta)
>>>>>>> 4eb115aff189d3ec3dab89a69e43c733fc0053cf
    {
        return view('bisogno.create', compact('codice_pianta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
<<<<<<< HEAD
        $validateData = $request->validate([
            'nome'   => 'required|max:1000', 
            'cadenza'    => 'required',
        ]);

        Bisogno::create([
            'codice_pianta' => $id,
            'nome'    => $validateData['nome'],
            'cadenza'   => $validateData['cadenza'],
        ]);

        $bisogni = Bisogno::where('codice_pianta', $id)->get();

        return view('bisogno.index', compact('bisogni', 'id'));
=======
        $validateData = $request->validate([ 
            'nome'           => 'required|max:100', 
            'cadenza'        => 'required'
        ]);                     

        Bisogno::create([
            'codice_pianta'   => $request->codice_pianta,
            'nome'            => $validateData['nome'],
            'cadenza'         => $validateData['cadenza'],
        ]);

        return redirect()->route('bisogno.index', $request->codice_pianta);
>>>>>>> 4eb115aff189d3ec3dab89a69e43c733fc0053cf
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
        $bisogno = Bisogno::find($id);
        return view('bisogno.edit', compact('bisogno'));
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
        $validateData = $request->validate([
            'nome'           => 'required|max:100', 
            'cadenza'        => 'required'
        ]);

        $bisogno = Bisogno::find($codice_bisogno); 

        $bisogno->codice_pianta = $request->codice_pianta;
        $bisogno->nome = $request->nome; 
        $bisogno->cadenza = $request->cadenza;

        $bisogno->save();
        return redirect()->route('bisogno.index', $request->codice_pianta);
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
