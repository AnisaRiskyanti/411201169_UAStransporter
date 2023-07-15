@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Pengiriman</h1>
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('pengiriman/create')}}">
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
                                <th scope="col">Kurir</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Jumlah Barang</th>
                                <th scope="col">Harga Barang</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1
                            ?>
                            @foreach($list as $value)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->kurir_name }}</td>
                                    <td>{{ $value->barang_name }}</td>
                                    <td>{{ $value->lokasi_name }}</td>
                                    <td>{{ $value->jumlah_barang }}</td>
                                    <td>Rp. @convert($value->harga_barang)</td>
                                    <td>{{ date('d-m-Y', strtotime($value->tanggal ))}}</td>
                                    <td>
                                        <a href="{{url('pengiriman/'.$value->id) }}">
                                            <button type="button" class="btn btn-warning">View
                                            </button>
                                        </a>
                                        <a href="{{url('pengiriman/'.$value->id) .'/edit'}}">
                                            <button type="button" class="btn btn-warning">Edit
                                            </button>
                                        </a>
                                        <form method="POST" action={{url('pengiriman/'.$value->id)}}>
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
                        <div class="pagination">
    {{ $list->links('pagination.bootstrap') }}
</div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

