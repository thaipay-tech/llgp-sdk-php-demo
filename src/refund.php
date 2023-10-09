<?php

namespace Llgp\LlgpSdkPhpDemo;

require './RefundDemo.php';

$demo = new RefundDemo();
$demo->refundApply('P782193821219');
$demo->refundQuery('R38213729187');