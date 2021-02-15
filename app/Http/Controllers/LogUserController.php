<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogUserController extends Controller
{
    public function index()
    {

        return view('Administrator.LogUser.index');
    }
    public function show_user()
    {
        $post = DB::select("select * from Log_user");
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
                                <button class="dropdown-item" onclick="hapus(`' . $post->id_user . '`)">Delete</button>
                            </div>
                        </div>
                        ';
            })->rawColumns(['aksi'])->make(true);
    }
    public function select()
    {
        $qry = DB::select("SELECT log_user.*, users.* from log_user RIGHT JOIN users on users.nik=log_user.nik where log_user.nik is null");
        $return = '<option selected disabled>Pilih User</option>';
        foreach ($qry as $item) {
            $return .= '<option value=' . $item->nik . '>' . $item->nama . '</option>';
        }
        echo json_encode($return);
    }

    public function act(Request $req, $act)
    {
        if ($act == "Simpan") {
            $attr = [
                'nik' => $req->nik,
                'username' => $req->username,
                'password' => $req->password,
            ];
            DB::table('log_user')->insert($attr);
        } else {
            $attr = [
                'username' => $req->username,
                'password' => $req->password,
            ];
            DB::table('log_user')->where('id_user', $req->id,)->update($attr);
        }
        echo json_encode("Berhasil");
    }
    public function get_where($nik)
    {
        $qry = DB::table('log_user')->where('nik', $nik)->get();
        echo json_encode($qry);
    }
    public function remove($id)
    {
        DB::table('log_user')->where('id_user', $id)->delete();
        echo json_encode("remove");
    }
}
