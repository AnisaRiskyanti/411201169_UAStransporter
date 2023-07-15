@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Barang</h1>
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('barang/create')}}">
                                <button type="button" class="btn btn-warning">Add New</button>
                            </a>
                        </div>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1
                            ?>
                            @foreach($list as $key => $value)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->kode_barang }}</td>
                                    <td>{{ $value->nama_barang }}</td>
                                    <td>{{ $value->stok_barang }}</td>
                                    <td>Rp. @convert($value->harga_barang)</td>
                                    <td>
                                        <a href="{{url('barang/'.$value->id) }}">
                                            <button type="button" class="btn btn-warning">View
                                            </button>
                                        </a>
                                        <a href="{{url('barang/'.$value->id) .'/edit'}}">
                                            <button type="button" class="btn btn-warning">Edit
                                            </button>
                                        </a>
                                        <form method="POST" action={{url('barang/'.$value->id)}}>
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-warning">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

