<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_user extends Model
{
    protected $table = 'users';
    protected $fillable = ['nik', 'nama', 'tmp_lahir', 'tgl_lahir', 'Alamat', 'pic'];
}
