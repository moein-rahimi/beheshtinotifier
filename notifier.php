

<?php
require 'vendor/autoload.php';
use Sunra\PhpSimple\HtmlDomParser;
	
$token = "153172554:AAGrcXguYssXQAwsM2M-YIvBL2RJS1fdgrk" ;

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
                            'text' => 'a',
                            'reply_markup' => $showKeyboard,
                            'disable_web_page_preview' => true
                        ]);  



if ($text == '/tatili' || $text == '/tatili@BeheshtiNotifierBot' || $text == 'تعطیلی کلاس ها' ){
    $params 	= array('chat_id' => $chatid, 'action' => 'typing');
			$response 	= $client -> sendChatAction($params);
    $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );

            $elems = $news_page->find("#simple-list_11643 ",0);
 
   $message 	=$elems->plaintext;;
			
			$response 	= $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));
    
} 






if ($text == '/akhbar' || $text == '/akhbar@BeheshtiNotifierBot' || $text == 'اخبار'){
   $params 	= array('chat_id' => $chatid, 'action' => 'typing');
			$response 	= $client -> sendChatAction($params);
 $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );

            $elems = $news_page->find(".full-list article header a ");
      
 $link = $elems[0]->href;
$fixLink = str_replace('./','/',$link);

//echo $fixLink;


$behe = "http://p-karaj.tvu.ac.ir";

$url = $behe.$fixLink;







//echo $url;



$dom =HtmlDomParser::file_get_html( $url );
    $elems = $dom->find("#content article div",0);


 
   $message 	=$elems->plaintext;
			
			$response 	= $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));
    
} 





if ($text == '/jobrani' || $text == '/jobrani@BeheshtiNotifierBot' || $text == 'کلاس جبرانی'){
    $params 	= array('chat_id' => $chatid, 'action' => 'typing');
			$response 	= $client -> sendChatAction($params);
    $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );

            $elems = $news_page->find("#simple-list_12031",0);
 
   $message 	=$elems->plaintext;
			
			$response 	= $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));
    
} 








//switch($text){
//        
//    case '/hi':
//       
//              
//
//
//    
//    
//  
//		
//			$response 	= $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message));
//           
//            
//            
//       
//        
//        	  
//    
//    
//
//
//		
//		
//           break;   
//   
//         case '/last_news':
//        
//    $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );
//
//            $elems = $news_page->find("#simple-list_11643 ",0);
//    $matn = $elems->plaintext;
//            
// 
//        
//			$params 	= array('chat_id' => $chatid, 'action' => 'typing');
//			$response 	= $client -> sendChatAction($params);
//			$response 	= $client -> sendMessage(array('chat_id' => $chatid, 'text' => $matn));
//           
//		
//           break;   
//    default:
//        $message = "slm ye command befrest";
//			$params 	= array('chat_id' => $chatid, 'action' => 'typing');
//			$response 	= $client -> sendChatAction($params);
//			$response 	= $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message));
//           
//        
//        
//}




?>