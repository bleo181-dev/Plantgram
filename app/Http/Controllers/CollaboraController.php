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
        $id = auth()->id();
        $serre_condivise = DB::table('collabora')
                ->join('serra', 'collabora.codice_serra', '=', 'serra.codice_serra')
                ->join('users', 'serra.id', '=', 'users.id')
                ->where('collabora.id', $id)
                ->get();
        return view('collabora.index', compact('serre_condivise'));
    }

    public function fetch_data(Request $request){

        if($request->ajax())
        {
            //$data = Collabora::all();
            $serra = Serra::where('id', auth()->id())->first();
            $data = DB::table('users')
                        ->join('collabora', 'users.id', '=', 'collabora.id')
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
    public function elimina(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        Collabora::find($id)->delete();
        return response()->json(['success' => 'OK', 'id-eliminato' => $id]);

    }

    public function destroy($id){
        //destroy
    }
}
