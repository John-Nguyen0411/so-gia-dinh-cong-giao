<?php

namespace App\Http\Livewire\TuSi;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\LichSuCongTac;
use App\Models\NhaDong;
use App\Models\TenThanh;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditTuSi extends Component
{

    public $tu_si, $giao_hat_id, $giao_xu_id, $ten_thanh_id, $vi_tri_id, $nha_dong_id, $giao_phan_id, $chuc_vu_id;
    public $ho_va_ten,
        $la_tong_giam_muc,
        $giao_tinh_id,
        $ngay_sinh,
        $email,
        $ngay_mat,
        $check_save_info,
        $gioi_tinh,
        $dia_chi_hien_tai,
        $so_dien_thoai,
        $ngay_nhan_chuc,
        $noi_nhan_chuc,
        $dang_du_hoc,
        $nguoi_khoi_tao,
        $bat_dau_phuc_vu,
        $ket_thuc_phuc_vu;

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $all_ten_thanh = TenThanh::select('id', 'ten_thanh')->orderBy('ten_thanh')->get();
        $all_vi_tri = \App\Models\ViTri::select('id', 'ten_vi_tri')->get();
        $all_nha_dong = NhaDong::select('id', 'ten_nha_dong')->get();
        $all_giao_phan = GiaoPhan::with('giaoTinh')->get();
        $all_chuc_vu = ChucVu::select('id', 'ten_chuc_vu')->get();

        if ($this->giao_phan_id) {
            $all_giao_hat = GiaoHat::select('id', 'giao_phan_id','ten_giao_hat')
                ->where('giao_phan_id', $this->giao_phan_id)->get();
        }else{
            $all_giao_hat = null;
        }
        if ($this->giao_hat_id) {
            $all_giao_xu =  GiaoXu::select('id', 'giao_hat_id','ten_giao_xu', 'giao_xu_hoac_giao_ho')
                ->where('giao_hat_id', $this->giao_hat_id)->get();
        }else{
            $all_giao_xu = null;
        }

        return view('livewire.tu-si.edit-tu-si', compact('all_giao_phan',
            'all_giao_xu', 'all_ten_thanh', 'all_giao_hat', 'all_giao_phan', 'all_vi_tri', 'all_nha_dong', 'all_chuc_vu'));
    }

    public function mount($tu_si)
    {
        $this->tu_si = $tu_si;
        $this->edit();
    }

    public function edit(){
        $this->ho_va_ten = $this->tu_si->ho_va_ten;
        $this->la_tong_giam_muc = $this->tu_si->la_tong_giam_muc;
        $this->giao_tinh_id = $this->tu_si->giao_tinh_id;
        $this->ngay_sinh = $this->tu_si->ngay_sinh;
        $this->email = $this->tu_si->email;
        $this->ngay_mat = $this->tu_si->ngay_mat;
        $this->gioi_tinh = $this->tu_si->gioi_tinh;
        $this->dia_chi_hien_tai = $this->tu_si->dia_chi_hien_tai;
        $this->so_dien_thoai = $this->tu_si->so_dien_thoai;
        $this->ngay_nhan_chuc = $this->tu_si->ngay_nhan_chuc;
        $this->noi_nhan_chuc = $this->tu_si->noi_nhan_chuc;
        $this->dang_du_hoc = $this->tu_si->dang_du_hoc ? true : false;
        $this->giao_hat_id = $this->tu_si->giao_hat_id ;
        $this->giao_xu_id = $this->tu_si->giao_xu_id ;
        $this->ten_thanh_id = $this->tu_si->ten_thanh_id ;
        $this->vi_tri_id = $this->tu_si->vi_tri_id ;
        $this->nha_dong_id = $this->tu_si->nha_dong_id ;
        $this->giao_phan_id = $this->tu_si->giao_phan_id ;
        $this->chuc_vu_id = $this->tu_si->chuc_vu_id ;
    }

    protected $rules = [
        'ho_va_ten' => 'required|max:45',
        'ten_thanh_id' => 'required',
        'nha_dong_id' => 'nullable',
        'chuc_vu_id' => 'required',
        'email' => 'email',
        'la_tong_giam_muc' => 'max:1',
        'gioi_tinh' => 'required',
        'giao_phan_id' =>'required',
        'ngay_nhan_chuc' => 'date|nullable',
        'ngay_sinh' => 'required|date|nullable',
        'ngay_mat' => 'date|nullable|after:ngay_sinh',
        'so_dien_thoai' =>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'dia_chi_hien_tai' => 'max:100|nullable',
        'noi_nhan_chuc' => 'max:100|nullable',
        'bat_dau_phuc_vu' => 'date|nullable|after:ket_thuc_phuc_vu',
        'ket_thuc_phuc_vu' => 'date|nullable',
        'giao_xu_id' => 'nullable',
        'giao_hat_id' => 'nullable',
        'vi_tri_id' => 'nullable'
    ];

    protected $messages = [
        'ho_va_ten.required' => ':attribute kh??ng ???????c ph??p tr???ng',
        'ten_thanh_id.required' => ':attribute kh??ng ???????c ph??p tr???ng',
        'chuc_vu_id.required' => ':attribute kh??ng ???????c ph??p tr???ng',
        'giao_phan_id.required' => ':attribute kh??ng ???????c ph??p tr???ng',
        'dia_chi_hien_tai.max' => ':attribute kh??ng ???????c v?????t qu?? :max',
        'noi_nhan_chuc.max' => ':attribute kh??ng ???????c v?????t qu?? :max',
        'noi_nhan_chuc.required' => ':attribute kh??ng ???????c ph??p tr???ng',
        'ngay_nhan_chuc.date' => ':attribute ph???i l?? gi?? tr??? ng??y th??ng n??m',
        'ngay_nhan_chuc.required' => ':attribute kh??ng ???????c ph??p tr???ng',
        'bat_dau_phuc_vu.date' => ':attribute ph???i l?? gi?? tr??? ng??y th??ng n??m',
        'ngay_mat.date' => ':attribute ph???i l?? gi?? tr??? ng??y th??ng n??m',
        'ngay_mat.after' => ':attribute kh??ng ???????c nh??? h??n ho???c b???ng ng??y sinh',
        'ngay_sinh.date' => ':attribute ph???i l?? gi?? tr??? ng??y th??ng n??m',
        'ngay_sinh.required' => ':attribute kh??ng ???????c ph??p tr???ng',
        'ket_thuc_phuc_vu.date' => ':attribute ph???i l?? gi?? tr??? ng??y th??ng n??m',
        'so_dien_thoai.min' => ':attribute kh??ng ???????c nh??? h??n :min k?? t???',
        'so_dien_thoai.regex' => ':attribute ph???i l?? ch??? s???',
        'bat_dau_phuc_vu.after' => 'Ng??y b???t ?????u ph???c v??? gi??o x??? m???i ph???i l???n h??n ng??y k???t th??c.',
        'email.email' => 'Gi?? tr??? nh???p ph???i ????ng d???ng email',
        'la_tong_giam_muc.max' => 'Ch???c v??? kh??ng tr??ng kh???p',
        'gioi_tinh.required' => 'Gi???i t??nh kh??ng ???????c ph??p tr???ng'
    ];

    protected $validationAttributes = [
        'ho_va_ten'  => 'H??? v?? t??n',
        'ten_thanh_id'   => 'T??n th??nh',
        'chuc_vu_id'      => 'Ch???c v???',
        'giao_phan_id'   => 'Gi??o ph???n',
        'dia_chi_hien_tai' => '?????a ch??? hi???n t???i',
        'noi_nhan_chuc' => 'N??i nh???n ch???c',
        'ngay_sinh' => 'Ng??y th??ng n??m sinh',
        'ngay_mat' => 'Ng??y m???t',
        'ngay_nhan_chuc' => 'Ng??y nh???n ch???c',
        'bat_dau_phuc_vu'  => 'Ng??y b???t ?????u ph???c v???',
        'ket_thuc_phuc_vu'  => 'Ng??y k???t th??c ph???c v???',
        'so_dien_thoai' => 'S??? ??i???n tho???i'
    ];


    public function update()
    {
        $validatedData = $this->validate();
        $this->dang_du_hoc = $this->dang_du_hoc ? 1 : 0;
        if ($validatedData['chuc_vu_id'] !== $this->tu_si->chuc_vu_id
            && $validatedData['ngay_nhan_chuc'] !== $this->tu_si->ngay_nhan_chuc) {
            \App\Models\LichSuNhanChuc::create([
                'ngay_nhan_chuc' => $this->tu_si->ngay_nhan_chuc,
                'noi_nhan_chuc' => $this->tu_si->noi_nhan_chuc,
                'chuc_vu' => $this->tu_si->chucVu->ten_chuc_vu,
                'tu_si_id' => $this->tu_si->id,
                'nguoi_khoi_tao' => Auth::id(),
            ]);
        }
        $this->tu_si->update(array_merge($validatedData,
            ['nguoi_khoi_tao' => Auth::id(), 'dang_du_hoc' => $this->dang_du_hoc]
        ));
        Toastr::success('C???p nh???p th??nh c??ng', 'Th??nh c??ng');
        return redirect()->route('tu-si.edit', $this->tu_si);
    }

    public function endNhiemSo(){
        if($this->tu_si->ket_thuc_phuc_vu){
            throw ValidationException::withMessages(['ket_thuc_phuc_vu' => 'Ng??y k???t th??c ???? t???n t???i h??y ch???n ch???c n??ng c???p nh???p']);
        }
        if ($this->ket_thuc_phuc_vu == null) {
            throw ValidationException::withMessages(['ket_thuc_phuc_vu' => 'Ng??y k???t th??c nhi???m s??? kh??ng ???????c ph??p tr???ng']);
        }
        if ($this->tu_si->bat_dau_phuc_vu == null){
            throw ValidationException::withMessages(['ket_thuc_phuc_vu' => 'Kh??ng c?? nhi???m s??? n??o ????? k???t th??c.']);
        }
        LichSuCongTac::create([
            'tu_si_id' => $this->tu_si->id,
            'ten_giao_phan' => $this->tu_si->giaoPhan->ten_giao_phan,
            'ten_giao_hat' =>$this->tu_si->giaoHat->ten_giao_hat,
            'ten_giao_xu' => $this->tu_si->giaoXu->ten_giao_xu,
            'bat_dau_phuc_vu' => $this->tu_si->bat_dau_phuc_vu,
            'ket_thuc_phuc_vu' => $this->ket_thuc_phuc_vu,
            'ten_vi_tri' => $this->tu_si->viTri ? $this->tu_si->viTri->ten_vi_tri : ''
        ]);
        $this->tu_si->update(
            [
                'bat_dau_phuc_vu' => null,
                'ket_thuc_phuc_vu' => null,
                'vi_tri_phuc_vu' => null,
                'giao_hat_id' => null,
                'giao_xu_id' => null,
            ]
        );
        Toastr::success('C???p nh???p th??nh c??ng', 'Th??nh c??ng');
        return redirect()->route('tu-si.edit', $this->tu_si);
    }

    public function startNhiemSo(){
        $this->validate([
            'giao_xu_id' => 'required',
            'giao_hat_id' => 'required',
            'vi_tri_id' => 'required',
            'bat_dau_phuc_vu' => 'required|date',

        ], [
            'giao_xu_id.required' => 'Gi??o x??? kh??ng ???????c ph??p tr???ng',
            'vi_tri_id.required' => 'V??? tr?? kh??ng ???????c ph??p tr???ng',
            'giao_hat_id.required' => 'Gi??o h???t kh??ng ???????c ph??p tr???ng',
            'bat_dau_phuc_vu.required' => 'Ng??y b???t ?????u kh??ng ???????c ph??p tr???ng',
            'bat_dau_phuc_vu.date' => 'Ng??y b???t ?????u ph???i ????ng d???ng ng??y th??ng n??m',
        ]);
        if(!$this->tu_si->ket_thuc_phuc_vu && $this->tu_si->bat_dau_phuc_vu){
            throw ValidationException::withMessages(['ket_thuc_phuc_vu' => 'K???t th??c nhi???m s??? c?? m???i ???????c ph??p chuy???n nhi???m s???']);
        }
        $this->tu_si->update([
                'giao_xu_id' => $this->giao_xu_id,
                'giao_hat_id' => $this->giao_hat_id,
                'vi_tri_id' => $this->vi_tri_id,
                'bat_dau_phuc_vu' => $this->bat_dau_phuc_vu,
                'ket_thuc_phuc_vu' => null
                ]
        );
        Toastr::success('C???p nh???p th??nh c??ng', 'Th??nh c??ng');
        return redirect()->route('tu-si.edit', $this->tu_si);
    }

}
