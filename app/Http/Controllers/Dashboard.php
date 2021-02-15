<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{
    public function index()
    {
        $nik = Session::get('nik');
        $brg = \DB::table('barang')->count();
        $getreq = \DB::select('select * from request_item where status not in(5)');
        $req = count($getreq);
        $process = \DB::table('request_item')->where('status', 3)->count();
        $user = \DB::table('users')->count();
        $users = \DB::select("select users.*, akses.* from users inner join akses on akses.akses_id=users.id_akses where users.nik='$nik'");
        // dd($users);
        return view('Administrator.index', compact(['brg', 'req', 'process', 'user', 'users']));
    }
}
