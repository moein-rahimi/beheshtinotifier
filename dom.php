<?php
//ini_set('error_reporting',E_ALL);
require 'vendor/autoload.php';
use Sunra\PhpSimple\HtmlDomParser;
 get_news();

function get_news(){
    
     $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );

            $elems = $news_page->find("#simple-list_11643 ",0);
    echo $elems->plaintext;
      
 $link = $elems[0]->href;
$fixLink = str_replace('./','/',$link);

//echo $fixLink;


$behe = "http://p-karaj.tvu.ac.ir";


}
    

// $news_page =HtmlDomParser::file_get_html( "http://p-karaj.tvu.ac.ir/" );
//
//            $elems = $news_page->find(".full-list article header a ");
//      
// $link = $elems[0]->href;
//$fixLink = str_replace('./','/',$link);
//
////echo $fixLink;
//
//
//$behe = "http://p-karaj.tvu.ac.ir";
//
//$url = $behe.$fixLink;
//
//
//
//echo $behe."<br>". $fixLink;
//;
//
//
//
//
//echo $url;
//
//
//
//$dom =HtmlDomParser::file_get_html( $url );
//    $elems = $dom->find("#content article div");
//
//$akhbar =  $elems;
//foreach($akhbar as $elem){
//    echo $elem;
//
//}
//
//
//
//
//




//foreach($elems as $elem) {
//    
//    echo $elem->plaintext;
//}



?>