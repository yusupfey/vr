@extends('layouts.dashboard')
@section('title','MASTER SUPPLIER')
@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            Master Supplier
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasi di ubah !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                @endif
            <a href='/add_supplier' class="btn btn-primary mb-3">+ Supplier</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-collapse" id="dataTable">
                    <thead>
                        <th>Aksi</th>
                        <th>ID</th>
                        <th>Supplier</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                    </thead>
                    <tbody>
                        
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
    <div class="modal fade" id="edit_supplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Terima Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="supplier/update" method="post">
                <div class="modal-body">
                    @csrf
                        <div class="form-group">
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="simpan_edit">simpan</button>
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
            $('#dataTable').DataTable({
                destroy:true,
                processing:true,
                serverside:true,
                ajax:"{{route('show.supplier')}}",
                columns:[
                    {data:'aksi',name:'aksi'},
                    {data:'id_supplier', name:'id_supplier'},
                    {data:'supplier', name:'supplier'},
                    {data:'alamat', name:'alamat'},
                    {data:'notel', name:'notel'},
                ]
            });
        }
        function edit(id){
            $('#edit_supplier').modal('show')
            $.ajax({
                url:"/get_supplier/"+id,
                dataType:'json',
                success:function(res){
                    $('input[name="id"]').val(res[0]['id_supplier'])
                    $('input[name="name"]').val(res[0]['supplier'])
                    $('textarea[name="alamat"]').val(res[0]['alamat'])
                    $('input[name="telp"]').val(res[0]['notel'])
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
                        url:"/supplier/hapus/"+id, 
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
                        }
                        
                    });
                    
                }
            });
        }
    </script>
@endsection