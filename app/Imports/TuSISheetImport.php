<?php

namespace App\Imports;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\TuSi;
use App\Models\ViTri;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TuSISheetImport implements ToCollection, WithHeadingRow
{
    private $vi_tri, $chuc_vu, $giao_phan, $giao_hat, $giao_xu, $ten_thanh;

    public function __construct()
    {
        $this->vi_tri = ViTri::select('id', 'ten_vi_tri')->get();
        $this->chuc_vu = ChucVu::select('id', 'ten_chuc_vu')->get();
        $this->giao_phan = GiaoPhan::select('id', 'ten_giao_phan')->get();
        $this->giao_hat = GiaoHat::select('id', 'ten_giao_hat')->get();
        $this->giao_xu = GiaoXu::select('id', 'ten_giao_xu')->get();
        $this->ten_thanh = TenThanh::select('id', 'ten_thanh')->get();
    }


    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $chuc_vu = $this->chuc_vu->where('ten_chuc_vu', $row['ten_chuc_vu'])->first();
            $vi_tri = $this->vi_tri->where('ten_vi_tri', $row['ten_vi_tri_phuc_vu'])->first();
            $giao_phan = $this->giao_phan->where('ten_giao_phan',$row['ten_giao_phan'])->first();
            $giao_hat = $this->giao_hat->where('ten_giao_hat',$row['ten_giao_hat'])->first();
            $giao_xu = $this->giao_xu->where('ten_giao_xu',$row['ten_giao_xu'])->first();
            $ten_thanh = $this->ten_thanh->where('ten_thanh',$row['ten_thanh'])->first();

//            if($giao_phan &&  $chuc_vu && $ten_thanh)
            TuSi::create([
                'ho_va_ten' => $row['ho_va_ten'],
                'ngay_sinh' => Carbon::parse($row['ngay_sinh'])->toDate(),
                'dia_chi_hien_tai' => $row['dia_chi_hien_tai'] ,
                'so_dien_thoai' => $row['so_dien_thoai'],
                'ngay_nhan_chuc' => Carbon::parse($row['ngay_nhan_chuc'])->toDate(),
                'noi_nhan_chuc' => $row['noi_nhan_chuc'],
                'dang_du_hoc' => $row['dang_du_hoc'],
                'nguoi_khoi_tao' => Auth::id(),
                'giao_phan_id' => $giao_phan->id,
                'giao_hat_id' => $giao_hat ? $giao_hat->id : null,
                'giao_xu_id' => $giao_xu ? $giao_xu->id : null,
                'ten_thanh_id' => $ten_thanh->id ,
                'chuc_vu_id' => $chuc_vu->id,
                'bat_dau_phuc_vu' => Carbon::parse($row['ngay_bat_dau_phuc_vu'])->toDate(),
                'vi_tri_id' =>  $vi_tri ? $vi_tri->id : null
            ]);
        }

    }
}