@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-4 p-md-0">
                    <div class="welcome-text">
                        <h4>Thêm thành viên vào sổ <br> <strong>{{ $sgdcg->ma_so }}</strong></h4>
                    </div>
                </div>
                <div class="col-sm-8 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('so-gia-dinh.index') }}">Sổ gia đình công giáo</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('so-gia-dinh.show', $sgdcg)}}">Thông tin sổ gia
                                đình</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thêm thành viên</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div>
                                    <div class="card-header">
                                        <h4 class="card-title">Thông tin thành viên</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('so-gia-dinh.storeTV', $sgdcg->id ) }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Tên thánh</lable>
                                                            <select class="selectpicker  form-control pt-2"
                                                                    name="ten_thanh_id" data-live-search="true">
                                                                <option selected value=""> Chọn tên thánh</option>
                                                                @foreach($all_ten_thanh as $cv)
                                                                    <option value="{{ $cv->id }}" {{ old('ten_thanh_id') == $cv->id ? 'selected' : '' }}> {{ $cv->ten_thanh }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('ten_thanh_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label" style="margin-bottom: 7px;">Họ và
                                                            tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ho_va_ten') }}" name="ho_va_ten">
                                                    </div>
                                                    @if($errors->has('ho_va_ten'))
                                                        <span class="text-danger  font-weight-bold">{{ $errors->first('ho_va_ten') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <div>
                                                            <lable class="form-label ">Giới tính</lable>
                                                            <select class="selectpicker form-control pt-2"
                                                                    name="gioi_tinh">
                                                                <option value="0" {{ old('gioi_tinh') == 0 ? 'selected' : '' }}>
                                                                    Nữ
                                                                </option>
                                                                <option selected
                                                                        value="1" {{ old('gioi_tinh') == 1 ? 'selected' : '' }}>
                                                                    Nam
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('gioi_tinh'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('gioi_tinh') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize"
                                                               style="margin-bottom: 7px;">Chức vụ trong gia
                                                            đình</label>
                                                        <select class="selectpicker form-control pt-2"
                                                                name="chuc_vu_gd">
                                                            <option value="" selected>Chọn chức vụ gia đình</option>
                                                            <option value="Cha">Cha</option>
                                                            <option value="Mẹ">Mẹ</option>
                                                            <option value="Con">Con</option>
                                                        </select>
                                                    </div>
                                                    @if($errors->has('chuc_vu_gd'))
                                                        <span class="text-danger  font-weight-bold">{{ $errors->first('chuc_vu_gd') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <label>Ngày sinh</label>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <input type="date" value="{{ old('ngay_sinh')}}"
                                                               name="ngay_sinh" class="form-control col-md-5">
                                                        <label>Hoặc nhập năm:</label>
                                                        <input type="number" value="{{ old('nam_sinh')}}"
                                                               name="nam_sinh" class="form-control col-md-3">
                                                    </div>
                                                    @if($errors->has('ngay_sinh'))
                                                        <span class="text-danger">{{ $errors->first('ngay_sinh') }}</span>
                                                    @endif
                                                    @if($errors->has('nam_sinh'))
                                                        <span class="text-danger">{{ $errors->first('nam_sinh') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label" style="margin-bottom: 7px;">Nơi
                                                            sinh</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('noi_sinh') }}" name="noi_sinh">
                                                    </div>
                                                    @if($errors->has('noi_sinh'))
                                                        <span class="text-danger  font-weight-bold">{{ $errors->first('noi_sinh') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Ngày mất</label>
                                                        <input type="date" class="form-control "
                                                               value="{{ old('ngay_mat')}}"
                                                               name="ngay_mat"
                                                        >
                                                    </div>
                                                    @if($errors->has('ngay_mat'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ngay_mat') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Số điện thoại</label>
                                                        <input type="tel" class="form-control "
                                                               value="{{ old('so_dien_thoai')}}" name="so_dien_thoai">
                                                    </div>
                                                    @if($errors->has('so_dien_thoai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('so_dien_thoai') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Địa chỉ</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('dia_chi_hien_tai')}}"
                                                               name="dia_chi_hien_tai">
                                                    </div>
                                                    @if($errors->has('dia_chi_hien_tai'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('dia_chi_hien_tai') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <h4><strong>Thêm bí tích</strong></h4>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Tên bí tích
                                                            </lable>
                                                            <select onchange="changeForm()" id="bi_tich"
                                                                    class="selectpicker form-control pt-2"
                                                                    name="bi_tich_id" data-live-search="true">
                                                                <option selected value=""> Chọn tên bí tích</option>
                                                                @foreach($all_bi_tich as $cv)
                                                                    <option value="{{ $cv->id }}" {{ old('bi_tich_id') == $cv->id ? 'selected' : '' }}>
                                                                        {{ $cv->ten_bi_tich }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('bi_tich_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('bi_tich_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Tên linh mục hoặc
                                                                giám mục
                                                            </lable>
                                                            <select class="selectpicker  form-control pt-2"
                                                                    name="tu_si_id" id="tu_si" data-live-search="true">
                                                                <option value="null" selected>Chọn linh mục</option>
                                                                @foreach($all_tu_si as $cv)
                                                                    @if($cv->giaoXu)
                                                                        @if($cv->giao_xu_id == \Illuminate\Support\Facades\Auth::user()->giao_xu_id)
                                                                            <option value="{{ $cv->id }}" selected>
                                                                                {{ 'Giáo xứ '. $cv->giaoXu->ten_giao_xu.': '. $cv->tenThanh->ten_thanh .' '. $cv->ho_va_ten }}</option>
                                                                        @else
                                                                            <option value="{{ $cv->id }}"
                                                                                    {{ old('tu_si_id') == $cv->id ? 'selected' : '' }}>
                                                                                {{ 'Giáo xứ '. $cv->giaoXu->ten_giao_xu.': '. $cv->tenThanh->ten_thanh .' '. $cv->ho_va_ten }}</option>
                                                                        @endif
                                                                    @else
                                                                        <option value="{{ $cv->id }}"
                                                                                {{ old('tu_si_id') == $cv->id ? 'selected' : '' }}>
                                                                            {{ $cv->tenThanh->ten_thanh .' '. $cv->ho_va_ten }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('tu_si_id'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('tu_si_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize"
                                                               style="margin-bottom: 7px;">Ngày diễn ra</label>
                                                        <input type="date" class="form-control"
                                                               value="{{ old('ngay_dien_ra') ?? \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                               name="ngay_dien_ra">
                                                    </div>
                                                    @if($errors->has('ngay_dien_ra'))
                                                        <span class="text-danger  font-weight-bold">{{ $errors->first('ngay_dien_ra')  }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize"
                                                               style="margin-bottom: 7px;">Hoặc nhập tên linh
                                                            mục</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('linh_muc_ngoai')}}"
                                                               name="linh_muc_ngoai">
                                                    </div>
                                                    @if($errors->has('linh_muc_ngoai'))
                                                        <span class="text-danger  font-weight-bold">{{ $errors->first('linh_muc_ngoai')  }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Nơi diễn ra</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('noi_dien_ra') ?? 'Giáo xứ '. $ten_giao_xu->ten_giao_xu }}"
                                                               name="noi_dien_ra">
                                                    </div>
                                                    @if($errors->has('noi_dien_ra'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('noi_dien_ra') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <h5><strong> Thông tin người đỡ đầu </strong></h5>
                                                </div>
                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <lable class="form-label text-capitalize">Tên thánh</lable>
                                                            <select class="selectpicker  form-control pt-2"
                                                                    name="ten_thanh_nguoi_do_dau"
                                                                    data-live-search="true">
                                                                <option selected value=""> Chọn tên thánh</option>
                                                                @foreach($all_ten_thanh as $cv)
                                                                    <option value="{{ $cv->ten_thanh }}"
                                                                            {{ old('ten_thanh_nguoi_do_dau') == $cv->ten_thanh ? 'selected' : '' }}>
                                                                        {{ $cv->ten_thanh }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('ten_thanh_nguoi_do_dau'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ten_thanh_nguoi_do_dau') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 mt-2 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-capitalize">Họ và tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ old('ten_nguoi_do_dau')}}"
                                                               name="ten_nguoi_do_dau">
                                                    </div>
                                                    @if($errors->has('ten_nguoi_do_dau'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ten_nguoi_do_dau')}}</span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 mt-2 col-md-6 col-sm-12">
                                                    <label>Ngày sinh</label>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <input type="date" value="{{ old('ngay_sinh_nguoi_do_dau')}}"
                                                               name="ngay_sinh_nguoi_do_dau"
                                                               class="form-control col-md-5">
                                                        <label>Hoặc nhập năm:</label>
                                                        <input type="number"
                                                               value="{{ old('nam_sinh_nguoi_do_dau')}}"
                                                               name="nam_sinh_nguoi_do_dau"
                                                               class="form-control col-md-3">
                                                    </div>
                                                    @if($errors->has('ngay_sinh_nguoi_do_dau'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('ngay_sinh_nguoi_do_dau') }}</span>
                                                    @endif
                                                    @if($errors->has('nam_sinh'))
                                                        <span class="text-danger font-weight-bold">{{ $errors->first('nam_sinh_nguoi_do_dau') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-12 mt-4 col-md-12 col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                                    <a class="btn btn-light"
                                                       href="{{ route('so-gia-dinh.show', $sgdcg)  }}">Quay lại
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

