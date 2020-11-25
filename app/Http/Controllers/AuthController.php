<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function index(Request $req)
    {
        $user = $req->username;
        $pass = $req->password;
        // $qry = Auth::where('username',$user)->where('password', $pass)->get();
        $qry = DB::select("select * from log_user where username='$user' and password='$pass'");

        if ($qry) {
            $id = $qry[0]->nik;
            $data = DB::select("select users.*, akses.* from users inner join akses on akses.akses_id=users.id_akses where users.nik='$id'");
            Session::put('username', $user);
            Session::put('nik', $data[0]->nik);
            Session::put('nama', $data[0]->nama);
            Session::put('akses', $data[0]->akses);
            Session::put('id_akses', $data[0]->akses_id);
            echo json_encode('berhasil');
        } else {
            echo json_encode('gagal');
        }
    }
}
