<?php
namespace Facebook\InstantArticles\Transformer;
require_once('vendor/autoload.php');
use Facebook\InstantArticles\Elements\InstantArticle;
use Facebook\InstantArticles\Client\Client;
$app_id = "1335396193222019";
$app_secret = "45cb6b14299eafb282bdf42f4315ea33";
$page_access_token = "EAASZBiSe7PYMBAKfnXVSONT2E79WoaSQ5l0IH50uxrXD8wAXzTCHSWbRqCSvBlhoX6OYxp47qqnJozfloq3XDLwr0T9Vh6Ux7cVMaY23Se1GmWZCk6tRyO7zqF7C8s8emCgK3oW3y6L64PaEhJIZBjixSusNjF84YGZAObN8ymgmeIECiExPcQKqDWNG4tkZD";
$page_id = "1920957664803342";
$dev_mode = true; // False for production, true for development mode
$take_live = false; // Says to send to live or save as draft
//$page_access_token= hash_hmac('sha256', $page_access_token, $app_secret);
$fb = Client::create(
  $app_id,
  $app_secret,
  $page_access_token,
  $page_id,
  $dev_mode
);
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
$fb->importArticle($instant_article,true);
$f = fopen('simple_test.php', 'w') or die("can't open file");
fwrite($f,$result);
//echo $result;


?>
