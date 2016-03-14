

<?php
require 'vendor/autoload.php';
use Sunra\PhpSimple\HtmlDomParser;
	
$token = "153172554:AAGrcXguYssXQAwsM2M-YIvBL2RJS1fdgrk"; //I know !

$client = new Zelenin\Telegram\Bot\Api($token);





$data 		= json_decode(file_get_contents('php://input'), true);
$chatid 	= $data['message']['chat']['id'];
$text 		= $data['message']['text'];
$messageid 	= $data['message']['message_id'];
$updateid 	= $data['update_id'];
$senderid 	= $data['message']['from']['id'];
$user =  $data['message']['from']['first_name'];

$zaman 		= $data['message']['date'];
 $showKeyboard = new Zelenin\Telegram\Bot\Type\ReplyKeyboardMarkup();
$showKeyboard->keyboard = [
    ['اخبار', 'تعطیلی کلاس ها'],
    [ 'کلاس جبرانی']
];
$showKeyboard->one_time_keyboard = true;
                      
                        $response = $client->sendMessage([
                            'chat_id' => $chatid,
                            'text' => 'سلام خوش اومدی',
                            'reply_markup' => $showKeyboard,
                            'disable_web_page_preview' => true
                        ]);



return $client;
?>