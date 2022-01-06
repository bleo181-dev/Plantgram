<?php

namespace App\Http\Controllers;

use App\Bisogno;
use App\Evento;
use Illuminate\Http\Request;
use Log;
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
        if(Auth::user()){

            $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();
            if($serra == null){
                return view('serra.create');
            }else{
                $piante = Pianta::where('codice_serra', $serra)->get();
                $cod_pianta = Pianta::where('codice_serra', $serra)->pluck('codice_pianta');
                $eventi = Evento::whereIn('codice_pianta', $cod_pianta)->get();
                $dataoggi = strtotime(date('Y-m-d H:i:s'));
                $delta = strtotime($eventi);
                $bisogni = Bisogno::whereIn('codice_pianta', $cod_pianta)->get();

                $lat_serra = Serra::where('codice_utente', auth()->id())->pluck('latitudine')->first();
                $long_serra = Serra::where('codice_utente', auth()->id())->pluck('longitudine')->first();

                Log::info("Not from cache");
                $APIkey = "d2c909932430658a343ead2d18b1191f";
                $lat = $lat_serra;
                $lon = $long_serra;
                $url = "https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&units=metric&lang=it&appid=${APIkey}";
                Log::info($url);
                $client = new \GuzzleHttp\Client();
                $res = $client->get($url);
                if ($res->getStatusCode() == 200) {
                $j = $res->getBody();
                $obj = json_decode($j);
                $forecast = $obj->current->weather ;
                $forecast_data = $obj->current;
                }

                if( Auth::check() )
                {
                    return view('serra.index', compact('piante', 'bisogni', 'eventi', 'dataoggi', 'forecast', 'forecast_data'));

                }else {
                    return view('/auth/login');
                }
            }

        }else {
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
        if(Auth::user()){


            $serra = Serra::where('codice_utente', auth()->id())->pluck('codice_serra')->first();

            if($serra == null){
                return view('serra.create');
            }else{
                return redirect()->route('serra.index');
            }
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
        $cod_pianta = Pianta::where('codice_serra', $serra)->pluck('codice_pianta');
        $eventi = Evento::whereIn('codice_pianta', $cod_pianta)->get();
        $dataoggi = strtotime(date('Y-m-d H:i:s'));
        $delta = strtotime($eventi);
        $bisogni = Bisogno::whereIn('codice_pianta', $cod_pianta)->get();

        $lat_serra = Serra::where('codice_utente', auth()->id())->pluck('latitudine')->first();
        $long_serra = Serra::where('codice_utente', auth()->id())->pluck('longitudine')->first();

        Log::info("Not from cache");
        $APIkey = "d2c909932430658a343ead2d18b1191f";
        $lat = $lat_serra;
        $lon = $long_serra;
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&units=metric&lang=it&appid=${APIkey}";
        Log::info($url);
        $client = new \GuzzleHttp\Client();
        $res = $client->get($url);
        if ($res->getStatusCode() == 200) {
          $j = $res->getBody();
          $obj = json_decode($j);
          $forecast = $obj->current->weather ;
          $forecast_data = $obj->current;
        }

        if( Auth::check() )
        {
            return view('serra.index', compact('piante', 'bisogni', 'eventi', 'dataoggi', 'forecast', 'forecast_data'));

        } else {
            return view('/auth/login');
        }
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
