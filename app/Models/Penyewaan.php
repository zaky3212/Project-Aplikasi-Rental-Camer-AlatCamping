<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $table = 'penyewaans';
    protected $guarded = ['id'];

    public function detail_penyewaan()
    {
        return $this->hasMany(DetailPenyewaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}