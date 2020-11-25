<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Request extends Model
{
    use HasFactory;
    protected $table = 'request_item';
    protected $fillable = ['keterangan', 'user'];
}
