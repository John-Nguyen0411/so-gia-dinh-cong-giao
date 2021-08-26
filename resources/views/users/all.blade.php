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
                        <h4>Tài khoản</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Quản lý tài khoản</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Tài khoản</a></li>
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
                                        <h4 class="card-title">Danh sách tài khoản </h4>
                                        @if(\Illuminate\Support\Facades\Auth::user()->quanTri->ten_quyen == 'admin')
                                            <div class="d-flex justify-content-around">
                                                <a class="btn btn-primary" href="{{ route('tai-khoan.create') }}">Tạo tài khoản</a>
                                            </div>
                                         @else
                                            <div class="d-flex justify-content-around">
                                                <a class="btn btn-primary" href="{{ route('register') }}">Tạo tài khoản</a>
                                            </div>
                                        @endif

                                    </div>
                                    <div  class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th >STT</th>
                                                    <th>Họ và tên</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Tên giáo phận</th>
                                                    <th>Quyền hạn</th>
                                                    <th >Chỉnh sửa</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                @php $i= 0; @endphp
                                                @foreach($users as $th)
                                                    <tr>
                                                        <td class="text-center"> {{ ++$i }}</td>
                                                        <td> {{ $th->ho_va_ten }}</td>
                                                        <td>
                                                            {{ $th->email }}
                                                        </td>
                                                        <td>{{ $th->so_dien_thoai }}</td>
                                                        <td>
                                                            @if($th->giaoXu)
                                                                Giáo phận: {{ $th->giaoPhan->ten_giao_phan }}
                                                                <br>
                                                                Giáo hạt: {{ $th->giaoXu->giaoHat->ten_giao_hat }}
                                                                <br>
                                                                Giáo xứ: {{ $th->giaoXu->ten_giao_xu }}
                                                            @else
                                                                Giáo phận: {{ $th->giaoPhan->ten_giao_phan }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $th->quanTri->ten_quyen }}
                                                        </td>

                                                        <td class="text-center">
                                                            <a type="button"
                                                               href="{{ route('tai-khoan.edit', $th->id)}}"
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