@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card" style="box-shadow: black 4px">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary">
                                CREATE SUPPLIER
                            </div>
                            <div class="card-body">
                                <form id="supplier">
                                    @csrf
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" name="id" readonly class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nama Supplier">
                                        <div class="text-danger small" id="errorName"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea type="text" name="alamat" class="form-control" ></textarea>
                                        <div class="text-danger small" id="errorAlamat"></div>

                                    </div>
                                    <div class="form-group">
                                        <label>Telp</label>
                                        <input type="text" name="telp" class="form-control" placeholder="Telp..">
                                        <div class="text-danger small" id="errorTelp"></div>

                                    </div>
                                    <hr>
                                    <div class="form-group d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="create">Create</button>
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
                                            {{-- <th>No</th> --}}
                                            <th>ID</th>
                                            <th>Supplier</th>
                                            <th>Alamat</th>
                                            <th>Telp</th>
                                            {{-- <th>aksi</th> --}}
                                        </thead>
                                        <tbody>
                                            {{-- @php
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
                                            @endforeach --}}
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            let id = $('input[name="id"]').val('<?=$sup?>')
            
            var table=$('#dataTable').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{route('act.getsupplier')}}",
                columns:[
                    {data:'id_supplier', name:'id_supplier'},
                    {data:'supplier', name:'supplier'},
                    {data:'alamat', name:'alamat'},
                    {data:'notel', name:'notel'},
                    // {data:'aksi',name:'aksi'},
                ]
            });
            $('#supplier').submit(function(e){
                e.preventDefault();
                let data= $('#supplier').serialize()
                let id = $('input[name="id"]').val()
                let name = $('input[name="name"]').val()
                let alamat = $('textarea[name="alamat"]').val()
                let telp = $('input[name="telp"]').val()
                var _token = $("input[name='_token']").val();
                if(name == '' ||telp == ''||alamat == ''){
                    if(name == ""){
                        $('#errorName').html('Name Harus diisi !!!')
                    }else{
                        $('#errorName').html('')

                    }
                    if(alamat == ""){
                        $('#errorAlamat').html('alamat Harus diisi !!!')
                    }else{
                        $('#errorAlamat').html('')

                    }
                    if(telp == ""){
                        $('#errorTelp').html('telp Harus diisi !!!')
                    }else{
                        $('#errorTelp').html('')

                    }
                }else{
                    $('#errorName').html('')
                    $('#errorAlamat').html('')
                    $('#errorTelp').html('')
                    $.ajax({
                        url:"{{route('act.supplier')}}",
                        method:'post',
                        data:{_token,id:id,name:name,alamat:alamat,telp:telp},
                        dataType:'json',
                        success:function(res){
                            if(res[0]=="added")
                            Swal.fire(
                                'Success!',
                                'Supplier telah ditambahkan',
                                'success'
                            )
                            $('input[name="name"]').val('')
                            $('textarea[name="alamat"]').val('')
                            $('input[name="telp"]').val('')
                            $('input[name="id"]').val(res[1])
                            $("input[name='_token']").val();

                            table.ajax.reload()

                        }
                    })
                }
            })
        });
        function show_suppllier(){
            table.ajax.reload()
        }
    </script>
@endsection