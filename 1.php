<?php
namespace Facebook\InstantArticles\Transformer;
require_once('vendor/autoload.php');
use Facebook\InstantArticles\Elements\InstantArticle;
use Facebook\InstantArticles\Client\Client;
$json_file = file_get_contents('simple-rules.json');
$instant_article = InstantArticle::create();
$transformer = new Transformer();
$transformer->loadRules($json_file);
$html_file = file_get_contents('simple.php');
libxml_use_internal_errors(true);
$document = new \DOMDocument();
$document->loadHTML($html_file);
libxml_use_internal_errors(false);
$transformer->transform($instant_article, $document);
$instant_article->addMetaProperty('op:generator:version', '1.0.0');
$instant_article->addMetaProperty('op:generator:transformer:version', '1.0.0');
$result = $instant_article->render('', true)."\n";
$transformer->transform($instant_article, $document);
//$fb->importArticle($instant_article, true);
$f = fopen('simple_test.php', 'w') or die("can't open file");
fwrite($f,$result);
//echo $result;
// @TODO: Replace the data with your own information
    $app_id = "1335396193222019";
    $app_secret = "45cb6b14299eafb282bdf42f4315ea33";
    $page_access_token = "EAACEdEose0cBAGnIank3mTDPNyZC9hYFwyF3bYurZBvLMegoGLpQE2Xol08M8HrQx5WhxzcaAStk8ZCysaeqY9VTAb31RVT1XrfF9o9rfzIkwHj2lidn5hBtWSbdk1sjgZBVtnDZCXZBvCZAt0jvIZBfW0nvDvaB2l4QlBcWZArZAiaE18nJr9Cyyza6uWWfjM0AIZD";
    $page_id = "1920957664803342";
    $dev_mode = true; // False for production, true for development mode
    $take_live = false; // Says to send to live or save as draft

    // Instantiate an API client.
    try {

      $client = Client::create(
        $app_id,
        $app_secret,
        $page_access_token,
        $page_id,
        $dev_mode
      );

      // Import the article into Facebook


    } catch ( Exception $e ) {
      // @TODO: Treat the error properly here.
    }
   $client->importArticle( $instant_article,true);

?>
