@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            Master Supplier
        </div>
        <div class="card-body">
            <a href='/add_supplier' class="btn btn-primary mb-3">+ Supplier</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-collapse" id="dataTable">
                    <thead>
                        <th>No</th>
                        <th>ID</th>
                        <th>Supplier</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($posts as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->id_supplier}}</td>
                                <td>{{$item->supplier}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>{{$item->notel}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            {{-- {{$posts->links()}} --}}
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