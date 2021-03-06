<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class GiaoHat extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;
    protected $dates = ['deleted_at'];

    protected $table = 'giao_hat';

    protected $fillable = [
        'ten_giao_hat',
        'dia_chi',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_phan_id'
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($q) {
            $q->giaoXu()->delete();
            $q->giaoDan()->delete();
            $q->tuSi()->delete();
            $q->hoGiaDinh()->delete();
        });
    }

    public function giaoPhan(){
        return $this->belongsTo(GiaoPhan::class);
    }

    public function giaoXu(){
        return $this->hasMany(GiaoXu::class);
    }

    public function tuSi(){
        return $this->hasMany(TuSi::class);
    }

    public function giaoDan(){
        return $this->hasManyDeep(ThanhVien::class, [GiaoXu::class, SoGiaDinh::class]);
    }

    public function hoGiaDinh(){
        return $this->hasManyThrough(SoGiaDinh::class, GiaoXu::class);
    }

    public function getTuSi(){
        return $this->hasManyThrough(TuSi::class,   GiaoXu::class,'giao_hat_id', 'giao_hat_id');
    }

    public function user($id){
        return User::find($id) ? User::find($id)->ho_va_ten : null;
    }
    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }

}
