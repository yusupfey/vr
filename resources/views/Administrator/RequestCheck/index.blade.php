@extends('layouts.dashboard')
@section('title',' CHECK PURCASHING')
@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            Check
        </div>
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
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve it!'
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
                                    'purchesing selesai',
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
        function detail(id){
            $('#detail_modal').modal('show')
            $('.target').html('')
            $.ajax({
                url:"/request_check/detail/"+id,
                dataType:'json',
                success:function(res){
                        $('.targetPermintaan').html(res[0][0]['user'])
                        $('.targetTanggal').html(res[0][0]['created_at'])
                        $('.targetKet').html(res[0][0]['keterangan'])
                        let cek="",act="" 
                        if(res[0][0]['status']==4){
                            act = "<div class='badge badge-success'>Selesai</div>"
                        }else if(res[0][0]['status']==1){
                            act = "<div class='badge badge-warning'>on proces</div>"
                        }else if(res[0][0]['status']==2){
                            act = "<div class='badge badge-primary'>on order</div>"
                        }else if(res[0][0]['status']==3){
                            act = "<div class='badge badge-info'>Sedang pengiriman</div>"
                        }else{
                            act = "<div class='badge badge-danger'>Menunggu di approve supervisor</div>"
                        }
                        
                        $('.targetStatus').html(act)
                    let ket=''
                    $.each(res[1], function(ket,item){
                        $('.target').append("<tr><td>"+item['nama']+"</td><td>"+item['qty']+"</td><td>"+item['satuan']+"</td><td>"+item['keterangan']+"</td></tr>")
                    })
                    console.log(res[1])
                }
            })
        }
    </script>
@endsection