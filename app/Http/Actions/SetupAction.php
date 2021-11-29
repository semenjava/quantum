<?php
namespace App\Http\Actions;

use Illuminate\Support\Facades\Config;

class SetupAction
{
    public function setupInstanceBscAction($host = 'data-seed-prebsc-2-s1.binance.org', $port = 8545, $ssl = true): void  //data-seed-prebsc-1-s1.binance.org
    {
        Config::set("blockchain.eth.host", $host);
        Config::set("blockchain.eth.port", $port);
        Config::set("blockchain.eth.ssl", $ssl);
    }

    public function setupInstanceEthAction($host = 'eth-rinkeby.alchemyapi.io/v2/mUKEivpvu97iWYDB8Uto5Qdv25ZA0i8T', $port = null, $ssl = true): void //rinkeby.infura.io/v3/df383655de5842e49f6dbfab806bf001
    {
        Config::set("blockchain.eth.host", $host);
        Config::set("blockchain.eth.port", $port);
        Config::set("blockchain.eth.ssl", $ssl);
    }

    public function setupInstanceEthNftActionRopsten($host = 'eth-ropsten.alchemyapi.io/v2/mUKEivpvu97iWYDB8Uto5Qdv25ZA0i8T', $port = null, $ssl = true): void
    {
        Config::set("blockchain.eth.host", $host);
        Config::set("blockchain.eth.port", $port);
        Config::set("blockchain.eth.ssl", $ssl);

        Config::set("contract.web3", config('contract.web3Eth'));
        Config::set("contract.address", config('contract.addressEth'));
    }
}