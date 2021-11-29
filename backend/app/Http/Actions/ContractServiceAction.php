<?php
namespace App\Http\Actions;

use App\Http\Actions\SetupAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

abstract class ContractServiceAction extends Controller
{

    public function setupInstanceAction($host = 'data-seed-prebsc-1-s1.binance.org', $port = 8545, $ssl = true): void
    {
        $setup = new SetupAction();
        $setup->setupInstanceBscAction();
    }

    public function setupInstanceEthAction($host = 'rinkeby.infura.io/v3/df383655de5842e49f6dbfab806bf001', $port = null, $ssl = true): void //rinkeby.infura.io/v3/df383655de5842e49f6dbfab806bf001
    {
        $setup = new SetupAction();
        $setup->setupInstanceEthAction();
    }
}