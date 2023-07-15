@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/lokasi') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/lokasi')}}">
                            @csrf
                            <h1>Form Insert</h1>
                            <div class="form-group">

                                <label for="kode_lokasi">Kode Lokasi</label>
                                @error('kode_lokasi')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="kode_lokasi" name="kode_lokasi"
                                       placeholder="Kode lokasi akan digenerate bila kosong">

                                <label for="nama_lokasi" class="required">Nama Lokasi</label>
                                @error('nama_lokasi')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi"
                                       placeholder="Masukkan nama lokasi" required>
                            
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
