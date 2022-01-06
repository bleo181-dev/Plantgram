<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pianta;
use App\Serra;
use App\Diario;
use App\Evento;
use App\Bisogno;
use Auth;


class PiantaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin){
            $piante = Pianta::all();
            return view('pianta.index', compact('piante'));
        }else{
            return redirect()->route('serra.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()){
            return view('pianta.create');
        }else{
            return view('/auth/login');
        }

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
            'nome'         => 'required|max:100',
            'foto'         => 'required', //discutibile, per ora lo metto per evitare di rompere l'intefaccia
            'luogo'        => 'required|max:100',
            'stato'        => 'required'
        ]);

        $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();

        $data = file_get_contents($_FILES['foto']['tmp_name']);

        Pianta::create([
            'codice_serra'  => $serra,
            'nome'          => $validateData['nome'],
            'foto'          => $data,
            'luogo'         => $validateData['luogo'],
            'stato'         => $validateData['stato'],
        ]);

        return redirect()->route('serra.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()){

            if(Auth::user()->admin){

                $pianta = Pianta::find($id);
                //$userId = Serra::where('codice_serra', $pianta->codice_serra)->pluck('codice_utente')->first();
                $diario = Diario::where('codice_pianta',$id)->get();
                $eventi = Bisogno::Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                                ->where('evento.codice_pianta', $id)->get();

                return view('pianta.show', compact('pianta','diario','eventi'));

            }else if(Auth::user()){

                $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();
                $pianta = Pianta::where('codice_pianta', '=', $id)
                            ->where('codice_serra', '=', $serra)
                            ->get()->first();

                $diario = Diario::where('codice_pianta',$id)
                                //->where('codice_utente','=', auth()->id())
                                ->get();

                $eventi = Bisogno::Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                                ->where('evento.codice_pianta', $id)
                                //->where('evento.codice_utente', auth()->id())
                                ->get();

                if($pianta == null){
                    return redirect()->route('home');
                }else{
                    return view('pianta.show', compact('pianta','diario','eventi'));
                }

                }

        }else{
            return view('/auth/login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()){

            if(Auth::user()->admin){

                $pianta = Pianta::find($id);
                return view('pianta.edit', compact('pianta'));

            }elseif(Auth::user()){

                $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();
                $pianta = Pianta::where('codice_pianta', '=', $id)
                                ->where('codice_serra', '=', $serra)
                                ->get()->first();

                if($pianta == null){
                    return redirect()->route('home');
                }else{
                    return view('pianta.edit', compact('pianta'));
                }
            }

        }else{
            return view('/auth/login');
        }
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
        if(Auth::user()){

            $validateData = $request->validate([
                'codice_serra' => 'required',
                'nome'         => 'required|max:100',
                'foto'         => 'nullable',
                'luogo'        => 'required|max:100',
                'stato'        => 'required'
            ]);

            $input = $request->all();
            if(Auth::user()->admin){
                $pianta = Pianta::find($id);
            }else{
                $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();
                    $pianta = Pianta::where('codice_pianta', '=', $id)
                                    ->where('codice_serra', '=', $serra)
                                    ->get()->first();
            }


            $pianta->codice_serra = $input['codice_serra'];
            $pianta->nome = $input['nome'];
            $pianta->luogo = $input['luogo'];
            if(!empty($input['foto'])){
                $data = file_get_contents($_FILES['foto']['tmp_name']);
                $pianta->foto = $data;
            }
            $pianta->stato = $input['stato'];

            $pianta->save();
            return redirect()->route('serra.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()){
            if(Auth::user()->admin){
                $pianta = Pianta::where('codice_pianta', $id)
                            ->delete();
                return redirect()->route('pianta.index');
            }else{
                $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();
                $pianta = Pianta::where('codice_pianta', '=', $id)
                                ->where('codice_serra', '=', $serra)
                                ->delete();
                return redirect()->route('serra.index');
            }

        }
    }
}
