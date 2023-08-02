# pirichain-api-php

Package for base Pirichain API calls through PHP
============

[![Latest Stable Version](http://poser.pugx.org/workmail20/pirichain-api-php/v)](https://packagist.org/packages/workmail20/pirichain-api-php) 
[![Total Downloads](http://poser.pugx.org/workmail20/pirichain-api-php/downloads)](https://packagist.org/packages/workmail20/pirichain-api-php) 
[![Latest Unstable Version](http://poser.pugx.org/workmail20/pirichain-api-php/v/unstable)](https://packagist.org/packages/workmail20/pirichain-api-php) 
[![License](http://poser.pugx.org/workmail20/pirichain-api-php/license)](https://packagist.org/packages/workmail20/pirichain-api-php) 
[![PHP Version Require](http://poser.pugx.org/workmail20/pirichain-api-php/require/php)](https://packagist.org/packages/workmail20/pirichain-api-php)


---
Pirichain is blockchain system that based on dPos (Delegated Proof of Stake) and has it own environment to create wallet and token, transactions, sending or storing data as a transaction, delegation.


Requirements
------------

* PHP >= 5.6;
* Composer;

Installation
------------
    composer require workmail20/pirichain-api-php


Usage
------------
```php
<?php
require 'vendor/autoload.php';

use Workmail20\PirichainApiPhp\piriHelper;


$piri = new piriHelper(true);

echo $piri->createNewAddress();
echo $piri->createNewAddress("portuguese",true);
echo $piri->rescuePrivateKey("entry frequent airport firm document close human roof fix pond popular laugh banner fruit faint exact sleep axis pipe crush today elder inform saddle");
echo $piri->getMnemonic("4bab94162ba406575bb5dd5814faa0bec124bb947a72cb221e951a8e348e9ce5");
echo $piri->getBalance("PRTMRWG479eCmbbufg92qZsysYHMH7bRL7H6eDVwNSx");
echo $piri->getBalanceList("PRTMRgoFporAfQYrNNJfj3Go37FT5AR3ueKCwpdKd1s");
echo $piri->getToken();
echo $piri->listTokens();
echo $piri->getScenario("PRTMQ7fcZp7ACGDEom4KJQ4bvJ5nwQ3CcaUTFy642mE");
echo $piri->listMyScenarios("PRTMPUAV2mTGq6Dpu9ZBYmJyXWdt9RYiiouvRaZ8xUR");
echo $piri->listScenarios();
echo $piri->executeScenario("PRTMPBjj3sutTtHwvRgB8YFHtMdcTv1Bd7cMWMxMrZP","PRTMRWG479eCmbbufg92qZsysYHMH7bRL7H6eDVwNSx",
"9d656610ec7ff8a8e7e9225234ee54b6fa31d147981e1b91106ce901ae69bf00","init",'["11","22","333"]');

echo $piri->previewScenario("{}","PRTMRWG479eCmbbufg92qZsysYHMH7bRL7H6eDVwNSx",
"9d656610ec7ff8a8e7e9225234ee54b6fa31d147981e1b91106ce901ae69bf00","init",'["11","22","333"]');
echo $piri->listTransactions();
echo $piri->listPoolTransactions();
echo $piri->listTransactionsByAssetID("0","50","-1");
echo $piri->listTransactionsByAddr("0","50","PRTMPUAV2mTGq6Dpu9ZBYmJyXWdt9RYiiouvRaZ8xUR");
echo $piri->getTransaction("f0f5733c7cc71ad3ae2dea4417c7e16a39aed9edba6a4c414568875b30a1ad9b");
echo $piri->getPoolTransaction("f0f5733c7cc71ad3ae2dea4417c7e16a39aed9edba6a4c414568875b30a1ad9b");
echo $piri->getBlocks();
echo $piri->getBlocksDesc();
echo $piri->getLastBlocks();
echo $piri->getOnlyBlocks();
echo $piri->getBlock("2673310");
echo $piri->pushData("PRTMRWG479eCmbbufg92qZsysYHMH7bRL7H6eDVwNSx","9d656610ec7ff8a8e7e9225234ee54b6fa31d147981e1b91106ce901ae69bf00","PRTMRN71Mz5mrZMA59mPtURrTG9S4yydYDyi1YNi5uX",
'[{"key":"xxxx1","value":"xxxxx","enc":"1"}]',
"043e6ace02e5b6c8031455d91ae88b411b80935f48404c6014075043e71d2ffb8da3b2f5f3a480f9be45b9455b846781bdbdf6466076645cc86e5a00c82c51bc00");

echo $piri->listData();
echo $piri->listDataByAddress("PRTMRN71Mz5mrZMA59mPtURrTG9S4yydYDyi1YNi5uX");
echo $piri->getAddressListByAsset();
echo $piri->isValidAddress("PRTMRN71Mz5mrZMA59mPtURrTG9S4yydYDyi1YNi5u0");
echo $piri->search("99f9f4ec7012db95868bb9526cd9b239765634183b64ad3eb7b3c13daf5ed12d");
echo $piri->search("2673310");
echo $piri->listDeputies();
echo $piri->checkDeputy("PRTMPRSg92ndyu5NeaEf7q3D6TdJeKKa6nKStVMcU4e");
echo $piri->getMyRewardQuantity("PRTMRWG479eCmbbufg92qZsysYHMH7bRL7H6eDVwNSx","9d656610ec7ff8a8e7e9225234ee54b6fa31d147981e1b91106ce901ae69bf00");
echo $piri->getPiriPrice();
echo $piri->getRichList();
echo $piri->getDetailStats();
echo $piri->getStats();
echo $piri->listDelegationTopN();
echo $piri->getCirculation();



?>
```

API documentation
------------

For more detailed and up-to-date API documentation, you can access it at https://api.pirichain.com and refer to the Postman collection documents specified at that address.

Changelog
------------

To keep track, please refer to [CHANGELOG.md](https://github.com/workmail20/pirichain-api-php/blob/master/CHANGELOG.md).
