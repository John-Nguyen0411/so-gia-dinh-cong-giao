@extends('layouts.st_master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    @include('tu_si.import')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thông tin mã sổ <strong>{{ $soGiaDinh->ma_so }}</strong></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý giáo xứ</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Sổ gia đình công giáo</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Thành viên</a></li>
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
                                        <h4 class="card-title">Danh sách các thành viên </h4>
                                        <div class="float-right">
                                            <a class="btn btn-primary"
                                               href="{{ route('so-gia-dinh.createTV', ['sgdId' => $soGiaDinh->id] )}}">Thêm thành viên
                                            </a>
                                        </div>
                                    </div>

                                    <div  class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th >STT</th>
                                                    <th>Họ và tên</th>
                                                    <th>Tên thánh</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Bí tích đã nhận</th>
                                                    <th >Xem chi tiết</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                @php $i= 0; @endphp
                                                @foreach($all_thanh_vien as $th)
                                                    <tr >
                                                        <td class="text-center"> {{ ++$i }}</td>
                                                        <td> {{ $th->ho_va_ten }}</td>
                                                        <td>
                                                            {{ $th->tenThanh->ten_thanh }}
                                                        </td>
                                                        <td>
                                                            @if(\Carbon\Carbon::parse($th->ngay_sinh)->format('d-m') == '01-01' && strtotime($th->ngay_sinh) < strtotime(1980))
                                                                {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('Y') }}
                                                            @else
                                                                {{ \Carbon\Carbon::parse($th->ngay_sinh)->format('d-m-Y') }}
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                           {{ $th->bi_tich_count }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a type="button"
                                                               href="{{ route('so-gia-dinh.editTV', ['sgdId' => $soGiaDinh->id, 'tvId' => $th->id]) }}"
                                                               class="btn btn-sm btn-primary mb-1">
                                                                <i class="la la-pencil"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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