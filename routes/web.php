<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiaoPhanController;
use App\Http\Controllers\GiaoHatController;
use App\Http\Controllers\GiaoXuController;
use App\Http\Controllers\GiaoHoController;
use App\Http\Controllers\GiaoTinhController;
use App\Http\Controllers\TenThanhController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\TuSiController;
use App\Http\Controllers\ViTriController;
use App\Http\Controllers\BiTichController;
use App\Http\Controllers\ThanhVienController;
use App\Http\Controllers\SoGiaDinhController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NhaDongController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoanCaController;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::group(['middleware'=>['auth',  'revalidate']],function()
{
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('user.logout');
    Route::group(['middleware'=> ['roleGiaoPhan', 'revalidate']], function (){
        // import TuSi, ChucVu, ViTri
        Route::post('file-import-tu-si', [TuSiController::class, 'fileImport'])->name('tu-si-import');
        // search TuSI by ChucVu
        Route::get('tu-si/search', [TuSiController::class, 'searchTuSi'])->name('tu-si.search');
        // import and export excel GT GP GH GX
        Route::post('file-import', [GiaoPhanController::class, 'fileImport'])->name('GP-file-import');
        Route::get('file-export', [GiaoPhanController::class, 'fileExport'])->name('GP-file-export');
        //// ------------------------------ register ---------------------------------//
        Route::get('them-tai-khoan', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.user');
        Route::post('dang-ki', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register.store');
        // Sending Email for GiaoPhan's User
        Route::get('mail/send-email', [UserController::class, 'sendingEmail'])->name('user.send-email');
        Route::post('mail/send-email', [UserController::class, 'postSendingEmail'])->name('user.post-send-email');
        Route::get('mail/history-email', [UserController::class, 'historyEmail'])->name('user.history-email');
        Route::resources([
            'giao-tinh' => GiaoTinhController::class,
            'giao-phan' => GiaoPhanController::class,
            'giao-hat' => GiaoHatController::class,
            'chuc-vu' => ChucVuController::class,
        ]);
    });

    Route::group(['middleware'=> ['roleGiaoXu', 'revalidate']], function (){
        // create and update Bi Tich
        Route::group(['prefix' => 'so-gia-dinh/{sgdId}/thanh-vien/{tvId}/chinh-sua'], function (){
            Route::get('', [SoGiaDinhController::class, 'editThanhVien'])->name('so-gia-dinh.editTV');
            // href bookmark
            Route::get('#them_bi_tich', [SoGiaDinhController::class, 'editThanhVien'])->name('so-gia-dinh.editBTTV');
        });

        Route::get('tu-si/{tuSi}/edit/#cong_tac', [TuSiController::class, 'edit'])->name('tu-si.editCongTac');

        #sogiadinh
        Route::group(['prefix' => 'so-gia-dinh/{sgdId}/thanh-vien/{thanh_vien}/'], function (){
            Route::patch('', [SoGiaDinhController::class, 'updateThanhVien'])->name('so-gia-dinh.updateTV');
            Route::post('', [SoGiaDinhController::class, 'storeBiTich'])->name('so-gia-dinh.storeBT');
            Route::get('bi-tich/{bi_tich_id}/chinh-sua', [SoGiaDinhController::class, 'editBiTich'])->name('so-gia-dinh.editBT');
            Route::patch('bi-tich/{bi_tich_id}', [SoGiaDinhController::class, 'updateBiTich'])->name('so-gia-dinh.updateBT');
            Route::delete('bi-tich/{bi_tich_id}/delete', [SoGiaDinhController::class, 'deleteBiTich'])->name('so-gia-dinh.deleteBT');
        });

        #giaoXu
        Route::group(['prefix' => 'giao-xu/'], function (){
            Route::get('tu-si', [GiaoXuController::class, 'showTuSiByGiaoXu'])->name('giaoXu.showTuSi');
            Route::get('tu-dong/tao-moi', [GiaoXuController::class, 'createTuDong'])->name('giaoXu.createTuDong');
            Route::post('tu-dong', [GiaoXuController::class, 'storeTuDong'])->name('giaoXu.storeTuDong');
            Route::get('tu-dong/{tu_si}/chinh-sua', [GiaoXuController::class, 'editTuDong'])->name('giaoXu.editTuDong');
            Route::patch('tu-dong/{tu_si}/chinh-sua', [GiaoXuController::class, 'updateTuDong'])->name('giaoXu.updateTuDong');
            Route::delete('tu-dong/{tu_si}/xoa', [GiaoXuController::class, 'deleteTuDong'])->name('giaoXu.deleteTuDong');
        });

        //import SoGiaDinh Thanh vien, BiTichDaNhan
        Route::post('file-import-so-gia-dinh', [SoGiaDinhController::class, 'fileImport'])->name('bi-tich-received-import');
        //import SoGiaDinh Thanh vien, BiTichDaNhan
        Route::post('file-import-them-bi-tich', [SoGiaDinhController::class, 'fileImportXTTS'])->name('bi-tich-added-import');
        // add ThanhVien to SoGiaDinh
        Route::group(['prefix' => 'so-gia-dinh/{sgdId}/thanh-vien/'], function (){
            Route::post('', [SoGiaDinhController::class, 'storeThanhVien'])->name('so-gia-dinh.storeTV');
            Route::get('tao-moi', [SoGiaDinhController::class, 'createThanhVien'])->name('so-gia-dinh.createTV');
            Route::delete('{id}', [SoGiaDinhController::class, 'deleteThanhVien'])->name('so-gia-dinh.deleteTV');
        });
        Route::get('giao-ho-/thong-ke', [GiaoHoController::class, 'statistic'])->name('giao-ho.statistic');
        #Ca doan
        Route::get('ca-doan', [DoanCaController::class, 'index'])->name('ca-doan.index');
        Route::get('ca-doan/{ca_doan}/thanh_vien', [DoanCaController::class, 'indexThanhVien'])->name('ca-doan-thanh-vien.index');
        Route::get('ca-doan/{ca_doan}/thanh_vien/them-moi', [DoanCaController::class, 'addThanhVien'])->name('ca-doan-thanh-vien-add.index');
        Route::get('thieu-nhi/', [GiaoXuController::class, 'indexThieuNhi'])->name('thieu-nhi.index');
        Route::resources([
            'so-gia-dinh' => SoGiaDinhController::class,
            'thanh-vien' => ThanhVienController::class,
            'giao-ho' => GiaoHoController::class,
        ]);
    });
    // ----------------------------- main dashboard ------------------------------//
    Route::group(['prefix'=> '/home/'], function (){
        Route::get('', [HomeController::class, 'index'])->name('home');
        Route::get('giao-phan', [GiaoPhanController::class, 'indexGiaoPhan'])->name('home.giaoPhan');
        Route::get('giao-xu', [GiaoPhanController::class, 'indexGiaoXu'])->name('home.giaoXu');
        Route::get('sinh-hoac-tu/{id}', [HomeController::class, 'getGenderSinhOrTu']);
    });

    // request Ajax for select option
    Route::get('tu-si/giao-hat/{id}', [GiaoHatController::class, 'getGiaoHat']);
    Route::get('tu-si/giao-xu/{id}', [GiaoHatController::class, 'getGiaoXu']);
    Route::get('tu-si/giao-ho/{id}', [GiaoHatController::class, 'getGiaoHo']);
    // statistic
    Route::get('giao-xu/thong-ke', [GiaoPhanController::class, 'indexGiaoXu'])->name('giaoXu.statistic');
    // import chucVu, Vitri, TenThanh
    Route::post('file-import-chuc-vu', [TenThanhController::class, 'fileImport'])->name('ten-thanh-import');
    // export
    Route::get('file-export-so-gia-dinh', [SoGiaDinhController::class, 'fileExport'])->name('sgdcg-file-export');
    // print PDF SogiaDinhCongGiao
    Route::get('so-gia-dinh/chi-tiet/download/{id}', [SoGiaDinhController::class, 'downloadPDF'])->name('so-gia-dinh.downloadPDF');
    Route::patch('doi-mat-khau', [UserController::class, 'changePassword'])->name('changePassword');
    Route::resources([
        'tai-khoan' => UserController::class,
        'ten-thanh' => TenThanhController::class,
        'nha-dong' => NhaDongController::class,
        'tu-si' => TuSiController::class,
        'vi-tri' => ViTriController::class,
        'bi-tich' => BiTichController::class,
        'giao-xu' => GiaoXuController::class,
    ]);
});

Auth::routes();

Route::group(['middleware' => 'guest'], function (){
    // -----------------------------login----------------------------------------//
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login')->middleware(['guest']);
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->middleware(['guest']);


// ----------------------------- forget password ----------------------------//
    Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('user.forget-password');
    Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('user.forget-password.send');

// ----------------------------- reset password -----------------------------//
    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
    Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

});


