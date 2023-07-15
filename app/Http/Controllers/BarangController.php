<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Barang::get();
        return view('barang.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('barang.create');
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
                'nama_barang.required' => 'Nama barang harap diisi',
                'stok_barang.required' => 'Stok barang harap diisi',
                'stok_barang.numeric' => 'Harap isi stok barang dengan angka',
                'harga_barang.required' => 'Harga barang harap diisi',
                'harga_barang.numeric' => 'Harap isi harga barang dengan angka'
            ];

            if (!$request->filled('kode_barang')) {
                $latestId = Barang::max('id');
                if(strlen($latestId+1)==3) { $prefix = '0'; }
                elseif(strlen($latestId+1)==2) { $prefix = '00'; }
                else $prefix = '000';
                $new_code = 'BRG-'.$prefix.($latestId+1);
                $kode_barang = $new_code;
            }

            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required',
                'stok_barang'=>'required|numeric|min:0',
                'harga_barang'=>'required|numeric|min:0'
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
            }
            $barang = new Barang();
            $barang->kode_barang = $kode_barang ?? $request->input('kode_barang');
            $barang->nama_barang  = $request->input('nama_barang');
            $barang->deskripsi  = $request->input('deskripsi');
            $barang->stok_barang = $request->input('stok_barang') ?? 0;
            $barang->harga_barang = $request->input('harga_barang') ?? 0;
            $barang->save();
    
            return \redirect('barang')->with('success', 'Tambah data berhasil');
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
        $detail = Barang::find($id);

        return view('barang.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = Barang::find($id);

        return view('barang.edit', compact('detail'));
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
                'nama_barang.required' => 'Nama barang harap diisi',
                'stok_barang.required' => 'Stok barang harap diisi',
                'stok_barang.numeric' => 'Harap isi stok barang dengan angka',
                'harga_barang.required' => 'Harga barang harap diisi',
                'harga_barang.numeric' => 'Harap isi harga barang dengan angka'
            ];

            if (!$request->filled('kode_barang')) {
                $latestId = Barang::max('id');
                if(strlen($latestId+1)==3) { $prefix = '0'; }
                elseif(strlen($latestId+1)==2) { $prefix = '00'; }
                else $prefix = '000';
                $new_code = 'BRG-'.$prefix.($latestId+1);
                $kode_barang = $new_code;
            }

            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required',
                'stok_barang'=>'required|numeric|min:0',
                'harga_barang'=>'required|numeric|min:0'
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
            }

            $barang = Barang::query()->where('kode_barang', $request->input('kode_barang'))->first();
            if (!empty($barang)) {
                if ($barang->id != $id) {
                    return Redirect::back()->withErrors(['error_msg' => "Kode barang sudah terdaftar"]);
                }
            }
            
            $barang = Barang::find($id);
            $barang->kode_barang = $kode_barang ?? $request->input('kode_barang');
            $barang->nama_barang  = $request->input('nama_barang');
            $barang->deskripsi  = $request->input('deskripsi');
            $barang->stok_barang = $request->input('stok_barang') ?? 0;
            $barang->harga_barang = $request->input('harga_barang') ?? 0;
            $barang->save();

            return \redirect('barang')->with('success', 'Ubah data berhasil');
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
      
        $barang = Barang::find($id);
        $barang->delete();

        return \redirect('barang')->with('success', 'Delete data berhasil');
    }
}
