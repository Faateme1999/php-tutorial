<?php


namespace Fateme\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Fateme\User\Repositories\UserRepo;
use Fateme\User\Requests\ResetPasswordVerifyCodeRequest;
use Fateme\User\Requests\SendResetPasswordVerifyCodeRequest;
use Fateme\User\Requests\VerifyCodeRequest;
use Fateme\User\Services\VerifyCodeService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showVerifyCodeRequestForm()
    {
        return view('User::Front.passwords.email');
    }

    public function sendVerifyCodeEmail(SendResetPasswordVerifyCodeRequest $request, UserRepo $userRepo)
    {
        $user = $userRepo->findByEmail($request->email);
//        VerifyCodeService::delete($user->id);
        if ($user) {
            $user->sendResetPasswordRequestNotification();
        }

        return view('User::Front.passwords.enter-verify-code-form');

    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {

        $user= resolve(UserRepo::class)->findByEmail($request->email);

        if($user == null || !VerifyCodeService::check($user->id, $request->verify_code)){
            return back()->withErrors([ 'verify_code'=>'کد معتبر نیست!']);
        }

        auth()->loginUsingId($user->id);
         return redirect()->route('password.showResetForm');
    }

}
