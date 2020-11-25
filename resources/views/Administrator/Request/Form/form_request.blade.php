@extends('layouts.dashboard')
@section('title','FORM REQUEST')
@section('content')
<style>
    .iditem{
        border:none;
        background-color: #ffc107;
        font-weight: bold;
        font-size: 20px;
        width: 120px;
    }
    .qtyitem{
        border:none;
        font-size: 16px;
        width: 80PX;
        border-radius: 5px
    }
    .textarea_item{
        width: 100%;
        height:40px
    }

</style>
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModalCenter">+ Add Item</button>
        <form action="/req_item" method="post">
             @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-collapse" id="dataTable">
                        <thead>
                            {{-- <th>No</th> --}}
                            <th>Code</th>
                            <th>Item</th>
                            <th>Satuan</th>
                            <th>Qty</th>
                            <th>Untuk</th>
                            <th>Action</th>
                        </thead>
                        <tbody class="target">
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Keterangan <span class="text-danger">*</span></label>
                            <textarea name="ket" id="" class="form-control" required></textarea>
                        </div>
                        <div class="col-6">
                            <label for="">Waktu yang dibutuhkan <span class="text-danger">*</span></label>
                            <textarea name="" id="" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                {{-- {{$posts->links()}} --}}
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" id="btn-finish">Selesai</button>
                </div>
            </div>

        </form>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="">Item</label>
                                <select class="itemSelect" name="select" style="width:100%;height:20px">
                                    @foreach ($post as $item)
                                        <option value="{{$item->id_barang}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <select class="form-control" name="satuan">
                                    <option selected disabled>Pilih Satuan</option>
                                    <option value="PCS">PCS</option>
                                    <option value="Lusin">Lusin</option>
                                    <option value="Pack">Pack</option>
                                    <option value="Box">Box</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Qty</label>
                                <input type="number" name="qty" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="insert_table">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            $(".itemSelect").select2({
                theme:'classic'
            });
            let item;
            let qty;
            let itemName;
            let satuan;

            let data=[];

            
            $('#insert_table').on('click',function(){
                item =($('select[name="select"]').val());
                qty =($('input[name="qty"]').val());
                satuan =($('select[name="satuan"]').val());
                // data.push([item,qty]);
                itemName =($('.itemSelect option:selected').text());
                    $('.target').append('<tr><td class="attrItem bg-warning"><input type="text" class="iditem" name="item[]" readonly value='+item+'></td><td>'+itemName+'</td><td><input type="text" class="qtyitem text-center" name="satuan[]" readonly value='+satuan+'></td><td class="attrQty"><input type="number" class="qtyitem text-center"  name="qty[]" value='+qty+'></td><td><textarea class="textarea_item" name="keterangan[]"></textarea></td><td><button id="rmv" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td></tr>')
                // console.log(data);
            })

            $("#dataTable").on("click", "#rmv", function(){
                $(this).closest("tr").remove();
            })
            
            $('#btn-finish').on('click',function(){
                $('#dataTable tr').each(function(a,b){
                    let ItemV = $('.attrItem',b).text();
                    let qtyV = $('.attrQty',b).text();
                    data.push({itemv:ItemV,qtyv:qtyV})
                    console.log(b);
                })
                    // $.ajax({
                    //     url:"",
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     },
                    //     method:'post',
                    //     data:data,
                    //     dataType:'json',
                    //     success:function(res){
                    //         // if(res[0]=='added'){
                    //             Swal.fire(
                    //                 'Success!',
                    //                 'Barang telah ditambahkan',
                    //                 'success'
                    //             )
                                
                    //         // }
                    //         // table.ajax.reload()
                    //         console.log(data);
                    //         console.log(res);
                    //     }
                    // })
            });
            
        });
    </script>
@endsection