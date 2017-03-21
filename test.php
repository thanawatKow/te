<?php
   namespace Facebook\InstantArticles\Transformer;
   namespace Facebook\InstantArticles\Elements;
   require_once('vendor/autoload.php');
   use Facebook\InstantArticles\Elements\InstantArticle;
   use Facebook\InstantArticles\Client\Client;
 use Facebook\InstantArticles\Client\helper;
    $article = build_the_article();
    $a = build();
    $app_id = "1335396193222019";
    $app_secret = "45cb6b14299eafb282bdf42f4315ea33";
    $page_access_token = "EAASZBiSe7PYMBAHI3K5K2g1bQn7js6I5MuEalyf38eTlByHgfaQyFASVriNmz0r8s8nlnZC91NCYn9UJ4HGA2rWL6sF2xPDb7Ht1UGNQpvcdPo6W3pfGFJYkp4xDHTqPJ7eI8U08LZCL3sxw9HhlXrNcPG5TqpMtJvfnwymKC6qxVduAwrK2v5AbI3Aj24ZD";
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
   //    $canonicalURL='https://instantarticles.herokuapp.com/';
      // Import the article into Facebook
      $submisson_sub1=$client->importArticle($a, true);
   //$client->removeArticle('https://instantarticles.herokuapp.com/'); //remove fb instant
    } catch ( Exception $e ) {
      // @TODO: Treat the error properly here.
    }

  function build_the_article() {
$a='สวัสดีครับ';
$article =InstantArticle::create()
        ->withCanonicalUrl('https://instantarticles.herokuapp.com/')
        ->withHeader(
            Header::create()
                ->withTitle('ธนาคารเวลา')
                ->withSubTitle('SubTitle')
                ->withPublishTime(
                    Time::create(Time::PUBLISHED)
                        ->withDatetime(
                            \DateTime::createFromFormat(
                                'j-M-Y G:i:s',
                                '21-Aug-1984 19:30:00'
                            )
                        )
                )
                ->withModifyTime(
                    Time::create(Time::MODIFIED)
                        ->withDatetime(
                            \DateTime::createFromFormat(
                                'j-M-Y G:i:s',
                                '12-Feb-2016 10:00:00'
                            )
                        )
                )
                ->addAuthor(
                    Author::create()
                        ->withName('Author in FB')
                        ->withDescription('Author user in facebook')
                        ->withURL('https://www.facebook.com/thkwhitehat')
                )

                ->withCover(
                    Image::create()
                        ->withURL('http://www.fth1.com/uppic/96103827/news/96103827_0_20151221-220557.jpg')
                        ->withCaption(
                            Caption::create()
                                ->appendText('Some caption to the image')
                        )
                )
                ->withSponsor(
                    Sponsor::create()
                        ->withPageUrl('http://facebook.com/my-sponsor')
                )
        )
        // Paragraph1
        ->addChild(
            Paragraph::create()
                ->appendText((string)$a)
        )
        // Paragraph2
        ->addChild(
            Paragraph::create()
                ->appendText('” สิ่งไหนที่สำคัญ สิ่งนั้นทำแล้วหรือยัง ? ”')
        )

        // Paragraph3
        ->addChild(
            Paragraph::create()
                ->appendText('” คนไหนที่เรารัก ทำดีกับเค้าแล้วหรือยัง ? ”')
        )

        // Paragraph4
        ->addChild(
            Paragraph::create()
                ->appendText('ลองจินตนาการว่ามีธนาคารแห่งหนึ่งเข้าบัญชีให้คุณทุกเช้า เป็นเงิน 86,400 บาท ไม่มีการยกยอดคงเหลือไปวันรุ่งขึ้น')
        )

        // Footer
        ->withFooter(
            Footer::create()
                ->withCredits('  ทุกตอนเย็นจะลบยอดคงเหลือทั้งหมดที่คุณไม่ได้ใช้ระหว่างวัน')
        );
      return $article;
  }
  function build() {
  $a='สวัสดีครับ';
  $article =InstantArticle::create()
        ->withCanonicalUrl('https://instantarticles.herokuapp.com/')
        ->withHeader(
            Header::create()
                ->withTitle('สวัสดีตอนเช้า')
                ->withSubTitle('SubTitle')
                ->withPublishTime(
                    Time::create(Time::PUBLISHED)
                        ->withDatetime(
                            \DateTime::createFromFormat(
                                'j-M-Y G:i:s',
                                '21-Aug-1984 19:30:00'
                            )
                        )
                )
                ->withModifyTime(
                    Time::create(Time::MODIFIED)
                        ->withDatetime(
                            \DateTime::createFromFormat(
                                'j-M-Y G:i:s',
                                '12-Feb-2016 10:00:00'
                            )
                        )
                )
                ->addAuthor(
                    Author::create()
                        ->withName('Author in FB')
                        ->withDescription('Author user in facebook')
                        ->withURL('https://www.facebook.com/thkwhitehat')
                )

                ->withCover(
                    Image::create()
                        ->withURL('http://www.fth1.com/uppic/96103827/news/96103827_0_20151221-220557.jpg')
                        ->withCaption(
                            Caption::create()
                                ->appendText('Some caption to the image')
                        )
                )
                ->withSponsor(
                    Sponsor::create()
                        ->withPageUrl('http://facebook.com/my-sponsor')
                )
        )
        // Paragraph1
        ->addChild(
            Paragraph::create()
                ->appendText((string)$a)
        )
        // Paragraph2
        ->addChild(
            Paragraph::create()
                ->appendText('” ชมซากุระเมืองไทย” ดอยอินทนนท์ จ.เชียงใหม่ ”')
        )

        // Paragraph3
        ->addChild(
            Paragraph::create()
                ->appendText('”เส้นทางชมดอกนางพญาเสือโคร่ง (ซากุระเมืองไทย) สีชมพูหวานบานสะพรั่ง บนดอยอินทนนท์ ที่ ศูนย์อนุรักษ์พันธุ์กล้วยไม้รองเท้านารี และศูนย์วิจัยเกษตรหลวงเชียงใหม่ (ขุนวาง) โครงการในพระราชดำริ ชมพันธุ์ไม้เมืองหนาว สวนสวย และสัมผัสอากาศหนาวเย็นบนยอดดอย ”')
        )
        // Paragraph4
        ->addChild(
            Paragraph::create()
                ->appendText('')
        )
        // Footer
        ->withFooter(
            Footer::create()
                ->withCredits('  ทุกตอนเย็นจะลบยอดคงเหลือทั้งหมดที่คุณไม่ได้ใช้ระหว่างวัน')
        );
      return $article;
  }
