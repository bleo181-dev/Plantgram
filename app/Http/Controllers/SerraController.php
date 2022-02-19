<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Notification;
use App\Notifications\InvitoNotification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;
use App\Bisogno;
use App\Evento;
use App\Serra;
use App\Pianta;
use App\User;
use App\Invito;
use App\Collabora;
use App\Pubblicita;
use Collator;

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
            $pubblicita=Pubblicita::all();
            $serra = Serra::where('id', auth()->id())->first();
            if($serra == null){
                return view('serra.create');
            }else{
                $pubblicita=Pubblicita::all();
                $piante = Pianta::where('codice_serra', $serra->codice_serra)->get();
                $cod_pianta = Pianta::where('codice_serra', $serra->codice_serra)->pluck('codice_pianta');
                $eventi = collect();
                foreach($cod_pianta as $c){
                    $evento = Bisogno::Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                                ->where('evento.codice_pianta', $c)
                                ->orderBy('data', 'desc')
                                ->get()
                                ->unique('nome');
                    $eventi = $eventi->merge($evento);
                }

                $dataoggi = strtotime(date('Y-m-d H:i:s'));
                $delta = strtotime($eventi);
                $bisogni = Bisogno::whereIn('codice_pianta', $cod_pianta)->get(); 
                    
                $num_collaborazioni = Collabora::where('codice_serra', $serra->codice_serra)->count();
                $collaboratori = DB::table('users')
                        ->join('collabora', 'users.id', '=', 'collabora.id')
                        ->where('codice_serra', $serra->codice_serra)
                        ->get();

                $id = auth()->id();
                $serre_condivise = DB::table('collabora')
                        ->join('serra', 'collabora.codice_serra', '=', 'serra.codice_serra')
                        ->join('users', 'serra.id', '=', 'users.id')
                        ->where('collabora.id', $id)
                        ->get();

                $lat_serra = Serra::where('id', auth()->id())->pluck('latitudine')->first();
                $long_serra = Serra::where('id', auth()->id())->pluck('longitudine')->first();
                $nome_serra = Serra::where('id', auth()->id())->pluck('nome')->first();
                $nickname_utente = User::where('id', auth()->id())->pluck('nickname')->first();

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
                    return view('serra.index', compact('piante', 'pubblicita','bisogni', 'eventi', 'dataoggi', 'forecast', 'forecast_data', 'nome_serra', 'nickname_utente', 'serra', 'num_collaborazioni', 'collaboratori', 'serre_condivise'));

                }else {
                    return view('/auth/login');
                }
            }

        }else {
            return view('/auth/login');
        }
    }


    public function fetch_data_serre(Request $request){

        if($request->ajax())
        {
            $id = auth()->id();
            $data = Collabora::join('serra', 'collabora.codice_serra', '=', 'serra.codice_serra')
                        ->join('users', 'serra.id', '=', 'users.id')
                        ->where('collabora.id', $id)
                        ->select('serra.codice_serra','serra.nome', 'collabora.codice_collaborazione')
                        ->get();
            //$data=Collabora::all();
            return json_encode($data);
        }
    }

    public function __construct()
    {
        $this->middleware('auth')->except('handle_collab');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()){


            $serra = Serra::where('id', auth()->id())->pluck('codice_serra')->first();

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
            'id' => auth()->id(),
            'nome'          => $validateData['nome'],
            'latitudine'    => $validateData['latitudine'],
            'longitudine'   => $validateData['longitudine'],
            'capienza'      => $validateData['capienza'],
        ]);
        $pubblicita=Pubblicita::all();
        $serra = Serra::where('id', auth()->id())->first();
        $piante = Pianta::where('codice_serra', $serra->codice_serra)->get();
        $cod_pianta = Pianta::where('codice_serra', $serra->codice_serra)->pluck('codice_pianta');
        $eventi = Evento::whereIn('codice_pianta', $cod_pianta)->get();
        $dataoggi = strtotime(date('Y-m-d H:i:s'));
        $delta = strtotime($eventi);
        $bisogni = Bisogno::whereIn('codice_pianta', $cod_pianta)->get();

        $num_collaborazioni = Collabora::where('codice_serra', $serra->serra)->count();
        $collaboratori = DB::table('users')
                        ->join('collabora', 'users.id', '=', 'collabora.id')
                        ->pluck('nickname');

        $id = auth()->id();
        $serre_condivise = DB::table('collabora')
                        ->join('serra', 'collabora.codice_serra', '=', 'serra.codice_serra')
                        ->join('users', 'serra.id', '=', 'users.id')
                        ->where('collabora.id', $id)
                        ->get();

        $lat_serra = Serra::where('id', auth()->id())->pluck('latitudine')->first();
        $long_serra = Serra::where('id', auth()->id())->pluck('longitudine')->first();
        $nome_serra = Serra::where('id', auth()->id())->pluck('nome')->first();
        $nickname_utente = User::where('id', auth()->id())->pluck('nickname')->first();

        $id = auth()->id();
        $serre_condivise = DB::table('collabora')
                ->join('serra', 'collabora.codice_serra', '=', 'serra.codice_serra')
                ->join('users', 'serra.id', '=', 'users.id')
                ->where('collabora.id', $id)
                ->get();


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
            return view('serra.index', compact('piante', 'pubblicita','bisogni', 'eventi', 'dataoggi', 'forecast', 'forecast_data', 'nome_serra', 'nickname_utente', 'serra', 'num_collaborazioni', 'collaboratori', 'serre_condivise'));

        }else {
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
        //if(!Auth::user()){
                $serra = Serra::where('id', $id)->first();
                $piante = Pianta::where('codice_serra', $serra->codice_serra)->where('stato', '1')->get(); //piante pubbliche
                $cod_pianta = Pianta::where('codice_serra', $serra->codice_serra)->pluck('codice_pianta');
                $eventi = collect();
                foreach($cod_pianta as $c){
                    $evento = Bisogno::Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                                ->where('evento.codice_pianta', $c)
                                ->orderBy('data', 'desc')
                                ->get()
                                ->unique('nome');
                    $eventi = $eventi->merge($evento);
                }

                $dataoggi = strtotime(date('Y-m-d H:i:s'));
                $delta = strtotime($eventi);
                $bisogni = Bisogno::whereIn('codice_pianta', $cod_pianta)->get();

                $nickname_utente = User::where('id', $id)->pluck('nickname')->first();
                $nome_serra = Serra::where('id', $id)->pluck('nome')->first();

                if( Auth::check() )
                {
                    return view('serra.show', compact('piante', 'bisogni', 'eventi', 'dataoggi', 'nickname_utente', 'serra', 'nome_serra'));

                }else {
                    return view('/auth/login');
                }
            

        //}else {
        //    return view('/auth/login');
        //}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->admin === 'AD'){
            $serra = Serra::find($id);
            return view('serra.edit', compact('serra'));
        }else{
            return redirect()->route('home');
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
        if(Auth::user()->admin === 'AD'){
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
        }else{
            return redirect()->route('home');
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
        if(Auth::user()->admin === 'AD'){

            $serra=Serra::find($id);
            $serra->delete();

            return redirect()->route('pianta.index');
        }else{
            return redirect()->route('home');
        }
    }

    // mostra il form di collaborazione
    public function collab()
    {
        if(Auth::user()){
            return view('serra.collab');
        }else{
            return redirect()->route('home');
        }
    }

    // spedisce email collaborazione
    public function process_collab(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        $validator->after(function ($validator) use ($request) {
            $codice_serra = Serra::where('id', auth()->id())->pluck('codice_serra')->first();
            $email = $request->input('email');
            $codice_collaboratore = User::where('email', $email)->pluck('id')->first();
            if (Collabora::where('codice_serra', $codice_serra)->where('id', $codice_collaboratore)->exists()) {
                $validator->errors()->add('Collaboratore', 'Utente già collaboratore nella tua serra');
            }
            if(User::where('id', auth()->id())->pluck('email')->first() == $email){
                $validator->errors()->add('email', 'Non puoi essere collaboratore della tua stessa serra');
            }
            if($codice_collaboratore == null){
                $validator->errors()->add('email', 'non è presente sulla nostra piattaforma');
                return redirect()->route('serra.index');
            }
        });
        if ($validator->fails()) {
            return redirect(route('invito_view'))
                ->withErrors($validator)
                ->withInput();
        }
        do {
            $token = Str::random(20);
        } while (Invito::where('token', $token)->first());

        $email = $request->input('email');
        $cod_collaboratore = User::where('email', $email)->pluck('id')->first();
        $serra = Serra::where('id', auth()->id())->first();

            Collabora::create([
                'id'  => $cod_collaboratore,
                'codice_serra'   => $serra->codice_serra
            ]);

        Invito::create([
            'token' => $token,
            'email' => $request->input('email'),
            'codice_serra' => $serra,
            'id' => $cod_collaboratore
        ]);
        $url = URL::temporarySignedRoute(

            'handle_collab', now()->addMinutes(3600), ['token' => $token]
        );

        Notification::route('mail', $request->input('email'))->notify(new InvitoNotification($url));

        return  redirect()->route('serra.index');
    }

    public function handle_collab($token)
    {
            $codice_serra = Invito::where('token', $token)->pluck('codice_serra')->first();
            $email = Invito::where('token', $token)->pluck('email')->first();
            $cod_collaboratore = Invito::where('token', $token)->pluck('id')->first();
            if($cod_collaboratore == 0){
                $invito = Invito::where('token', $token)->first();
                $invito->delete();
                return view('auth.register', compact('email', 'cod_collaboratore'));
            }else{
                    $invito = Invito::where('token', $token)->first();
                    $invito->delete();
                    return view('/auth/login');
            }
    }

    public function indexserrashare($id)
    {
        $serra=Serra::where('codice_serra',$id)->first();
        if(Auth::user()){
            if($serra == null){
                return view('serra.create');
            }else{
                $piante = Pianta::where('codice_serra', $serra->codice_serra)->get();
                $cod_pianta = Pianta::where('codice_serra', $serra->codice_serra)->pluck('codice_pianta');
                $eventi = collect();
                foreach($cod_pianta as $c){
                    $evento = Bisogno::Join('evento', 'evento.codice_bisogno', '=', 'bisogno.codice_bisogno')
                                ->where('evento.codice_pianta', $c)
                                ->orderBy('data', 'desc')
                                ->get()
                                ->unique('nome');
                    $eventi = $eventi->merge($evento);
                }
                $pubblicita=Pubblicita::all();
                $dataoggi = strtotime(date('Y-m-d H:i:s'));
                $bisogni = Bisogno::whereIn('codice_pianta', $cod_pianta)->get();

                $num_collaborazioni = Collabora::where('codice_serra', $serra)->count();
                $collaboratori = DB::table('users')
                        ->join('collabora', 'users.id', '=', 'collabora.id')
                        ->pluck('nickname');

                $id = Serra::where('codice_serra', $serra->codice_serra)->pluck('id')->first();
                $serre_condivise = DB::table('collabora')
                        ->join('serra', 'collabora.codice_serra', '=', 'serra.codice_serra')
                        ->join('users', 'serra.id', '=', 'users.id')
                        ->where('collabora.id', $id)
                        ->get();

                $lat_serra = Serra::where('id', $id)->pluck('latitudine')->first();
                $long_serra = Serra::where('id', $id)->pluck('longitudine')->first();
                $nome_serra = Serra::where('id', $id)->pluck('nome')->first();
                $nickname_utente = User::where('id', Auth()->id())->pluck('nickname')->first();

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
                    return view('serra.index', compact('piante', 'bisogni', 'pubblicita', 'eventi', 'dataoggi', 'forecast', 'forecast_data', 'nome_serra', 'nickname_utente', 'serra', 'num_collaborazioni', 'collaboratori', 'serre_condivise'));

                }else {
                    return view('/auth/login');
                }
            }

        }else {
            return view('/auth/login');
        }
    }


}

