<?php

namespace App\Http\Controllers;

use App\Kurir;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Kurir::get();
        return view('kurir.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kurir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $messages = [
                'name.required' => 'Nama kurir harap diisi',
                'email.email' => 'Pastikan value yang terinput berformat email',
                'email.required' => 'Harap isi email terlebih dulu',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harap diisi'
            ];
            $validator = Validator::make($request->all(), [
                'name'=> 'required',
                'email' => 'required|email|unique:users',
                'password'=> 'required'
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
            }

            $kurir = new Kurir();
            $kurir->name = $request->input('name');
            $kurir->email = $request->input('email');
            $kurir->password = 'test';
            $kurir->save();
    
            User::create([
                'name' => $kurir->name,
                'email' => $kurir->email,
                'password' => $kurir->password,
                'level' => 2
            ]);
    
            return \redirect('kurir')->with('success', 'Tambah data berhasil');
        } catch (\Throwable $th) {
            // return Redirect::back()->withErrors(['error_msg'=> $th->getMessage()]);
            return Redirect::back()->withErrors(['error_msg'=> 'Tambah data gagal']);
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
        $detail = Kurir::find($id);

        return view('kurir.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $detail = Kurir::find($id);

        return view('kurir.edit', compact('detail'));
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
        try {
            $messages = [
                'name.required' => 'Nama kurir wajib diisi',
                'password.required' => 'Password wajib diisi'
            ];
            $validator = Validator::make($request->all(), [
                'name'=> 'required',
                'password'=> 'required'
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
            }
            $kurir = Kurir::find($id);
            $prev_email = $kurir->email;
            $kurir->name = $request->input('name');
            $kurir->email = $request->input('email');
            $kurir->password = Hash::make($request->input('password'));
            $user = User::where('email',$prev_email)->first();

            if ($prev_email != $kurir->email){
                $userExist = User::where('email',$kurir->email)->first();
                dump($userExist);
                if (!empty($userExist)) {
                    return Redirect::back()->withErrors(['email' => 'Email sudah terdaftar'])->withInput($request->all());;
                }
                
            }

            $kurir->save();
    
            $user->name = $sales->name;
            $user->email = $sales->email;
            $user->password = $sales->password;
            $user->save();
    
            return \redirect('kurir')->with('success', 'Ubah data berhasil');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['error_msg'=> 'Ubah data gagal']);
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
        $barang = Kurir::find($id);
        $barang->delete();
        
        $user = User::where('email',$sales->email)->delete();

        return \redirect('barang')->with('success', 'Delete data berhasil');
    }
}
