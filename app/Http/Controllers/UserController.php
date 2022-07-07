<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Serra;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        if(Auth::user()->admin === 'AD'){
            return view('user.index', compact('users'));
        }else{
            return redirect()->route('home');
        }

    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nickname'          => 'required', 'unique:users','string', 'max:100',
            'foto'              => 'required',
            'email'             => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password'          => 'required', 'string', 'min:8', 'confirmed',
        ]);

        $data = file_get_contents($_FILES['foto']['tmp_name']);

        User::create([
            'nickname'          => $request['nickname'],
            'foto'              => $data,
            'email'             => $request['email'],
            'password'          => Hash::make($request['password']),
            'admin'             => "nopro",
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(($id == auth()->id() ) || (Auth::user()->admin) ){
            $user = User::find($id);
            return view('user.edit', compact('user'));
        }else{
            return redirect()->route('user.edit', auth()->id());
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
        $request->validate([
            'nickname'     => 'required', 'unique:users','string', 'max:100',
            'foto'         => 'nullable',
            'email'        => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password'     => 'required', 'string', 'min:8', 'confirmed',
        ]);

        if(Auth::user()->admin === 'AD'){
            $user = User::find($id);
        }else if(Auth::user()){
            $user = Auth::user();
        }

        $user->nickname = $request['nickname'];
        $user->email = $request['email'];
        if(!empty($request['foto'])){
            $data = file_get_contents($_FILES['foto']['tmp_name']);
            $user->foto = $data;
        }
        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $utente=User::find($id);
        $utente->delete();

        if(Auth::user()->admin === 'AD')
        {
            return redirect()->route('user.index');
        }else{
            return redirect()->route('serra.index');
        }

    }

    public function upgrade($id){
        $utente = User::find($id);
        return view('user.upgradeform', compact('utente'));     
    }

    public function storeupgrade(Request $request, $id){
        $request->validate([
            'scelta'     => 'required'
        ]);

        if($request['scelta'] == 'no'){
            return redirect()->route('serra.index');
        }else{
            $serra = Serra::where('id', $id)->first();
            $utente = User::find($id);
            $serra->capienza = 999;
            $utente->admin = "pro";
            $utente->save();
            $serra->save();
            return redirect()->route('serra.index');
        }
    }


}
