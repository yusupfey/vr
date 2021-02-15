@extends('layouts.dashboard')
@section('title',' CHECK PURCASHING')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if (session()->has('success'))
                    <script>
                        Swal.fire(
                            'Success!',
                            'Your file has been Approve.',
                            'success'
                            );
                    </script>
                @endif
                <table class="table table-striped table-bordered table-collapse" id="dataTable">
                    <thead>
                        <th>Action</th>
                        <th>Request</th>
                        <th>DateTime</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
                <b>Keterangan</b><br>
                <span class="text-danger">* Approve terlebih dahulu jika ingin melakukan PRINT/FINISH</span>
                {{-- {{::get('id_akses')}} --}}
            </div>
            {{-- {{$posts->links()}} --}}
        </div>
        <div class="card-footer">
            <div style="font-size:12px">
            </div>

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
    <div class="modal fade" id="receive_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Terima Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/terima_barang" method="post">
                <div class="modal-body">
                    @csrf
                        <table cellpadding="5">
                        <tr>
                            <td>No Faktur</td>
                            <td>:</td>
                            <td><input type='text' name='noFaktur' required></td>
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
                                        <th>Qty Permitaan</th>
                                        <th>Satuan</th>
                                        <th>qty</th>
                                    </tr>
                                </thead>
                                <tbody class="targetReq">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Selesai</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            show()
        });
        function show(){
            $('#dataTable').dataTable({
                destroy:true,
                processing:true,
                serverside:true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    ajax:"{{route('show.req')}}",
                    columns:[
                        {data:'aksi',name:'aksi'},
                        {data:'keterangan',name:'keterangan'},
                        {data:'updated_at',name:'updated_at'},
                        {data:'status',name:'status'},

                    ]
            });
        }
        function approve(id,act){
            Swal.fire({
                title: 'Anda Yakin ?',
                text: "Pastikan anda sudah check stok barang sebelum melakukan purchasing!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"/request_approve/"+act+"/"+id, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType:'json',
                        beforeSend:function(){
                            $(".loading").css("display","block");
                        },
                        success:function(res){
                            if(res=='added'){
                                Swal.fire(
                                    'Success!',
                                    'Barang telah diapprove',
                                    'success'
                                )
                                show();
                            }
                            $(".loading").css("display","none");
                            console.log(res)
                        }
                        
                    });
                    
                }
            });
        }
        function acc(id,act){
            Swal.fire({
                title: 'Perhatian !',
                text: "PR akan di kirim ke kantor pusat! Pastikan data PR sesuai dengan item yang di butuhkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"/request_approve/"+act+"/"+id, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType:'json',
                        beforeSend:function(){
                            $(".loading").css("display","block");
                        },
                        success:function(res){
                            if(res=='added'){
                                Swal.fire(
                                    'Success!',
                                    'Barang telah diacc',
                                    'success'
                                )
                                show();
                            }
                            $(".loading").css("display","none");
                            console.log(res)
                        }
                        
                    });
                    
                }
            });
        }
        function order(id,act){
            Swal.fire({
                title: 'Anda yakin ?',
                text: "Akan menyetujui pemesanan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Order!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"/request_approve/"+act+"/"+id, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType:'json',
                        beforeSend:function(){
                            $(".loading").css("display","block");
                        },
                        success:function(res){
                            if(res=='added'){
                                Swal.fire(
                                    'Success!',
                                    'Barang akan di order',
                                    'success'
                                )
                                show();
                            }
                            $(".loading").css("display","none");

                            
                            console.log(res)
                        }
                        
                    });
                    
                }
            });
        }
        function kirim(id,act){
            Swal.fire({
                title: 'Peringatan !',
                text: "Proses pengiriman akan segera di lakukan! pastikan barang sudah siap untuk di kirim",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"/request_approve/"+act+"/"+id, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType:'json',
                        beforeSend:function(){
                            $(".loading").css("display","block");
                        },
                        success:function(res){
                            if(res=='added'){
                                Swal.fire(
                                    'Success!',
                                    'Barang akan segera di kirim',
                                    'success'
                                )
                                show();
                            }
                            $(".loading").css("display","none");

                            
                            console.log(res)
                        }
                        
                    });
                    
                }
            });
        }
        function Finish(id,act){
            Swal.fire({
                title: 'Anda Yakin ?',
                text: "Pastikan barang sudah datang dan sudah di cek untuk menyelesaikan purchesing",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#receive_barang').modal('show');
                    $('#detail_modal').modal('hide')

                    // $.ajax({
                    //     url:"/request_approve/"+act+"/"+id, 
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     },
                    //     dataType:'json',
                    //     beforeSend:function(){
                    //         $(".loading").css("display","block");
                    //     },
                    //     success:function(res){
                    //         if(res=='added'){
                    //             Swal.fire(
                    //                 'Success!',
                    //                 'purchesing selesai',
                    //                 'success'
                    //             )
                    //             show();
                    //         }
                    //         $(".loading").css("display","none");

                            
                    //         console.log(res)
                    //     }
                        
                    // });
                    
                }
            });
        }
        function detail(id){
            $('#detail_modal').modal('show')
            $('#receive_barang').modal('hide')
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
        function receive(id){
            $('#receive_barang').modal('show');
            $('#detail_modal').modal('hide')
            $('.targetReq').html('')

            $.ajax({
                url:"/request_check/detail/"+id,
                dataType:'json',
                        success:function(res){
                            let d = new Date();
                            let day =  d.getDate()
                            let m = d.getMonth() + 1
                            let y = d.getFullYear()
                            let str = y.toString().substr(-2);
                        $('.targetKD').html("<input readonly type='text' value="+res[0][0]['id']+'/PR/Factory/'+m+'/'+str+" name='noPR'><input readonly type='hidden' name='id_rq' value="+id+">")
                        $('.targetPermintaan').html("<input readonly type='text' name='permintaan' value='"+res[0][0]['user']+"'>")
                        $('.targetDiterima').html("<input readonly type='text' name='diterima' value='<?=Session::get('nama')?>'>")
                        $('.targetTanggal').html("<input readonly type='text' name='date' value="+y+'-'+m+'-'+day+">")
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
                        $('.targetReq').append("<tr><td>"+item['nama']+" <input type='hidden' readonly name='id_barang[]' value="+item['code_item']+"  required><input type='hidden' readonly name='keterangan[]' value='"+item['keterangan']+"'  required></td><td>"+item['qty']+"</td><td><input type='text' name='satuan[]' value='"+item['satuan']+"' readonly></td><td><input type='number' name='qty[]' required></td></tr>")
                    })
                    console.log(res[1])
                }
            })
        }
        function cari_barang(){
            let id = $('#cari').val()  // get id barang
            let nama = $('#'+id).text() // get nama barang

            $('#targetTable').append('<tr><td><input type="text" value="'+id+'"></td><td>'+nama+'</td><td><input type="number"></td></td></tr>')
            console.log($('#'+id).text())
        }
    </script>
@endsection