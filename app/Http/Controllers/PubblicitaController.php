<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pubblicita;

class PubblicitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annunci=Pubblicita::all();
        return view('pubblicita.index', compact('annunci'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pubblicita.create');
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
            'url'       => 'required|max:1000',
            'foto'      => 'required',
            'produttore'=> 'required',
            'prodotto'=> 'required',
            'priorita'=> 'required',
        ]);

        $data = file_get_contents($_FILES['foto']['tmp_name']);

        Pubblicita::create([
            'url'       => $validateData['url'],
            'produttore'=> $validateData['produttore'],
            'prodotto'=> $validateData['prodotto'],
            'foto'      => $data,
            'priorita'  => $validateData['priorita'],
        ]);

        $annunci=Pubblicita::all();
        return view('pubblicita.index', compact('annunci'));
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
        $pubblicita=Pubblicita::find($id);
        return view('pubblicita.edit', compact('pubblicita'));
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
            'produttore'    => 'required|max:1000',
            'prodotto'      => 'required',
            'foto'          => 'nullable',
            'url'           => 'required',
            'priorita'      => 'required',
        ]);



        $input = $request->all();
        $pubblicita = Pubblicita::find($id);

        $pubblicita->produttore = $input['produttore'];
        $pubblicita->prodotto = $input['prodotto'];
        $pubblicita->url = $input['url'];
        $pubblicita->priorita = $input['priorita'];

        if(!empty($input['foto'])){
            $data = file_get_contents($_FILES['foto']['tmp_name']);
            $pubblicita->foto = $data;
        }

        $pubblicita->save();

        $annunci=Pubblicita::all();
        return view('pubblicita.index', compact('annunci'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pubblicita=Pubblicita::find($id);
        $pubblicita->delete();

        $annunci=Pubblicita::all();
        return view('pubblicita.index', compact('annunci'));
    }
}
