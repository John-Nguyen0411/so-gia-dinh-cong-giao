<div>
    @include('bi_tich.add_new')
    @include('bi_tich.edit')
    @include('bi_tich.delete')
    @include('ten_thanh.import')
    <div class="card-header">
        <h4 class="card-title">Danh sách các bí tích </h4>
        <div>
            <button
                    data-toggle="modal" wire:click="clearData()" data-target="#giaoHatModal"
                    class="btn btn-primary">Thêm bí tích
            </button>
        </div>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px">
                <thead>
                <tr>
                    <th style="width: 20px">STT</th>
                    <th>Tên bí tích</th>
                    <th>Người cập nhập</th>
                    <th>Cập nhập lần cuối</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_bi_tich as $th)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td> {{ $th->ten_bi_tich }}</td>
                        <td>{{ $th->getUser->ho_va_ten }}</td>
                        <td>{{ \Carbon\Carbon::parse($th->updated_at)->format('d-m-Y  H:i') }}</td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $th->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            @if($th->thanhVien->count() == 0)
                            <button type="button" wire:click="edit({{ $th->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteGiaoHat"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                <i class="la la-trash-o"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>