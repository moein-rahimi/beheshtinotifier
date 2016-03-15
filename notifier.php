
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

switch ($text) {
      case 'اشتراک در خبرنامه':
    case '/subscribe':
    case '/subscribe@BeheshtiNotifierBot':
     $params  = array('chat_id' => $chatid, 'action' => 'typing');
       $response   = $client -> sendChatAction($params);





      $response   = $client -> sendMessage(array('chat_id' => $chatid, 'text' => 'شما عضو خبرنامه شدید از اینک آخرین اخبار به شما ارسال میشود', 'reply_to_message_id' => $messageid));
    
          $db = new PDO('pgsql:host=ec2-79-125-118-3.eu-west-1.compute.amazonaws.com
 ;dbname=d4p01vc87fpdr3','eswovxhrfxxvlu','-y1ZI2A6f8Q1hmIwBWOjLWzeNa');
 $stmt = $db->prepare("INSERT INTO subscribess(NAME, chatid) VALUES (:NAME, :chatid)");
        $stmt->bindParam(':NAME',$user , PDO::PARAM_STR);
    $stmt->bindParam(':chatid', $senderid, PDO::PARAM_INT);

        if($stmt->execute())
        {
         $response   = $client -> sendMessage(array('chat_id' => $chatid, 'text' => $senderid.$user, 'reply_to_message_id' => $messageid));

        }


      break;
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

      // $params  = array('chat_id' => $chatid, 'action' => 'typing');
      // $response   = $client -> sendChatAction($params);
      // $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );
      // $elems = $news_page->find("#simple-list_12031",0);
      // $message   =$elems->plaintext;
      $response   = $client -> sendMessage(array('chat_id' => $chatid, 'text' => 'این بخش غیر فعال است', 'reply_to_message_id' => $messageid));

    break;



  default:
          $showKeyboard = new Zelenin\Telegram\Bot\Type\ReplyKeyboardMarkup();
          $showKeyboard->keyboard = [
          ['اخبار', 'تعطیلی کلاس ها'],
          [ 'کلاس جبرانی', 'اشتراک در خبرنامه']
                        ];
          $showKeyboard->one_time_keyboard = false;
          $showKeyboard->resize_keyboard = true;
                      
                        $response = $client->sendMessage([
                            'chat_id' => $chatid,
                            'text' => 'سلام خوش اومدی',
                            'reply_markup' => $showKeyboard,
                            'disable_web_page_preview' => true
                        ]);

    break;
}

 
       
 $result = 'SELECT * FROM subscribes';
 foreach($db->query($result) as $row)
        {
        echo $row['NAME'].'<br />';
        echo $row['chatid'].'<br />';
        
        }


//   try {
  

// $sql = 'CREATE TABLE subscribess(
//    ID SERIAL PRIMARY KEY     NOT NULL,
//    NAME           TEXT    NOT NULL,
//    chatid            INT     NOT NULL
   
// );';
// $db->exec($sql);

// }catch(PDOException $e) {
//       echo $e->getMessage();

// }


    // $db = new PDO('pgsql:host=localhost
    //   ;dbname=test','postgres','moe2012@');
    // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
?>