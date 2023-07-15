@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Lokasi</h1>
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('lokasi/create')}}">
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
                                <th scope="col">Kode Lokasi</th>
                                <th scope="col">Nama</th>
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
                                    <td>{{ $value->kode_lokasi }}</td>
                                    <td>{{ $value->nama_lokasi }}</td>
                                    <td>
                                        <a href="{{url('lokasi/'.$value->id) }}">
                                            <button type="button" class="btn btn-warning">View
                                            </button>
                                        </a>
                                        <a href="{{url('lokasi/'.$value->id) .'/edit'}}">
                                            <button type="button" class="btn btn-warning">Edit
                                            </button>
                                        </a>
                                        <form method="POST" action={{url('lokasi/'.$value->id)}}>
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

