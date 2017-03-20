<?php
  /**
   * Example snippet to submit an Instant Article to Facebook
   * Remember that this won't publish into your page, it will just make this
   * article available as Instant Article in any share that any user does within
   * Facebook as a Post or via Messenger.
   *
   * @see Facebook Group: https://www.facebook.com/groups/629655867187397/
   * @param Post   $post The WP Post.
   */
   namespace Facebook\InstantArticles\Transformer;
   require_once('vendor/autoload.php');
   use Facebook\InstantArticles\Elements\InstantArticle;
   use Facebook\InstantArticles\Client\Client;
  function submit_article() {

    $article = build_the_article();

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
      $submission_id = $client->importArticle( $article, $take_live );

    } catch ( Exception $e ) {
      // @TODO: Treat the error properly here.
    }
  }

  /**
   * @return The constructed Instant Article
   */
  function build_the_article() {
    $article = InstantArticle::create()
      ->withCanonicalUrl('https://instantarticles.herokuapp.com/')
      ->withStyle('myarticlestyle')
      ->withHeader(
        Header::create()
          ->withTitle('Big Top Title')
          ->withSubTitle('Smaller SubTitle')
          ->withPublishTime(
            Time::create(Time::PUBLISHED)
              ->withDatetime(
                \DateTime::createFromFormat(
                  'j-M-Y G:i:s',
                  '14-Aug-1984 19:30:00'
                )
              )
          )
          ->withModifyTime(
            Time::create(Time::MODIFIED)
              ->withDatetime(
                \DateTime::createFromFormat(
                  'j-M-Y G:i:s',
                  '10-Feb-2016 10:00:00'
                )
              )
          )
          ->addAuthor(
            Author::create()
              ->withName('Author Name')
              ->withDescription('Author more detailed description')
          )
          ->addAuthor(
            Author::create()
              ->withName('Author in FB')
              ->withDescription('Author user in facebook')
              ->withURL('http://facebook.com/author')
          )
          ->withKicker('Some kicker of this article')
          ->withCover(
            Image::create()
              ->withURL('https://jpeg.org/images/jpegls-home.jpg')
              ->withCaption(
                Caption::create()
                  ->appendText('Some caption to the image')
              )
          )
      )
      // Paragraph1
      ->addChild(
        Paragraph::create()
          ->appendText('Some text to be within a paragraph for testing.')
      )

      // Paragraph2
      ->addChild(
        Paragraph::create()
          ->appendText('Other text to be within a second paragraph for testing.')
      )

      // Empty paragraph
      ->addChild(
        Paragraph::create()
      )

      // Paragraph with only whitespace
      ->addChild(
        Paragraph::create()
          ->appendText(" \n \t ")
      )

      // Slideshow
      ->addChild(
        SlideShow::create()
          ->addImage(
            Image::create()
              ->withURL('https://jpeg.org/images/jpegls-home.jpg')
          )
          ->addImage(
            Image::create()
             ->withURL('https://jpeg.org/images/jpegls-home2.jpg')
          )
          ->addImage(
            Image::create()
              ->withURL('https://jpeg.org/images/jpegls-home3.jpg')
          )
      )

      // Paragraph3
      ->addChild(
        Paragraph::create()
         ->appendText('Some text to be within a paragraph for testing.')
      )

      // Ad
      ->addChild(
        Ad::create()
          ->withSource('http://foo.com')
      )

      // Paragraph4
      ->addChild(
        Paragraph::create()
          ->appendText('Other text to be within a second paragraph for testing.')
      )

      // Analytics
      ->addChild(
        Analytics::create()
          ->withHTML($inline)
      )

      // Footer
      ->withFooter(
        Footer::create()
          ->withCredits('Some plaintext credits.')
      );

      return $article;
  }
