<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
//import phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function verifPage()
    {
        return view('auth.passwords.verifikasi-email');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $check = DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->whereDate('created_at', Carbon::today())
                    ->count();

        if($check > 3) {
            return redirect('/login')->with('error', 'Anda sudah melebihi batas pengiriman email. Silahkan coba lagi besok.');
        }

        $this->composeEmail($request->email, $token);

        return redirect('/verifikasi-email')->with('success', 'Email sudah dikirim! Silahkan cek email Anda.');
    }

    public function composeEmail ($email, $token)
    {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {

            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'malangtechindo@gmail.com'; //  sender username
            $mail->Password = 'ombktkoztklttvqj'; // sender password
            $mail->SMTPSecure = 'ssl'; // encryption - ssl/tls
            $mail->Port = 465; // port - 587/465

            $mail->setFrom('apoteksumekar@bumd.com', 'Admin Apotek BUMD Sumekar');

            $mail->addAddress($email);
            $mail->addCC($email);
            $mail->addBCC($email);

            $mail->addReplyTo('apoteksumekar@bumd.com', 'Admin Apotek BUMD Sumekar');

            $mail->isHTML(true); // Set email content format to HTML

            $mail->Subject = "Email Verification";
            $mail->Body = view('auth.passwords.email-forgot-password', ['token' => $token])->render();

            if (!$mail->send()) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            } else {
                return back()->with("success", "Email has been sent.");
            }

        } catch (Exception $e) {
            return back()->with('error', 'Message could not be sent.');
        }
    }

    public function showResetPasswordForm($token)
    {
        $user = DB::table('password_reset_tokens')
                    ->where('token', $token)
                    ->whereDate('created_at', '>', Carbon::now()->subHours(24))
                    ->first();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Token tidak valid atau sudah kedaluwarsa.');
        }
        return view('auth.passwords.email-link', ['token' => $token, 'email' => $user->email]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required_with:ulangi_password|same:ulangi_password|min:6|max:50',
            'ulangi_password' => 'required|string|min:6|max:50'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
                'status' => 0
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Anda sudah reset password sebelumnya. Silahkan coba lagi.');
        }

        $user = DB::table('users')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->update(['status' => 1]);

        return redirect('/login')->with('success', 'Passwordmu telah di ubah!. Silahkan login kembali.');
    }
}
