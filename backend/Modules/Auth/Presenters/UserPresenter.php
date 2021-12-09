<?php
namespace Modules\Auth\Presenters;

use App\Presenters\BasePresenter;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Jobs\CreateAccountJob;

class UserPresenter extends BasePresenter
{
    public function createAccount()
    {
        CreateAccountJob::dispatch($this->getModel());
    }

    public function isSignature($signature)
    {
        $signe = DB::table('user_signe')->where('user_id', $this->id)->where('param', 'LIKE', '%'.$signature.'%')->first();
        if($signe) {
            DB::table('user_signe')->where('id', $signe->id)->delete();
            return true;
        }
        return false;
    }

}
