<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $brg = \DB::table('barang')->count();
        $req = \DB::table('request_item')->where('status', 0)->count();
        $process = \DB::table('request_item')->where('status', 1)->count();
        $user = \DB::table('users')->count();
        // dd($req);
        return view('Administrator.index', compact(['brg', 'req', 'process', 'user']));
    }
}
