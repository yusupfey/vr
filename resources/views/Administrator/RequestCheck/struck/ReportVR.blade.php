
<style>
    /* .flex-beetween{
        display: flex;
  min-height: 100vh;
  flex-direction: column;
  margin: 0;
        /* justify-content:space-between; */
    /* } */
    /* container{
        display: flex;
        height: 100vh;
    } */
    .box{
        padding:30px;
        font-family: Poppins, "Helvetica Neue", arial, sans-serif;
        font-size: 1.5em;
        text-shadow: 0 1px 1px rgba(0,0,0,.2);
        text-align: center;
        width: 200px;
    } */
    /* .flex-beetween > div {
    background-color: #f1f1f1;
    width: 100px;
    margin: 10px;
    text-align: center;
    line-height: 75px;
    } */
    .td-font{
        font-size: 14px;
    }
    .center{
        text-align: center;
    }
    .right{
        text-align: right;
    }
    .p-2{
        padding:5px; 
    }
    .yellow{
        background-color: rgb(218, 218, 26)'
    }
</style>
    <div class="container">
        {{-- <div class="flex-beetween">
            <div class="box">NO</div>            
            <div class="box">Tanggal</div>            
            <div class="box">Tanggal</div>            
        </div> --}}


        <table width="100%">
            <tr>
                <td><b>No :</b>  {{$post[0]->id}}/PR/FACTORY/{{$my}}</td>
                <td class="right"><b>Date :</b>  {{$date}}</td>
            </tr>
            <tr>
                <td colspan="2" style="border:1px solid; padding:10px"><p><b>PURCHASING DEPARTEMENT</b> <br> Mohon di beli atau di siapkan item/barang berikut</p></td>
            </tr>
        </table>
        <br>
        <table width="100%" border="1px"  style="border-collapse:collapse; border: 1px solid #ddd;font-size: 14px;">
            <tr>
                <th class="p-2 yellow">No</th>
                <th class="p-2 yellow">Quantity</th>
                <th class="p-2 yellow">Satuan</th>
                <th class="p-2 yellow">Jenis/Nama Barang</th>
                <th class="p-2 yellow">Keterangan</th>
            </tr>
            @php
                $no=1;
            @endphp
            @foreach ($posts as $item)
                <tr>
                    <td class="center p-2">{{$no++}}</td>
                    <td class="center p-2">{{$item->qty}}</td>
                    <td class="center p-2">{{$item->satuan}}</td>
                    <td class="center p-2">{{$item->nama}}-{{$item->type}}-{{$item->ukuran}}</td>
                    <td class="center p-2">{{$item->keterangan}}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <table width="100%" border="1px"  style="border-collapse:collapse; border: 1px solid #ddd;">
            <tr>
                <td class="p-2 td-font"style="padding-bottom:40px;"><b>Tujuan Penggunaan</b><br>{{$post[0]->keterangan}}</td>
                <td class="p-2 td-font" rowspan="1"style="padding-bottom:10px;"><b>Untuk di isi di purceshing Dept</b><p>Tanggal dipesan : @php echo date('Y-m-d') @endphp <span style="margin-left:40px">Order (PO) No : </span>{{$post[0]->id}}</p></td>
            </tr>
             <tr>
                <td class="p-2 td-font "style="padding-top:20px; padding-bottom:20px;"><b>Waktu Dibutuhkan : </b><br>Segera</td>
                <td class="p-2 td-font "style="padding-top:20px; padding-bottom:20px;"><b>TTD Purchasing Dept.</b> ...............................</td>
            </tr>
            <tr>
            <td class="p-2 td-font"style="padding-top:20px;"><b>Diminta Oleh</b> :<br> {{$post[0]->user}}</td>
                <td class="p-2 td-font"style="padding-top:-50px;" rowspan="2"><b>Diketauhi Oleh Finance Manager</b><br><br><br><br></td>
            </tr>
            <tr>
                <td class="p-2 td-font" style="padding-top:20px;"><b>Disetujui Oleh :</b><br> {{$post[0]->disetujui}} </td>
            </tr>
        </table>
    </div>