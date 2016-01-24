<?php

$token = "153172554:AAElVtw4WJS4noPYXsnOtKLKLGJ0oeiUhTI" ;

$site = "https://api.telegram.org/bot".$token;










$update = file_get_contents($site."/getUpdates");
$update = json_decode($update, TRUE);




$chat = $update["result"][0]['message']['chat']['id'] ;
print_r($chat);

file_get_contents($site."/sendMessage?chat_id=".$chat."&text=dd");






?>