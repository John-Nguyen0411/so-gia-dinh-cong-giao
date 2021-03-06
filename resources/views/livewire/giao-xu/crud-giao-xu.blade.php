<div>
    @include('giao_xu.add_new')
    @include('giao_xu.edit')
    @include('giao_xu.delete')
    <div class="card-header">
        <h4 class="card-title">Danh sách các giáo xứ </h4>
        <div>
            <button
                    data-toggle="modal" wire:click="clearData()" data-target="#giaoHatModal"
                    class="btn btn-primary">Thêm giáo xứ mới
            </button>
        </div>
    </div>
    <div class="card-body" wire:ignore>
        <div class="table-responsive">
            <table id="example3" class="display" style="min-width: 845px; width: 100%">
                <thead>
                <tr>
                    <th style="width: 20px">STT</th>
                    <th >Tên giáo xứ</th>
                    <th >Địa chỉ</th>
                    <th class="text-center" style="width: 120px">Năm thành lập</th>
                    <th class="text-center" style="width: 100px">Tổng giáo họ</th>
                    <th >Giáo Phận <br> Giáo Hạt</th>
                    <th >Chỉnh sửa</th>
                </tr>
                </thead>
                <tbody>
                @php $i= 0; @endphp
                @foreach($all_giao_xu as $giao_xu)
                    <tr>
                        <td class="text-center"> {{ ++$i }}</td>
                        <td>{{ $giao_xu->ten_giao_xu }}</td>
                        <td>{{ $giao_xu->dia_chi }}</td>
                        <td class="text-center">
                            @if(\Carbon\Carbon::parse($giao_xu->ngay_thanh_lap)->format('d-m') == '01-01' )
                                {{ \Carbon\Carbon::parse($giao_xu->ngay_thanh_lap)->format('Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($giao_xu->ngay_thanh_lap)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td class="text-center">{{ $giao_xu->giao_ho_count }}</td>
                        <td>
                            @if($giao_xu->giaoHat)
                                {{ $giao_xu->giaoHat->giaoPhan->ten_giao_phan}} <br> {{$giao_xu->giaoHat->ten_giao_hat }}
                            @endif
                        </td>
                        <td>
                            <button type="button"
                                    wire:click="edit({{ $giao_xu->id }})"
                                    class="btn btn-sm btn-primary mb-1"
                                    data-toggle="modal"
                                    data-target="#editGiaoHat">
                                <i class="la la-pencil"></i>
                            </button>
                            <button type="button" wire:click="edit({{ $giao_xu->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteGiaoHat"
                                    class="btn btn-outline-danger btn-sm d-inline-block mb-1">
                                <i class="la la-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.addEventListener('contentChanged', event => {
            $('.select').selectpicker();
        });
    </script>
@endpush