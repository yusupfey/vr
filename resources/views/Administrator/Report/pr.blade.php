@extends('layouts.dashboard')
@section('title',' PURCASHING')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered table-collapse" id="dataTable">
                <thead>
                    <th>No Faktur</th>
                    <th>Kode PR</th>
                    <th>Diminta</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                    <tr>
                        <td>{{$item->keterangan}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>{{$item->user}}</td>
                        <td>@if ($item->status ==5)
                            <div class="badge badge-success">
                                Selesai 
                            </div>
                        @endif</td>
                        <td>
                            <a href="/request_check/pdf/{{$item->id}}" class="btn btn-warning"><i class="fa fa-print"></i></a>
                            <div class="btn btn-info" onclick="detail({{$item->id}})"><i class="fa fa-list"></i></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="detail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table cellpadding="5">
                        <tr>
                            <td>Kode PR</td>
                            <td>:</td>
                            <td class="targetKD"></td>
                        </tr>
                        <tr>
                            <td>Permintaan</td>
                            <td>:</td>
                            <td class="targetPermintaan"></td>
                        </tr>
                        <tr>
                            <td>tanggal</td>
                            <td>:</td>
                            <td class="targetTanggal"></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td class="targetKet"></td>
                        </tr>
                        <tr>
                            <td>status</td>
                            <td>:</td>
                            <td class="targetStatus"></td>
                        </tr>
                    </table>
                    <br>
                    <table class="table table-bordered table-striped table table-collapse">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="target">
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            $('#dataTable').dataTable()
        })
        function detail(id){
            $('#detail_modal').modal('show')
            $('.target').html('')
            $.ajax({
                url:"/request_check/detail/"+id,
                dataType:'json',
                success:function(res){
                        let d = new Date();
                            let m = d.getMonth() + 1
                            let y = d.getFullYear()
                            let str = y.toString().substr(-2);
                        $('.targetKD').html(res[0][0]['id']+'/PR/Factory/'+m+'/'+str)
                        $('.targetPermintaan').html(res[0][0]['user'])
                        $('.targetTanggal').html(res[0][0]['created_at'])
                        $('.targetKet').html(res[0][0]['keterangan'])
                        let cek="",act="" 
                        if(res[0][0]['status']==4){
                            act = "<div class='badge badge-info'>Sedang pengiriman</div>"
                        }else if(res[0][0]['status']==1){
                            act = "<div class='badge badge-warning'>On proces</div>"
                        }else if(res[0][0]['status']==2){
                            act = "<div class='badge badge-primary'>Wait to order</div>"
                        }else if(res[0][0]['status']==3){
                            act = "<div class='badge badge-info'>On order</div>"
                        }else if(res[0][0]['status']==5){
                            act = "<div class='badge badge-success'>Selesai</div>"
                        }else{
                            act = "<div class='badge badge-danger'>Menunggu di approve supervisor</div>"
                        }
                        
                        $('.targetStatus').html(act)
                    let ket=''
                    $.each(res[1], function(ket,item){
                        $('.target').append("<tr><td>"+item['nama']+"</td><td>"+item['qty']+"</td><td>"+item['satuan']+"</td><td>"+item['keterangan']+"</td></tr>")
                    })
                    console.log(res[0])
                }
            })
        }
    </script>
@endsection