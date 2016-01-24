<?php
use Sunra\PhpSimple\HtmlDomParser;
$token = "153172554:AAElVtw4WJS4noPYXsnOtKLKLGJ0oeiUhTI" ;

$site = "https://api.telegram.org/bot".$token;










$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);




$chatid = $update["message"]["chat"]["id"] ;
$message = $update["message"]["text"];

switch($message){
        
    case "/help":
       sendMessage($chatid," کمک در اینجا قرار میگیره");
        break;
          case "/class":
        $keyb = json_encode(AddtoKeyboard());
        $content = array(
    'chat_id' => $chatid,
    'reply_markup' => $keyb,
    'text' => "Test"
);
addkey($content);
        break;
         case "/keyboard":
       sendMessage($chatid," کمک در اینجا قرار میگیره");
        break;
    default:
           sendMessage($chatid," لام در عرض شد !ه");
      
        
        
        
}

//print_r($chat);
function sendMessage($chatid,$message){
    $url = $GLOBALS[site]."/sendMessage?chat_id=".$chatid."&text=".urldecode($message);
    echo $url;
file_get_contents($url);    
}

function addkey($content){
    $url = $GLOBALS[site]."/sendMessage?.$content. "   ;
file_get_contents($url);    
}

function AddtoKeyboard(){
    $ar = array(
   'keyboard' => 
  array (
    0 => 
    array (
      0 => 'Row 1->Column 1',
      1 => 'Row 1->Column 2',
    ),
    1 => 
    array (
      0 => 'Row 2->Column 1',
      1 => 'Row 2->Column 2',
    ),
    2 => 
    array (
      0 => 'Row 3->Column 1',
      1 => 'Row 3->Column 2',
    ),
  ),
);  
} 



?>