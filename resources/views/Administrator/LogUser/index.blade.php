@extends('layouts.dashboard')
@section('title','MASTER Account')
@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" onclick="create()">+ user</button>
            <div class="table-responsive">
                <table class="table table-collapse" id="dataTable">
                    <thead>
                        <th>Action</th>
                        <th>NIK</th>
                        <th>Username</th>
                        
                        
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <th>Action</th>
                        <th>NIK</th>
                        <th>Username</th>
                        
                        
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
                <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_user">
                    @csrf
                    <div class="form-group">
                        <label>NIK</label>
                        <select name="nik" class="form-control">
                        </select>
                        <input type="text" name="id" class="form-control">

                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name='username' class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name='password' class="form-control" placeholder="Password">
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
                ajax:"{{route('show.userAccount')}}",
                columns:[
                    {data:'aksi',name:'aksi'},
                    {data:'nik', name:'nik'},
                    {data:'username', name:'username'}
                ]
            });
        }
        function clear(){
            $('select[name="nik"]').html('');
            $('input[name="username"]').val('');
            $('input[name="password"]').val('');
            // $('input[name="tempat"]').val('');

            $('#act').text('Simpan')


        }
        function get_position(){
            $.ajax({
                url:"/account/nik",
                dataType:'json',
                success:function(res){
                    $('select[name="nik"]').append(res)
                    // console.log($('select[name="position"]').html())
                }
            })
        }
        function create(){
                $('#form_modal').modal('show')
                $('select[name="nik"]').show()
                $('input[name="id"]').hide();

                clear()
                get_position();
        }

        function add(){
            $('#act').on('click',function(){
                let data = $('#form_user').serializeArray();
                let act = $('#act').text()
                $.ajax({
                    url:"/account/"+act,
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
                url:"/account/"+nik,
                dataType:'json',
                success:function(res){
                    $('select[name="nik"]').hide()
                    $('input[name="id"]').show();
                    get_position();
                    $('input[name="id"]').val(res[0]['id_user']);
                    $('input[name="username"]').val(res[0]['username']);
                    $('input[name="password"]').val(res[0]['password']);
                    console.log(res)
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
                        url:"/account/hapus/"+id,
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