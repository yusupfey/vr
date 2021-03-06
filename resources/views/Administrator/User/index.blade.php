@extends('layouts.dashboard')
@section('title','MASTER USER')
@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" onclick="create()">+ user</button>
            <div class="table-responsive">
                <table class="table table-collapse" id="dataTable">
                    <thead>
                        <th>Action</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Staff</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <th>Action</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Staff</th>
                    </tfoot>
                </table>
            {{-- {{$post->links()}} --}}
            </div>
        </div>
        <div class="card-footer">
            <div style="font-size:12px">
            </div>

        </div>
    </div>
    <div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_user">
                    @csrf
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name='id' Requerd class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name='name' class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name='tempat' class="form-control" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal lahir</label>
                        <input type="date" name='tgl_lahir' class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <select name="position" class="form-control">
                                            
                        </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="act">Simpan</button>&nbsp;
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
            add()
            // create()
        });
        function show(){
            $('#dataTable').DataTable({
                destroy:true,
                processing:true,
                serverside:true,
                ajax:"{{route('show.user')}}",
                columns:[
                    {data:'aksi',name:'aksi'},
                    {data:'nik', name:'nik'},
                    {data:'nama', name:'nama'},
                    {data:'tgl_lahir', name:'tgl_lahir'},
                    {data:'Alamat', name:'Alamat'},
                    {data:'akses', name:'akses'}
                ]
            });
        }
        function clear(){
            $('select[name="position"]').html('');
            $('input[name="id"]').val('');
            $('input[name="name"]').val('');
            $('input[name="tempat"]').val('');
            $('input[name="tgl_lahir"]').val('');
            $('#alamat').val('');
            $('input[name="id"]').attr('readonly',false);
            $('#act').text('Simpan')


        }
        function get_position(){
            $.ajax({
                url:"/user/position",
                dataType:'json',
                success:function(res){
                    $('select[name="position"]').append(res)
                    // console.log($('select[name="position"]').html())
                }
            })
        }
        function create(){
                $('#form_modal').modal('show')
                clear()
                get_position();
        }

        function add(){
            $('#act').on('click',function(){
                let data = $('#form_user').serializeArray();
                let act = $('#act').text()
                $.ajax({
                    url:"/user/"+act,
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
                                'User telah disimpan',
                                'success'
                            )
                        show()
                        $(".loading").css("display","none");
                        show()
                    }
                })
            });
        }
        function edit(nik){
            $('#form_modal').modal('show')
            clear()
            $('input[name="id"]').attr('readonly',true);
            $('#act').text('Edit')
            $.ajax({
                url:"/user/"+nik,
                dataType:'json',
                success:function(res){
                    // $('select[name="position"]').append(res)
                    get_position();
                    $('input[name="id"]').val(res[0]['nik']);
                    $('input[name="name"]').val(res[0]['nama']);
                    $('input[name="tempat"]').val(res[0]['temp_lahir']);
                    $('input[name="tgl_lahir"]').val(res[0]['tgl_lahir']);
                    $('#alamat').val(res[0]['Alamat']);
                }
            })
        }
        function hapus(nik){
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
                        url:"/user/hapus/"+nik,
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
            })
        }
    </script>
@endsection