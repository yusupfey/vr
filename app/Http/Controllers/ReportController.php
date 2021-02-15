<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function DataPr()
    {
        $posts = DB::table('request_item')->where('status', 5)->orderByDesc('updated_at')->get();

        return view('Administrator/Report/pr', compact(['posts']));
    }
    public function DataTb()
    {
        $posts = DB::select("select terima_barang.*, request_item.keterangan from terima_barang inner join request_item on terima_barang.id_rq=request_item.id order by id Desc");

        return view('Administrator/Report/tb', compact(['posts']));
    }
    public function detail($id)
    {
        $qry = DB::select("select terima_barang.*, request_item.* from terima_barang inner join request_item on terima_barang.id_rq=request_item.id where terima_barang.id ='$id' order by terima_barang.id Desc");
        $posts = DB::select("select barang.nama,barang.ukuran,barang.type,t_terima_barang_d.qty_diterima from terima_barang inner join t_terima_barang_d on terima_barang.id = t_terima_barang_d.id_terimabarang inner join barang on t_terima_barang_d.code_item = barang.id_barang where t_terima_barang_d.id_terimabarang ='$id' ");



        echo json_encode([$qry, $posts]);
    }
    public function pdf($id)
    {
        // $post = DB::table('request_item')->where('id', $id)->get();
        $my = date('y');
        // $date = date('Y/m/d');
        $qry = DB::select("select terima_barang.*, request_item.* from terima_barang inner join request_item on terima_barang.id_rq=request_item.id where terima_barang.id ='$id'");
        $posts = DB::select("select terima_barang.id_rq, barang.nama,barang.ukuran,barang.type, t_terima_barang_d.qty_diterima,t_terima_barang_d.satuan,t_terima_barang_d.keterangan,t_terima_barang_d.code_item from terima_barang 
        inner join t_terima_barang_d on terima_barang.id = t_terima_barang_d.id_terimabarang 
        inner join barang on t_terima_barang_d.code_item = barang.id_barang where terima_barang.id ='$id' ");
        $id_barang = $posts[0]->code_item;
        $supplier = DB::select("SELECT supplier.supplier FROM supplier INNER JOIN barang on barang.id_supplier = supplier.id_supplier where barang.id_barang='$id_barang'");
        $pdf = \PDF::loadView('Administrator.Report.reportTB', compact(['posts', 'my', 'qry', 'supplier']));
        return $pdf->stream('invoice.pdf');
    }
}
