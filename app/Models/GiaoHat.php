<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoHat extends Model
{
    use HasFactory;

    protected $table = 'giao_hat';

    protected $fillable = [
        'ten_giao_hat',
        'dia_chi',
        'ten_nha_tho',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_phan_id'
    ];

    public function giaoPhan(){
        return $this->belongsTo(GiaoPhan::class);
    }

    public function giaoXu(){
        return $this->hasMany(GiaoXu::class);
    }


}
