<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TUserController extends Controller
{
    public function index()
    {
        $post = \DB::select("select users.*, akses.* from users inner join akses on users.id_akses=akses.akses_id");
        return view('Administrator.User.index', compact('post'));
    }
}
