<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $fillable = [
        'user_id',
        'tanggal',
        'no_wa',
        'alamat',
        'no_reference',
        'status_bayar',
        'status_pengerjaan',
        'grand_total'
    ];

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'paket_transaksis', 'id_transaksi', 'id_paket')->withPivot('berat',
        'subtotal', 'estimasi');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
