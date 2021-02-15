<style>
    .center{
        text-align: center;
    }
    .mt-20{
        margin-top: 20px;
    }
   
    td{
        padding:5px;
    }
</style>
<div class="container">
    <span>PT. INTERINDO DUTATEKNO</span><br>
    <div class="center mt-20"><b>FORM PEMERIKSAAN DAN PENERIMAAN BARANG</b></div>
    <table width="100%" border="1px"  style="border-collapse:collapse; border: 1px solid #ddd;font-size: 14px; margin-top:40px">
        <tr>
            <td colspan="2">
                <b>FPPB :</b> {{$qry[0]->id}}
                <br>
                <b>TGL. FPPB :</b> {{$qry[0]->tanggal}}
            </td>
            <td>
                <b>No. Surat Jalan :</b> {{$qry[0]->no_faktur}}
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <b>Vendor :</b>
                <br>
                <b>{{$supplier[0]->supplier}}</b>
            </td>
            <td>
                <b>Proyek :</b>
                <br>
                <b>{{$qry[0]->keterangan}}</b>
            </td>
            <td>
                <div style="float:right; margin-right:20px">
                    <ul>
                        <li>Lampu</li>
                        <li>Galvanis</li>
                        <li>Kabel Rack</li>
                        
                    </ul>
                </div>
                <div style="text-left; padding-right:30px">
                    <ul>
                        <li>Jalan Powder Cating</li>
                        <li>Maintenance</li>
                        <li>Lain - Lain</li>
                        
                    </ul>
                </div>
            </td>
        </tr>
        
    </table>
    <table width="100%" border="1px"  style="border-collapse:collapse; border: 1px solid #ddd;font-size: 14px; position:relative">
        <tr>
            <td colspan="7"> . </td>
        </tr>
        
        <tr>
            <td>No</td>
            <td>Kode</td>
            <td>Nama Barang</td>
            <td>Satuan</td>
            <td>Qty</td>
            <td>No. PR</td>
            <td>Keterangan</td>
        </tr>
        @php
            $no=1;
        @endphp
        @foreach ($posts as $item)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$item->code_item}}</td>
                <td>{{$item->nama}} {{$item->type}}-{{$item->ukuran}}</td>
                <td>{{$item->satuan}}</td>
                <td>{{$item->qty_diterima}}</td>
                <td>{{$my}}/{{$item->id_rq}}</td>
                <td>{{$item->keterangan}}</td>
            </tr>
        @endforeach
    </table>
    <table width="100%" border="1px"  style="border-collapse:collapse; border: 1px solid #ddd;font-size: 14px; position:relative">
        <tr>
            <td colspan="6">.</td>
        </tr>
        <tr>
            <td>1. Baik</td>
            <td>2. Rusak</td>
            <td>3. Return dari poyek</td>
            <td>4. Bungkaran</td>
            <td>5. Contoh</td>
            <td>6. Lain-lain</td>
        </tr>
        <tr>
            <td colspan="6" style="height: 40px;"> ... </td>
        </tr>
        <tr>
            <td colspan="6" style="height: 40px;">
                <table border="0" width="100%" class="center">
                    <tr>
                        <td style="padding-bottom:20px"><b>Dibuat Oleh</b><br>{{$qry[0]->diminta}}</td>
                        <td style="padding-bottom:20px"><b>Diperiksa dan diterima Oleh</b><br>{{$qry[0]->diterima}}</td>
                        <td style="padding-bottom:20px"><b>Diketahui Oleh</b><br>{{$qry[0]->disetujui}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>