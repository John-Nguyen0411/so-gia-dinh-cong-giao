<div>
    @include('ten_thanh.add_new')
    @include('ten_thanh.edit')
    @include('ten_thanh.delete')
    @include('ten_thanh.import')
    <div class="card-header">
        <h4 class="card-title">Danh sách các tên thánh </h4>
        <div>
            <a href="{{ route('sgdcg-file-export', ['name' => 'ten_thanh'])}}"
               class="btn btn-info mt-1">Excel mẫu
            </a>
            <button
                    data-toggle="modal" data-target="#importModal"
                    class="btn btn-info mt-1">Nhập Excel tên thánh, chức vụ, vị trí Giáo Xứ
            </button>
            <button
                    data-toggle="modal" wire:click="clearData" data-target="#giaoHatModal"
                    class="btn btn-primary mt-1">Thêm tên thánh
            </button>
        </div>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px">
                <thead>
                <tr>
                    <th style="width: 20px">STT</th>
                    <th>Tên tên thánh</th>
                    <th>Người cập nhập</th>
                    <th>Cập nhập lần cuối</th>
                    <th>Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_ten_thanh as $th)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td> {{ $th->ten_thanh }}</td>
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
                            @if($th->giao_dan_count == 0)
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
