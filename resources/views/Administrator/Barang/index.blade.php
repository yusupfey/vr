@extends('layouts.dashboard')
@section('title',' Master Barang')
@section('content')
<div class="card">
        <div class="card-body">
            @php
                $cek = Session::get('id_akses');
            @endphp
            @if ($cek==1 or $cek==3)
            <a href="/add_barang" class="btn btn-primary mb-3">+ Barang</a>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-collapse" id="dataTable">
                    <thead>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Ukuran</th>
                        <th>Type</th>
                        <th>Stock</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Ukuran</th>
                        <th>Type</th>
                        <th>Stock</th>
                    </tfoot>
                </table>
            {{-- {{$post->links()}} --}}
            </div>
        </div>
    </div>
    <div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_barang">
                    @csrf
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name='id' class="form-control" readonly value="">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name='name' class="form-control" placeholder="Nama Barang">
                    </div>
                    <div class="form-group">
                        <label>Size</label>
                        <input type="text" name='size' class="form-control" placeholder="Size">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" name='type' class="form-control" placeholder="Type">
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name='stok' class="form-control" placeholder="Stock">
                    </div>
                    <div class="form-group">
                        <label>Suppier</label>
                        <select name="supplier" class="form-control">
                                            <option selected disabled>Pilih Supplier</option>
                                            @foreach ($supplier as $item)
                                                <option value="{{$item->id_supplier}}">{{$item->supplier}}</option>
                                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="simpan">Simpan</button>&nbsp;
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            show()
            $('#simpan').on('click',function(){
                let data = $('#form_barang').serializeArray();
                $.ajax({
                    url:"/barang/edit",
                    method:'post',
                    data:data,
                    dataType:'json',
                    beforeSend:function(){
                        $('#form_modal').modal('hide');
                        $(".loading").css("display","block");
                    },
                    success:function(res){
                        Swal.fire(
                                'Success!',
                                'Barang telah disimpan',
                                'success'
                            )
                        show()
                        $(".loading").css("display","none");
                    }
                })
            });
        });
        function show(){
            $('#dataTable').dataTable({
                destroy:true,
                processing:true,
                serverside:true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax:"{{route('show.barang')}}",
                columns:[
                    {data:'aksi',name:'aksi'},
                    {data:'id_barang',name:'id_barang'},
                    {data:'nama',name:'nama'},
                    {data:'ukuran',name:'ukuran'},
                    {data:'type',name:'type'},
                    {data:'stok',name:'stok'},

                ]
            });
        }
        function edit(id){
            $('#form_modal').modal('show');
            $.ajax({
                url:"/barang/"+id,
                dataType:'json',
                success:function(res){
                    $.each(res, function(ket,item){
                        $('input[name="id"]').val(item['id_barang'])
                        $('input[name="name"]').val(item['nama'])
                        $('input[name="size"]').val(item['ukuran'])
                        $('input[name="type"]').val(item['type'])
                        $('input[name="stok"]').val(item['stok'])
                    })

                }
            })
        }
        function hapus(id){
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"/barang/hapus/"+id, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType:'json',
                        beforeSend:function(){
                            $(".loading").css("display","block");
                        },
                        success:function(res){
                            if(res=='remove'){
                                Swal.fire(
                                    'Success!',
                                    'Barang telah dihapus',
                                    'success'
                                )
                                show()
                                $(".loading").css("display","none");
                            }
                            console.log(res)
                        }
                        
                    });
                    
                }
            });
        }
    </script>
@endsection