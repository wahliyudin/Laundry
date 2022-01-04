<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketTransaksi extends Model
{
    use HasFactory;
    protected $table = 'paket_transaksis';
    protected $fillable = [
        'id_transaksi',
        'id_paket',
        'berat',
        'subtotal',
        'estimasi'
    ];
}
