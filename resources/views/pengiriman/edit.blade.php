@extends('layout')
@section('content')
    @push('style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/pengiriman') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('pengiriman/'.$detail->id)}}">
                            @csrf
                            @method('PUT')
                            <h1>Form Update</h1>
                            <div class="form-group">
                            <label for="name" class="required">No Pengiriman</label>
                                @error('no_pengiriman')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="no_pengiriman" name="no_pengiriman"
                                       placeholder="Masukkan no pengiriman" required value={{$detail['no_pengiriman']}}>

                                <label for="name" class="required">Kurir</label>
                                @error('kurir_id')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                @error('kurir_name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                {{ Form::select('kurir_id',$kurir, $detail['kurir_id'],['class' => 'form-control','placeholder'=> '-- Pilih --', 'id' => 'kurir_select', 'disabled' => $defaultKurirID ? 'disabled' : null]) }}
                                <input type="hidden" name="kurir_name" id="kurir_name" value="{{ $detail['kurir_name'] }}">

                                <label for="name" class="required">Barang</label>
                                @error('barang_id')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                @error('barang_name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                {{ Form::select('barang_id',$barang, $detail['barang_id'],['class' => 'form-control','placeholder'=> '-- Pilih --', 'id' => 'barang_select']) }}
                                <input type="hidden" name="barang_name" id="barang_name" value={{$detail['barang_name']}}>

                                <label for="name" class="required">Lokasi</label>
                                @error('lokasi_id')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                @error('lokasi_name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                {{ Form::select('lokasi_id',$lokasi, $detail['lokasi_id'],['class' => 'form-control','placeholder'=> '-- Pilih --', 'id' => 'lokasi_select']) }}
                                <input type="hidden" name="lokasi_name" id="lokasi_name" value={{$detail['lokasi_name']}}>

                                <label for="stok" class="required">Jumlah Barang</label>
                                @error('jumlah_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan Jumlah Barang" name="jumlah_barang"
                                       id="jumlah_barang" value={{$detail['jumlah_barang']}}>

                                <label for="stok" class="required">Harga Barang</label>
                                @error('harga_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan Harga Barang" name="harga_barang"
                                       id="harga_barang"  value={{$detail['harga_barang']}}>

                                <label for="tanggal" class="required">Tanggal Transaksi</label>
                                @error('tanggal')
                                @if($errors->has('tanggal'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('tanggal') }}</strong>
                                </span>
                                @endif
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="datetime-local" class="form-control" placeholder="Pilih Tanggal" name="tanggal"  value={{$detail['tanggal']}}>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Listen for the change event of the select element
            $('#kurir_select').change(function() {
                // Get the selected option
                var selectedOption = $(this).children('option:selected');
                
                // Get the kurir name from the selected option
                var kurirName = selectedOption.text();
                
                // Set the value of the hidden input field
                $('#kurir_name').val(kurirName);
            });

            $('#barang_select').change(function() {
                // Get the selected option
                var selectedOption = $(this).children('option:selected');
                
                // Get the kurir name from the selected option
                var barangName = selectedOption.text();
                
                // Set the value of the hidden input field
                $('#barang_name').val(barangName);
            });

            $('#lokasi_select').change(function() {
                // Get the selected option
                var selectedOption = $(this).children('option:selected');
                
                // Get the kurir name from the selected option
                var lokasiName = selectedOption.text();
                
                // Set the value of the hidden input field
                $('#lokasi_name').val(lokasiName);
            });
        });
    </script>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=datetime-local]");
    </script>
@endpush
@section('custom-js-css')
    <script>
        function validasi(data) {
            if (data < 0) {
                alert('Data input tidak boleh kosong');
            }
        }

        jQuery(function ($) {
        });
    </script>
@endsection

