<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $table = "supplier";
    protected $fillable = ['id_supplier', 'supplier', 'alamat', 'notel'];
}
