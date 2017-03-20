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


?>
