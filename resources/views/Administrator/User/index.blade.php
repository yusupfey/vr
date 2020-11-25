@extends('layouts.dashboard')
@section('title','MASTER USER')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="/add_barang" class="btn btn-primary mb-3">+ Barang</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-collapse" id="dataTable">
                    <thead>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Staff</th>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($post as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->nik}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->temp_lahir}}, {{$item->tgl_lahir}}</td>
                                <td>{{$item->akses}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            {{-- {{$post->links()}} --}}
            </div>
        </div>
        <div class="card-footer">
            <div style="font-size:12px">
            </div>

        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            $('#dataTable').dataTable();
        });
    </script>
@endsection