<?php
require 'vendor/autoload.php';

use Telegram\Bot\Api;
$telegram = new Api('153172554:AAGrcXguYssXQAwsM2M-YIvBL2RJS1fdgrk');

$updates = $telegram->getUpdates();
return $updates;