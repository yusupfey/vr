<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $posts = supplier::get();
        return view('Administrator.Supplier.index', compact('posts'));
    }
    public function show_data()
    {
        $posts = DB::select("select * from supplier order by id_supplier");
        return \DataTables::of($posts)
            ->addColumn('aksi', function ($post) {
                return
                    '<div class="dropdown show">
                            <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <button class="dropdown-item" onclick="edit(`' . $post->id_supplier . '`)">Edit</button>
                        <button class="dropdown-item" onclick="hapus(`' . $post->id_supplier . '`)">Delete</button>
                            </div>
                        </div>
                        ';
            })->rawColumns(['aksi'])->make(true);
    }
    public function showdata_id($id)
    {
        $posts = supplier::where('id_supplier', $id)->get();
        echo json_encode($posts);
    }
    public function getID()
    {
        $getcode = DB::select('Select max(id_supplier) as MaxKode FROM supplier');
        $sup = '';
        foreach ($getcode as $item) {
            $no_urut = (int) substr($item->MaxKode, 2, 7);
            $no_urut++;
            $kode = 'SP' . sprintf("%07s", $no_urut);
            $sup = $kode;
        }
        return $sup;
    }
    public function create()
    {
        $sup = $this::getID();
        $tgl = date("Y-m-d");
        // $posts = DB::select("select * from supplier where date(created_at) = '$tgl'");
        return view('Administrator.Supplier.Form.Create', compact('sup'));
    }

    public function get_supplier_based_on_today()
    {
        $tgl = date("Y-m-d");
        $posts = DB::select("select * from supplier where date(created_at) = '$tgl'");
        return \DataTables::of($posts)
            ->addColumn('aksi', function ($posts) {
                // $id = '1';
                return '<a href="' . $posts->id_supplier . '"class="badge badge-success">Update</a><a href="' . $posts->id_supplier . '"class="badge badge-danger">Delete</a>';
            })->rawColumns(['aksi'])->make(true);
    }
    public function act_supplier(Request $req)
    {
        $tgl = date("Y-m-d");
        $attr = [
            'id_supplier' => $req->id,
            'supplier' => $req->name,
            'alamat' => $req->alamat,
            'notel' => $req->telp,
        ];
        supplier::create($attr);
        $sup = $this::getID();
        echo json_encode(["added", $sup]);
    }
    public function remove($id)
    {
        supplier::where('id_supplier', $id)->delete();
        echo json_encode('remove');
    }
    public function update(Request $req)
    {
        $attr = [
            'supplier' => $req->name,
            'alamat' => $req->alamat,
            'notel' => $req->telp,
        ];
        supplier::where('id_supplier', $req->id)->update($attr);
        session()->flash('success', 'Data Berhasil di update');
        return redirect()->to('supplier');
    }
}
