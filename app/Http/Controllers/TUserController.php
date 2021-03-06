<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TUserController extends Controller
{
    public function index()
    {

        return view('Administrator.User.index');
    }
    public function show_user()
    {
        $post = DB::select("select users.*, akses.* from users inner join akses on users.id_akses=akses.akses_id");
        // $post = DB::select("select * from users");
        return \DataTables::of($post)
            ->addColumn('aksi', function ($post) {
                return
                    '<div class="dropdown show">
                            <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <button class="dropdown-item" onclick="edit(`' . $post->nik . '`)">Edit</button>
                                <button class="dropdown-item" onclick="hapus(`' . $post->nik . '`)">Delete</button>
                            </div>
                        </div>
                        ';
            })->rawColumns(['aksi'])->make(true);
    }
    public function select()
    {
        $qry = DB::table('akses')->get();
        $return = '<option selected disabled>Pilih Position</option>';
        foreach ($qry as $item) {
            $return .= '<option value=' . $item->akses_id . '>' . $item->akses . '</option>';
        }
        echo json_encode($return);
    }

    public function act(Request $req, $act)
    {
        if ($act == "Simpan") {
            $attr = [
                'nik' => $req->id,
                'nama' => $req->name,
                'temp_lahir' => $req->tempat,
                'tgl_lahir' => $req->tgl_lahir,
                'Alamat' => $req->alamat,
                'id_akses' => $req->position,
                'pic' => 'default.png',
            ];
            DB::table('users')->insert($attr);
        } else {
            $attr = [
                'nik' => $req->id,
                'nama' => $req->name,
                'temp_lahir' => $req->tempat,
                'tgl_lahir' => $req->tgl_lahir,
                'Alamat' => $req->alamat,
                'id_akses' => $req->position,
                'pic' => 'default.png',
            ];
            DB::table('users')->where('nik', $req->id,)->update($attr);
        }
        echo json_encode("Berhasil");
    }
    public function get_where($nik)
    {
        $qry = DB::table('users')->where('nik', $nik)->get();
        echo json_encode($qry);
    }
    public function remove($nik)
    {
        DB::table('users')->where('nik', $nik)->delete();
        echo json_encode("remove");
    }
}
