@extends('layouts.dashboard')
@section('title',' REQUEST DATA')
@section('content')
@if (session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
       {{session()->get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="card">
        <div class="card-header bg-primary">
            Request Barang
        </div>
        <div class="card-body">
            <a href='/request_form' class="btn btn-primary mb-3">+ Request</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-collapse" id="dataTable">
                    <thead>
                        <th>No</th>
                        <th>Request</th>
                        <th>DateTime</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($posts as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    @if ($item->status ==0)
                                        <div class="badge badge-danger">Menunggu</div>
                                    @elseif($item->status ==1)
                                        <div class="badge badge-warning"> On Proses </div>
                                    @elseif($item->status ==2)
                                        <div class="badge badge-primary"> On Order </div>
                                    @elseif($item->status ==3)
                                        <div class="badge badge-info"> Sedang Dikirim </div>
                                    @else
                                    <div class="badge badge-success">Selesai</div>
                                    @endif
                                </td>
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