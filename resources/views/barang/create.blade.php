@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/barang') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('barang')}}">
                            @csrf
                            <h1>Form Insert</h1>
                            <div class="form-group">

                                <label for="kode_barang">Kode Barang</label>
                                @error('kode_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                       placeholder="Kode barang akan digenerate bila kosong">

                                <label for="nama_barang" class="required">Nama Barang</label>
                                @error('nama_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                       placeholder="Masukkan nama barang" required>
                                       
                                <label for="stok" class="required">Stok</label>
                                @error('stok_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan stok barang" name="stok_barang"
                                       id="stok_barang">
                                
                                <label for="stok" class="required">Harga</label>
                                @error('harga_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan stok barang" name="harga_barang"
                                       id="harga_barang">
                            </div>
                            
                            @error('error_msg')
                                <div class="error">{{ $errors->first('error_msg') }}</div>
                                @enderror
                            <button type="submit" class="form-control btn btn-warning">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js-css')
    <script>
        function validasi(data) {
            if (data < 0) {
                alert('Data input tidak boleh kurang dari 0');
            }
        }

        jQuery(function ($) {
        });
    </script>
@endsection
