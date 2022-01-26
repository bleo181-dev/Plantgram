<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Collabora;
use App\Serra;
use Collator;

class CollaboraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codice_utente = auth()->id();
        $serre_condivise = DB::table('collabora')
                ->join('serra', 'collabora.codice_serra', '=', 'serra.codice_serra')
                ->join('users', 'serra.codice_utente', '=', 'users.codice_utente')
                ->where('collabora.codice_utente', $codice_utente)
                ->get();
        return view('collabora.index', compact('serre_condivise'));
    }

    public function fetch_data(Request $request){

        if($request->ajax())
        {
            //$data = Collabora::all();
            $serra = Serra::where('codice_utente', auth()->id())->first();
            $data = DB::table('users')
                        ->join('collabora', 'users.codice_utente', '=', 'collabora.codice_utente')
                        ->where('codice_serra', $serra->codice_serra)
                        ->select('codice_collaborazione', 'nickname')
                        ->get();
            return json_encode($data);
        }





    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
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
        if(Auth::user()){
            if(Auth::user()->admin){
                $collaborazione = Collabora::where('codice_collaborazione', $id)
                                            ->delete();
                return response()->json([
                    'success' => 'Record has been deleted successfully!'
                ]);
            }else{
                $serra_proprietario = DB::table('users')
                                        ->join('serra', 'users.codice_utente', '=', 'serra.codice_utente')
                                        ->where('users.codice_utente', auth()->id())
                                        ->pluck('codice_serra');
                $collaborazione = Collabora::where('codice_collaborazione', $id)->pluck('codice_serra');
                Collabora::where('codice_collaborazione', '=', $id)
                            ->where($serra_proprietario , '=', $collaborazione)
                            ->delete();
                return response()->json([
                    'success' => 'Record has been deleted successfully!'
                ]);
            }

        }


    }
}
