<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detailTransaksi()
{
    return $this->hasMany(DetailTransaksi::class);
}

}

