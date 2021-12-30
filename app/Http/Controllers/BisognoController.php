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
    public function index($id)
    {
        $bisogni = Bisogno::where('codice_pianta', $id)->get();

        return view('bisogno.index', compact('bisogni', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('bisogno.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
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
        //
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
        //
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
        return redirect()->route('bisogno.index');
    }
}
