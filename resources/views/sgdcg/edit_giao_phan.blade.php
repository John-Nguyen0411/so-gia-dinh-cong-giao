<div>
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sổ gia đình công giáo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="giao_phan">Mã sổ</label>
                            <input type="text" wire:model="ma_so" class="form-control" placeholder="Nhập mã sổ">
                            @if($errors->has('ma_so'))
                                <span class="text-danger">{{ $errors->first('ma_so') }}</span>
                            @endif
                        </div>
                        <div class="form-group" >
                            <label for="giao_phan">Tên giáo phận</label>
                            <select id="giao_phan_id" class="form-control mb-3" name="giao_phan_id" wire:change="changeGiaoHat" wire:model="giao_phan_id">
                                <option selected>Chọn giáo phận</option>
                                @foreach($all_giao_phan as $gt)
                                    <option value="{{ $gt->id }}"> {{ $gt->ten_giao_phan  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="giao_phan">Tên giáo xứ</label>
                            <select id="giao_hat" class="form-control mb-3" name="giao_hat_id"  wire:model="giao_hat_id">
                                @if($giao_hat_id == null)
                                <option selected value="">Chọn giáo hạt</option>
                                @endif
                                @if($all_giao_hat->count() > 0)
                                    @foreach($all_giao_hat as $gt)
                                        <option value="{{ $gt->id }}"> {{ $gt->ten_giao_hat  }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="giao_phan">Tên giáo xứ</label>
                            <select class="form-control mb-3" name="giao_xu_id" wire:model="giao_xu_id">
                                @if($giao_xu_id == null)
                                    <option selected value="">Chọn giáo xứ</option>
                                @endif
                                @foreach($all_giao_xu as $gt)
                                    <option value="{{ $gt->id }}"> {{ $gt->ten_giao_xu  }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('giao_xu_id'))
                                <span class="text-danger">{{ $errors->first('giao_xu_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <label >Ngày tạo sổ</label>
                            <input type="date" wire:model="ngay_tao_so" class="form-control col-md-5">
                            @if($errors->has('ngay_tao_so'))
                                <span class="text-danger">{{ $errors->first('ngay_tao_so') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Lưu lại</button>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>