<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $fillable = [
        'nama',
        'harga',
        'estimasi',
        'keterangan',
        'is_active'
    ];
}
