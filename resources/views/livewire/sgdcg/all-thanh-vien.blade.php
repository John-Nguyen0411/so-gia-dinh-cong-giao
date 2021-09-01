<div>

    <div  class="card-body">
        <h4 class="font-weight-bold">Tìm kiếm</h4>
        <div class="d-flex flex-wrap mb-3">
            <div class="col-md-3">
                <label>Tên thánh</label>
                <select data-live-search="true" class="selectpicker  select form-control" wire:model="ten_thanh_id">
                    <option value="" selected>Chọn tên thánh</option>
                    @foreach($all_ten_thanh as $t)
                        <option value="{{ $t->id }}">{{ $t->ten_thanh }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Họ và tên</label>
                <input type="text" wire:model="ho_va_ten" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Sinh hoặc tử</label>
                <select class="form-control" wire:model="sinh_or_tu">
                    <option value="" selected>Lựa chọn sinh hoặc tử</option>
                    <option value="1">Sinh</option>
                    <option value="2">Tử</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Ngày bắt đầu</label>
                <input type="date" wire:model="start_date" class="form-control">
            </div>
            <div class="col-md-3 mt-3">
                <label>Ngày kết thúc</label>
                <input type="date"  wire:model="end_date"  class="form-control">
            </div>
            <div class="col-md-2 mt-3">
                <label>Hiển thị</label>
                <select class="form-control" wire:model="paginate_number">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table class="display table" style="min-width: 845px; width: 1050px">
                <thead>
                <tr>
                    <th style="width: 50px">STT</th>
                    <th style="width: 100px">Tên thánh</th>
                    <th style="width: 150px">Họ và tên</th>
                    <th style="width: 110px">Ngày sinh</th>
                    <th style="width: 110px">Ngày mất</th>
                    <th style="width: 80px">Số điện thoại</th>
                    <th style="width: 200px">Địa chỉ</th>
                    <th style="width: 50px">Sổ gia đình</th>
                    <th style="width: 50px">Xem chi tiết</th>
                </tr>
                </thead>
                <tbody >
                @php $i= 0; @endphp
                @foreach($all_thanh_vien as $th)
                    <tr >
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>
                            {{ $th->tenThanh->ten_thanh }}
                        </td>
                        <td> {{ $th->ho_va_ten }}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($th->ngay_sinh)->format('d-m') == '01-01' && strtotime($th->ngay_sinh) < strtotime(1980))
                                {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>
                            {{ $th->ngay_mat ? \Carbon\Carbon::parse($th->ngay_mat)->format('d-m-Y') : '' }}
                        </td>
                        <td>
                            {{ $th->so_dien_thoai }}
                        </td>
                        <td class="text-center">
                            {{ $th->dia_chi_hien_tai}}  {{ $th->dia_chi_hien_tai}} {{ $th->dia_chi_hien_tai}} {{ $th->dia_chi_hien_tai}} {{ $th->dia_chi_hien_tai}} {{ $th->dia_chi_hien_tai}} {{ $th->dia_chi_hien_tai}} {{ $th->dia_chi_hien_tai}}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('so-gia-dinh.show', $th->soGiaDinh)}}" class="text-primary">Xem </a>
                        </td>
                        <td class="text-center">
                            <a type="button"
                               href="{{ route('so-gia-dinh.editTV', ['sgdId' => $th->soGiaDinh->id, 'tvId' => $th->id]) }}"
                               class="btn btn-sm btn-primary">
                                <i class="la la-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex col-md-12 justify-content-end">
                {{ $all_thanh_vien->links()}}
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endsection