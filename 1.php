<?php
namespace Facebook\InstantArticles\Transformer;
require_once('vendor/autoload.php');
use Facebook\InstantArticles\Elements\InstantArticle;
use Facebook\InstantArticles\Elements\Header;
use Facebook\InstantArticles\Elements\Time;
use Facebook\InstantArticles\Client\Client;
$app_id = "1335396193222019";
$app_secret = "45cb6b14299eafb282bdf42f4315ea33";
$page_access_token = "EAASZBiSe7PYMBAC0AFzODPE94rFIQFbvlEkGehXs62bky5ZCtXtrJB7oQVirCrp5Sim7FzxkNejUZBW2MO3Ez22BrJFiOrYXa3ZCC3l1W9z9hGlWlwOErOjss9C3v0e91cEkm4KnQ0t7NswsJueLbI1yvgar6m8QZB1CrtTjU3wGUZACKiT0StOn7amqAIf1QZD";
$page_id = "1920957664803342";
$dev_mode = true; // False for production, true for development mode
$take_live = false; // Says to send to live or save as draft
// Instantiate an API client.
// Instantiate an API client.
$client = Client::create(
  $app_id,
  $app_secret,
  $page_access_token,
  $page_id,
  $dev_mode
);
$json_file = file_get_contents('simple-rules.json');
$instant_article = InstantArticle::create();
$header=  Header::create();
$time=Time::create(Time::PUBLISHED);
$time_modified=Time::create(Time::MODIFIED);
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
$instant_article->withCanonicalURL('https://instantarticles.herokuapp.com/');
$instant_article->withHeader($header->withTitle('ths'));
$instant_article->withHeader($header->withPublishTime($time->withDatetime(\DateTime::createFromFormat(
    'j-M-Y G:i:s',
    '15-Aug-1984 19:30:00'
))));
$instant_article->withHeader($header->withModifyTime($time_modified->withDatetime(\DateTime::createFromFormat(
    'j-M-Y G:i:s',
    '15-Aug-1984 19:30:00'
))));
$result = $instant_article->render('', true)."\n";
$transformer->transform($instant_article, $document);
try
  {

    $submisson=$client->importArticle($instant_article, true);
    echo $submisson;
  } catch ( Exception $e ) {
  // @TODO: Treat the error properly here.
  }
$f = fopen('simple_test.php', 'w') or die("can't open file");
fwrite($f,$result);
//echo $result;
?>
