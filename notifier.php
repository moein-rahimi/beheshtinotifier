

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

switch ($text) {
  case 'تعطیلی کلاس ها'  :
  case '/akhbar' :
  case '/tatili@BeheshtiNotifierBot' :

      $params   = array('chat_id' => $chatid, 'action' => 'typing');
      $response   = $client -> sendChatAction($params);
      $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );

      $elems = $news_page->find("#simple-list_11643 ",0);
 
      $message   =$elems->plaintext;
      
      $response   = $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));
      break;


      case 'اخبار':
      case '/akhbar':
      case '/akhbar@BeheshtiNotifierBot':
        $params   = array('chat_id' => $chatid, 'action' => 'typing');
        $response   = $client -> sendChatAction($params);
        $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );
        $elems = $news_page->find(".full-list article header a ");    
        $link = $elems[0]->href;
        $fixLink = str_replace('./','/',$link);
        $behe = "http://p-karaj.tvu.ac.ir";
        $url = $behe.$fixLink;
        $dom =HtmlDomParser::file_get_html( $url );
        $elems = $dom->find("#content article div",0);
        $message   =$elems->plaintext;
        $response   = $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));
    break;


    case 'کلاس جبرانی':
    case '/jobrani':
    case '/jobrani@BeheshtiNotifierBot':

      $params  = array('chat_id' => $chatid, 'action' => 'typing');
      $response   = $client -> sendChatAction($params);
      $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );
      $elems = $news_page->find("#simple-list_12031",0);
      $message   =$elems->plaintext;
      $response   = $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));

    break;

  default:
         $response = $client->sendMessage([
                            'chat_id' => $chatid,
                            'text' => 'سلام از کیبرد استفاده کن',
                            'disable_web_page_preview' => true
                        ]);
    break;
}




function akhabr()
{
  $params   = array('chat_id' => $chatid, 'action' => 'typing');
      $response   = $client -> sendChatAction($params);
    $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );

            $elems = $news_page->find("#simple-list_11643 ",0);
 
   $message   =$elems->plaintext;
      
      $response   = $client -> sendMessage(array('chat_id' => $chatid, 'text' => $message, 'reply_to_message_id' => $messageid));
}








return $client;
?>