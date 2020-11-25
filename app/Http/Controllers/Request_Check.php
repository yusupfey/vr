<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Request_Check extends Controller
{
    public function index()
    {
        return view('Administrator.RequestCheck.index');
    }
    public function show_req()
    {
        $getakses = \Session::get('id_akses');
        $post = '';
        if ($getakses === 4) {
            $post = DB::select("SELECT * FROM `request_item` WHERE status not in(0) ORDER BY id DESC");
        } else {
            $post = DB::select("select * from request_item order by id DESC");
        }


        return \DataTables::of($post)
            ->addColumn('aksi', function ($post) {
                $condition = "";
                if ($post->status == 0) {
                    $condition = "pointer-events: none";
                }
                return '
               <div class="dropdown show">
                    <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button class="dropdown-item" onclick="detail(' . $post->id . ')">Detail</button>
                        <a class="dropdown-item" href="/request_check/pdf/' . $post->id . '" style="' . $condition . '">Print</a>
                        <button class="dropdown-item" onclick="Finish(' . $post->id . ',`finish`)">Selesai</button>
                    </div>
                </div>
                ';
            })->addColumn('status', function ($post) {
                $getakses = \Session::get('id_akses');
                $status = '';
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
                    if ($getakses === 3 or $getakses === 2) {

                        $status = '<div class="badge badge-warning">on process</div>';
                    } else {
                        $status = '<button onclick="order(`' . $post->id . '`,`order`)" class="btn btn-sm btn-warning">Order</button';
                    }
                    // juka usernya gudang pusat dan admin maka muncul button processing untuk melakukan proses
                } else if ($post->status == 2) {
                    if ($getakses === 3 or $getakses === 2) {
                        $status = '<div class="badge badge-primary">on order</div>';
                    } else {
                        $status = '<button onclick="kirim(`' . $post->id . '`,`kirim`)" class="btn btn-sm btn-primary">Kirim to Cabang</button';
                    }
                } else if ($post->status == 3) {
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
        if ($act === "approve") {
            DB::table('request_item')->where('id', $id)->update(['status' => 1]);
            session()->flash('success', 'Data Berhasil di post');
        } else if ($act === "order") {
            DB::table('request_item')->where('id', $id)->update(['status' => 2]);
            session()->flash('success', 'Data Berhasil di post');
        } else if ($act === "kirim") {
            DB::table('request_item')->where('id', $id)->update(['status' => 3]);
            session()->flash('success', 'Data Berhasil di post');
        } else {
            DB::table('request_item')->where('id', $id)->update(['status' => 4]);
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
}
