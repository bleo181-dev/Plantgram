<?php

namespace App\Http\Controllers;

use App\Bisogno;
use App\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Serra;
use App\Pianta;
use Illuminate\Support\Facades\Auth;

class SerraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();
        $piante = Pianta::where('codice_serra', $serra)->get();
        $cod_pianta = Pianta::where('codice_serra', $serra)->pluck('codice_pianta');
        $eventi = Evento::whereIn('codice_pianta', $cod_pianta)->get();
        $dataoggi = strtotime(date('Y-m-d H:i:s'));
        $delta = strtotime($eventi);
        $bisogni = Bisogno::whereIn('codice_pianta', $cod_pianta)->get();

        if( Auth::check() )
        {
            return view('serra.index', compact('piante', 'bisogni', 'eventi', 'dataoggi'));

        } else {
            return view('/auth/login');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('serra.create');
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
            'nome'          => 'required|max:100',
            'latitudine'    => 'required',
            'longitudine'   => 'required',
            'capienza'      => 'required'
        ]);

        Serra::create([
            'codice_utente' => auth()->id(),
            'nome'          => $validateData['nome'],
            'latitudine'    => $validateData['latitudine'],
            'longitudine'   => $validateData['longitudine'],
            'capienza'      => $validateData['capienza'],
        ]);

        $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();
        $piante = Pianta::where('codice_serra', $serra)->get();
        return view('serra.index', compact('piante'));
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
        $serra = Serra::find($id);
        return view('serra.edit', compact('serra'));
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
            'nome'          => 'required|max:100',
            'latitudine'    => 'required',
            'longitudine'   => 'required',
            'capienza'      => 'required'
        ]);

        $input = $request->all();
        $serra = Serra::find($id);

        $serra->nome = $input['nome'];
        $serra->latitudine = $input['latitudine'];
        $serra->longitudine = $input['longitudine'];
        $serra->capienza = $input['capienza'];

        $serra->save();
        return redirect()->route('serra.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serra=Serra::find($id);
        $serra->delete();

        return redirect()->route('pianta.index');
    }
}
