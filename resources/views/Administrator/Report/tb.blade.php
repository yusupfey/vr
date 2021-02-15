@extends('layouts.dashboard')
@section('title',' Terima Barang')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered table-collapse" id="dataTable">
                <thead>
                    <th>No Faktur</th>
                    <th>Kode PR</th>
                    <th>Keterangan</th>
                    <th>Diterima</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                    <tr>
                        <td>{{$item->no_faktur}}</td>
                        <td>{{$item->kodePR}}</td>
                        <td>{{$item->keterangan}}</td>
                        <td>{{$item->diterima}}</td>
                        <td>
                            <a href="/Report/pdf/{{$item->id}}" class="btn btn-warning"><i class="fa fa-print"></i></a>
                            <div class="btn btn-info" onclick="receive({{$item->id}})"><i class="fa fa-list"></i></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="receive_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Terima Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                        <table cellpadding="5">
                        <tr>
                            <td>No Faktur</td>
                            <td>:</td>
                            <td class="targetFK"></td>

                        </tr>
                        <tr>
                            <td>Kode PR</td>
                            <td>:</td>
                            <td class="targetKD"></td>
                        </tr>
                        <tr>
                            <td>Diminta oleh</td>
                            <td>:</td>
                            <td class="targetPermintaan"></td>
                        </tr>
                        <tr>
                            <td>Diterima</td>
                            <td>:</td>
                            <td class="targetDiterima"></td>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table table-collapse">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Type</th>
                                        <th>Ukuran</th>
                                        <th>Qty Diterima</th>
                                    </tr>
                                </thead>
                                <tbody class="targetReq">
                                    
                                </tbody>
                            </table>
                        </div>
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
        function receive(id){
            $('#receive_barang').modal('show');
            $('.targetReq').html('')

            $.ajax({
                url:"/report/detailTb/"+id,
                dataType:'json',
                success:function(res){
                    let d = new Date();
                    let day =  d.getDate()
                    let m = d.getMonth() + 1
                    let y = d.getFullYear()
                    let str = y.toString().substr(-2);
                $('.targetFK').html(res[0][0]['no_faktur'])
                $('.targetKD').html(res[0][0]['id_rq']+'/PR/Factory/'+m+'/'+str)
                $('.targetPermintaan').html(res[0][0]['diminta'])
                $('.targetDiterima').html(res[0][0]['diterima'])
                $('.targetTanggal').html(res[0][0]['tanggal'])
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
                }else if(res[0][0]['status']==4){
                    act = "<div class='badge badge-success'>Selesai</div>"
                }else if(res[0][0]['status']==5){
                    act = "<div class='badge badge-success'>Selesai</div>"
                }else{
                    act = "<div class='badge badge-danger'>Menunggu di approve supervisor</div>"
                }
                
                $('.targetStatus').html(act)
            let ket=''
            $.each(res[1], function(ket,item){
                $('.targetReq').append("<tr><td>"+item['nama']+" <input type='hidden' readonly name='id_barang[]' value="+item['code_item']+"  required></td><td>"+item['type']+"</td><td>"+item['ukuran']+"</td><td>"+item['qty_diterima']+"</td></tr>")
            })
            console.log(res)
                }
            })
        }
    </script>
@endsection