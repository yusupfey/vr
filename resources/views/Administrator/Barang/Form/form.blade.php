@extends('layouts.dashboard')
@section('title',' FORM BARANG')
@section('content')
    <div class="container-fluid">
        <div class="card" style="box-shadow: black 4px">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                CREATE BARANG
                            </div>
                            <div class="card-body">
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" name='id' class="form-control" readonly value="{{$brg}}">
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
                                        <input type="text" name='stok' class="form-control" placeholder="Type">
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select name="supplier" class="form-control">
                                            <option selected disabled>Pilih Supplier</option>
                                            @foreach ($supplier as $item)
                                                <option value="{{$item->id_supplier}}">{{$item->supplier}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" id="create">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary">
                                BASED ON TODAY
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-collapse" id="dataTable">
                                        <thead>
                                            <th>ID</th>
                                            <th>Nama Barang</th>
                                            <th>Ukuran</th>
                                            <th>Type</th>
                                            <th>Stok</th>
                                            <th>Supplier</th>
                                            {{-- <th>Action</th> --}}
                                        </thead>
                                        <tbody>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            let table = $('#dataTable').DataTable({
                processing:true,
                serverside:true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax:"{{route('act.barang')}}",
                columns:[
                    {data:'id_barang',name:'id_barang'},
                    {data:'nama',name:'nama'},
                    {data:'ukuran',name:'ukuran'},
                    {data:'type',name:'type'},
                    {data:'stok',name:'stok'},
                    {data:'id_supplier',name:'id_supplier'},
                    // {data:'aksi',name:'aksi'},

                ]
            });

            $('#create').on('click',function(){
                let id = $('input[name="id"]').val()
                let name = $('input[name="name"]').val()
                let size = $('input[name="size"]').val()
                let type = $('input[name="type"]').val()
                let stok = $('input[name="stok"]').val()
                let supplier = $('select[name="supplier"]').val()
                let _token = $('input[name="_token"]').val()
                
                $.ajax({
                    url:"{{route('act.actbarang')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method:'post',
                    data:{_token,id:id,name:name,size:size,type:type,stok:stok,supplier:supplier},
                    dataType:'json',
                    success:function(res){
                        if(res[0]=='added'){
                            Swal.fire(
                                'Success!',
                                'Barang telah ditambahkan',
                                'success'
                            )
                            $('input[name="id"]').val(res[1])
                            $('input[name="name"]').val('')
                            $('input[name="size"]').val('')
                            $('input[name="type"]').val('')
                            $('input[name="stok"]').val('')
                            $('input[name="_token"]').val('')
                        }
                        table.ajax.reload()
                    }
                    
                })
            });
        });
    </script>
@endsection