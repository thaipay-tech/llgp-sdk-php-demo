<?php

namespace Llgp\LlgpSdkPhpDemo;

require './PayoutDemo.php';

$demo = new PayoutDemo();
$demo->payoutApply();
$demo->payoutApplyTrueMoney();
$demo->payoutConfirm('P3382739127');
$demo->payoutOrderQuery('P3382739127');
$demo->payoutAccountBalanceQuery();

