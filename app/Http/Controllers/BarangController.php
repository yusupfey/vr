<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        return view('Administrator.Barang.index');
    }
    public function show_barang()
    {
        $post = Barang::get();
        return \DataTables::of($post)
            ->addColumn('aksi', function ($post) {
                $cek = \Session::get('id_akses');
                $act = '';
                if ($cek == 1 or $cek == 3) {
                    $act = '
                        <button class="dropdown-item" onclick="edit(`' . $post->id_barang . '`)">Edit</button>
                        <button class="dropdown-item" onclick="hapus(`' . $post->id_barang . '`)">Delete</button>
                    ';
                }
                return '
                <div class="dropdown show">
                    <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button class="dropdown-item" onclick="detail(`' . $post->id_barang . '`)">Detail</button>
                        ' . $act . '
                    </div>
                </div>
                ';
            })->rawColumns(['aksi'])->make(true);
    }
    public function getID()
    {
        $getcode = DB::select('Select max(id_barang) as MaxKode FROM barang');
        $kode = '';
        foreach ($getcode as $item) {
            $no_urut = (int) substr($item->MaxKode, 3, 7);
            $no_urut++;
            $kode = 'BRG' . sprintf("%07s", $no_urut);
        }
        return $kode;
    }
    public function linkadd_barang()
    {
        $brg = $this::getID();
        return view('Administrator.Barang.Form.form', compact('brg'));
    }

    public function get_barang_based_on_today()
    {
        $tgl = date("Y-m-d");
        $post = DB::select("select * from barang where date(created_at)='$tgl'");
        return \DataTables::of($post)
            ->addColumn('aksi', function ($post) {
                return '
                <a href="' . $post->id_barang . '"class="badge badge-success">Update</a>
                <a href="' . $post->id_barang . '"class="badge badge-danger">Delete</a>';
            })->rawColumns(['aksi'])->make(true);
    }
    public function actbarang(Request $req)
    {
        $attr = [
            'id_barang' => $req->id,
            'nama' => $req->name,
            'ukuran' => $req->size,
            'type' => $req->type,
            'stok' => $req->stok,
        ];
        Barang::create($attr);
        $brg = $this::getID();
        echo json_encode(['added', $brg]);
    }

    public function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function get_barang($id)
    {
        $qry = Barang::where('id_barang', $id)->get();

        echo json_encode($qry);
    }

    public function edit(Request $req)
    {
        $attr = [

            'nama' => $req->name,
            'ukuran' => $req->size,
            'type' => $req->type,
            'stok' => $req->stok,
        ];
        $qry = Barang::where('id_barang', $req->id)->update($attr);
        echo json_encode($qry);
    }
    public function remove($id)
    {
        $qry = Barang::where('id_barang', $id);
        $qry->delete();
        echo json_encode('remove');
    }
}
