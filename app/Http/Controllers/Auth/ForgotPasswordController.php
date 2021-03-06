<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailResetPasswordEmail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {
       return view('auth.passwords.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.required' => 'Email không được phép trống',
            'email.email' => 'Tài khoản phải đúng dạng email',
            'email.exists' => 'Tài khoản không tồn tại',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
//        \Mail::to($request->email)->send(new ResetPasswordEmail($token));
        SendEmailResetPasswordEmail::dispatch($token, $request->email);
        return back()->with('message', 'Đã gửi mật khẩu qua email');
    }
}
