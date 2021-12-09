<?php

namespace Modules\Auth\Http\Actions;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Modules\Auth\Presenters\UserPresenter;

class VerificationAction extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * @param Request $request
     * @return array
     * @throws AuthorizationException
     */
    public function verify(Request $request)
    {
        if(!$user = User::find($request->get('id')) ) {
            throw new AuthorizationException;
        }

        $this->make(new UserPresenter($user));

        if (! hash_equals((string) $request->get('id'), (string) $user->getKey())) {
            $user->sendEmailVerificationNotification();
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->get('hash'), sha1($user->getEmailForVerification()))) {
            $user->sendEmailVerificationNotification();
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            throw new AuthorizationException;
        }

        if(!$this->model->isSignature($request->get('signature'))){
            $user->sendEmailVerificationNotification();
            throw new AuthorizationException;
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $this->model->createAccount();

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $response;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if(!$user = User::getUserByEmail($request->get('email')) ) {
            return $this->sendError('AuthorizationException', ['Email not found'], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return $this->sendError([], 'An email has already been sent to you');
        }

        $user->sendApiEmailVerificationNotification();

        return ['success' => true, 'message' =>  'Resend successfully'];
    }
}
