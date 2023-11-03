<?php

namespace Llgp\LlgpSdkPhpDemo;

require './PayoutDemo.php';

$demo = new PayoutDemo();

$result = $demo->payoutApply();
echo 'Payout Apply Response:' . PHP_EOL;
echo stripcslashes($result) . PHP_EOL;

$result = $demo->payoutApplyTrueMoney();
echo 'Payout Apply True Money Response:' . PHP_EOL;
echo stripcslashes($result) . PHP_EOL;

$result = $demo->payoutConfirm('P20231011081402', '249909');
echo 'Payout Confirm Response:' . PHP_EOL;
echo stripcslashes($result) . PHP_EOL;

$result = $demo->payoutOrderQuery('P20231011081247');
echo 'Payout Order Query Response:' . PHP_EOL;
echo stripcslashes($result) . PHP_EOL;

$result = $demo->payoutAccountBalanceQuery();
echo 'Payout Account Balance Query Response:' . PHP_EOL;
echo stripcslashes($result) . PHP_EOL;

