<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Request_Check extends Controller
{
    public function index()
    {
        $post = DB::table('barang')->get();
        return view('Administrator.RequestCheck.index', compact('post'));
    }
    public function show_req()
    {
        $getakses = \Session::get('id_akses');
        $post = '';
        if ($getakses === 4) {
            $post = DB::select("SELECT * FROM `request_item` WHERE status not in(0) and status not in(5) ORDER BY id DESC");
        } else {
            $post = DB::select("select * from request_item order by id DESC");
        }


        return \DataTables::of($post)
            ->addColumn('aksi', function ($post) {
                $getakses = \Session::get('id_akses');
                // jika status
                /**
                 * 0. minta approve surpervisor
                 * 1. minta di acc manager
                 * 2. order oleh pusan
                 * 3. kirim form pusat to cabang status on order
                 * 4. terima barang status sedang di kirim
                 */

                $condition = "";
                $conditionpurchasing = "";
                $conditionorder = "";
                $conditionkirm = "";
                $conditionreceive = "";
                if ($post->status == 0) {
                    $condition = "pointer-events: none";
                }
                if ($getakses === 5 or $getakses === 1) {
                    if ($post->status == 1) {
                        $conditionpurchasing = '<button class="dropdown-item" onclick="acc(`' . $post->id . '`,`acc`)">Purcasing</button>';
                    } else {
                        $conditionpurchasing = '';
                    }
                }
                if ($getakses == 4 or $getakses == 1) {
                    if ($post->status == 2) {
                        $conditionorder = '<button class="dropdown-item" onclick="order(`' . $post->id . '`,`order`)">Order</button>';
                    } else {
                        $conditionorder = '';
                    }
                    if ($post->status == 3) {
                        $conditionkirm = '<button class="dropdown-item" onclick="kirim(`' . $post->id . '`,`kirim`)">Konfirmasi pengiriman barang</button>';
                    } else {
                        $conditionkirm = '';
                    }
                }
                if ($getakses == 1 or $getakses == 3) {
                    if ($post->status == 4) {
                        $conditionreceive = '<button class="dropdown-item" onclick="receive(' . $post->id . ')">Terima Barang</button>';
                    } else {
                        $conditionreceive = "";
                    }
                }
                return '
               <div class="dropdown show">
                    <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button class="dropdown-item" onclick="detail(' . $post->id . ')">Detail</button>
                        <a class="dropdown-item" href="/request_check/pdf/' . $post->id . '" style="' . $condition . '">Print</a>
                        ' . $conditionpurchasing . '
                        ' . $conditionorder . '
                        ' . $conditionkirm . '
                        ' . $conditionreceive . '
                        
                    </div>
                </div>
                ';
            })->addColumn('status', function ($post) {
                $getakses = \Session::get('id_akses');
                $status = '';
                // jika status
                /**
                 * 0. minta approve surpervisor
                 * 1. minta di acc manager
                 * 2. order oleh pusat before position on process
                 * 3. kirim form pusat to cabang before position status on order
                 * 4. terima barang status sedang di kirim
                 */
                if ($post->status == 0) {
                    // jika user nya supervisor dan admin

                    if ($getakses === 2) {

                        $status = '<div class="badge badge-danger">Menunggu</div>';
                    } else if ($getakses === 4) {
                        $status = '<div class="badge badge-danger">Belum di verifikasi supervisor</div>';
                    } else {
                        $status = '<button onclick="approve(`' . $post->id . '`,`approve`)" class="btn btn-sm btn-danger">Approve</button';
                    }
                } else if ($post->status == 1) {
                    // jika user nya supervisior gudang dan staff gudang maka nilaiya on prosess

                    $status = '<div class="badge badge-warning">on process</div>';

                    // juka usernya gudang pusat dan admin maka muncul button processing untuk melakukan proses
                } else if ($post->status == 2) {
                    // jika user nya supervisior gudang dan staff gudang maka nilaiya on prosess

                    $status = '<div class="badge badge-secondary">wait to order</div>';

                    // juka usernya gudang pusat dan admin maka muncul button processing untuk melakukan proses
                } else if ($post->status == 3) {
                    $status = '<div class="badge badge-primary">on order</div>';
                } else if ($post->status == 4) {
                    $status = '<div class="badge badge-info">sedang di kirim</div>';
                } else {
                    // yang bisa melakukan processing adalaha supervisor gudang
                    // gudang pusat hanya melihat statusnya selesai saja.
                    $status = '<div class="badge badge-success">Selesai</div>';
                }
                return $status;
            })->rawColumns(['aksi', 'status'])->make(true);
    }

    public function detail($id)
    {
        $qry = DB::select("select * from request_item where id = $id");

        $posts = DB::select("select request_item_d.*, barang.nama,barang.ukuran,barang.type from request_item_d
        inner join barang on request_item_d.code_item = barang.id_barang where request_item_d.id_rq ='$id' ");

        echo json_encode([$qry, $posts]);
    }

    public function act_approve($act, $id)
    {
        $getnama = \Session::get('nama');

        if ($act === "approve") {
            DB::table('request_item')->where('id', $id)->update(['status' => 1]);
            session()->flash('success', 'Data Berhasil di post');
        } else if ($act === "acc") {
            DB::table('request_item')->where('id', $id)->update(['status' => 2, 'disetujui' => $getnama]);
            session()->flash('success', 'Data Berhasil di post');
        } else if ($act === "order") {
            DB::table('request_item')->where('id', $id)->update(['status' => 3]);
            session()->flash('success', 'Data Berhasil di post');
        } else if ($act === "kirim") {
            DB::table('request_item')->where('id', $id)->update(['status' => 4]);
            session()->flash('success', 'Data Berhasil di post');
        } else {
            DB::table('request_item')->where('id', $id)->update(['status' => 5]);
            session()->flash('success', 'Data Berhasil di post');
        }

        echo json_encode("added");
    }
    public function pdf($id)
    {
        $post = DB::table('request_item')->where('id', $id)->get();
        $my = date('m/y');
        $date = date('Y/m/d');
        $posts = DB::select("select request_item_d.*, barang.nama,barang.ukuran,barang.type from request_item_d
        inner join barang on request_item_d.code_item = barang.id_barang where request_item_d.id_rq ='$id' ");
        $pdf = \PDF::loadView('Administrator.RequestCheck.struck.ReportVR', compact(['posts', 'date', 'post', 'my']));
        return $pdf->stream('invoice.pdf');
    }

    public function terima_barang(Request $req)
    {
        $terimaBarang = [
            'id_rq' => $req->id_rq,
            'no_faktur' => $req->noFaktur,
            'kodePR' => $req->noPR,
            'diminta' => $req->permintaan,
            'diterima' => $req->diterima,
            'tanggal' => $req->date,
        ];
        $id = DB::table('terima_barang')->insertGetId($terimaBarang); //mengambil id terakhir yang di input
        DB::table('request_item')->where('id', $req->id_rq)->update(['status' => 5]);

        foreach ($req->id_barang as $index => $key) {
            $getstock = DB::select("select * from barang where id_barang = '$key'");
            // print_r($getstock);
            $id_brg = $getstock[0]->id_barang;
            $stok_barang = $getstock[0]->stok;
            $new_stok = $req->qty[$index];
            $satuan = $req->satuan[$index];
            $keterangan = $req->keterangan[$index];

            $hasil = $stok_barang + $new_stok;
            $terimaBarang_D = [
                'id_terimabarang' => $id,
                'code_item' => $id_brg,
                'satuan' => $satuan,
                'qty_diterima' => $new_stok,
                'keterangan' => $keterangan,
            ];
            DB::table('t_terima_barang_d')->insert($terimaBarang_D);
            DB::table('barang')->where('id_barang', $id_brg)->update(['stok' => $hasil]);
        }
        session()->flash('success', 'Data Berhasil di post');
        return redirect()->to('request_check');
    }
}
