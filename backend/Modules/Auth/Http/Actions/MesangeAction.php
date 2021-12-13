<?php

namespace Modules\Auth\Http\Actions;

use Modules\Strategy\Services\Request\Request;
use Modules\Auth\Http\Requests\MesangeRequest;
use App\Models\User;
use App\Services\Mail;
use App\Services\Mail as Mail2;
use App\Services\MailInt;

class MesangeAction
{
    private $mail;

//    public function __construct(Mail $mail)
//    {
//        $this->mail = $mail;
//    }

    public function run(MesangeRequest $request, MailInt $mail, Mail2 $mail2)
    {
//        $user = $request->user();
//        $user->sendEmailVerificationNotification();

        $mail->setTo($request->email)
            ->setMess($request->mess)
            ->send();
    }
}
