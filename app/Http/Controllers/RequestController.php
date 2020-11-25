<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RequestController extends Controller
{
    public function index()
    {
        $posts = DB::select("select * from request_item order by id DESC");
        return view('Administrator.Request.index', compact('posts'));
    }

    public function request_form()
    {
        $post = Barang::get();
        return view('Administrator.Request.Form.form_request', compact('post'));
    }
    public function act_req_item(Request $req)
    {
        $user = Session::get('nama');
        $qty = $req->qty;
        $item = $req->item;
        $satuan = $req->satuan;
        $keterangan = $req->keterangan;
        $i = 0;
        $arr = array();
        $inserRq = [
            'keterangan' => $req->ket,
            'user' => $user,
            'status' => 0
        ];
        ModelsRequest::create($inserRq);
        $get_idrq = ModelsRequest::orderByDesc('id')->get();
        $id = $get_idrq[0]->id;
        for ($i; $i < count($req->item); $i++) {
            $item_d = [
                'id_rq' => $id,
                'code_item' => $arr['item'] = $item[$i],
                'qty' => $arr['qty'] = $qty[$i],
                'satuan' => $arr['satuan'] = $satuan[$i],
                'keterangan' => $arr['keterangan'] = $keterangan[$i],
            ];
            DB::table('request_item_d')->insert($item_d);
        }
        session()->flash('success', 'Data Berhasil di post');
        return redirect()->to('request');
    }
}
