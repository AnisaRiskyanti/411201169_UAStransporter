<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Lokasi::get();
        return view('lokasi.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lokasi.create');
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
                'nama_lokasi.required' => 'Nama Lokasi harap diisi'
            ];

            if (!$request->filled('kode_lokasi')) {
                $latestId = Lokasi::max('id');
                if(strlen($latestId+1)==3) { $prefix = '0'; }
                elseif(strlen($latestId+1)==2) { $prefix = '00'; }
                else $prefix = '000';
                $new_code = 'LOK-'.$prefix.($latestId+1);
                $kode_lokasi = $new_code;
            }

            $validator = Validator::make($request->all(), [
                'nama_lokasi' => 'required'
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
            }
            $lokasi = new Lokasi();
            $lokasi->kode_lokasi = $kode_lokasi ?? $request->input('kode_lokasi');
            $lokasi->nama_lokasi  = $request->input('nama_lokasi');
            $lokasi->save();
    
            return \redirect('lokasi')->with('success', 'Tambah data berhasil');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['error_msg'=>$th]);
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
        $detail = Lokasi::find($id);

        return view('lokasi.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = Lokasi::find($id);

        return view('lokasi.edit', compact('detail'));
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
                'nama_lokasi.required' => 'Nama lokasi harap diisi'
            ];

            if (!$request->filled('kode_lokasi')) {
                $latestId = Lokasi::max('id');
                if(strlen($latestId+1)==3) { $prefix = '0'; }
                elseif(strlen($latestId+1)==2) { $prefix = '00'; }
                else $prefix = '000';
                $new_code = 'BRG-'.$prefix.($latestId+1);
                $kode_lokasi = $new_code;
            }

            $validator = Validator::make($request->all(), [
                'nama_lokasi' => 'required'
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
            }

            $lokasi = Lokasi::query()->where('kode_lokasi', $request->input('kode_lokasi'))->first();
            if (!empty($lokasi)) {
                if ($lokasi->id != $id) {
                    return Redirect::back()->withErrors(['error_msg' => "Kode lokasi sudah terdaftar"]);
                }
            }
            
            $lokasi = Lokasi::find($id);
            $lokasi->kode_lokasi = $kode_lokasi ?? $request->input('kode_lokasi');
            $lokasi->nama_lokasi  = $request->input('nama_lokasi');
            $lokasi->save();

            return \redirect('lokasi')->with('success', 'Ubah data berhasil');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['error_msg'=>$th]);
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
      
        $lokasi = Lokasi::find($id);
        $lokasi->delete();

        return \redirect('lokasi')->with('success', 'Delete data berhasil');
    }
}
