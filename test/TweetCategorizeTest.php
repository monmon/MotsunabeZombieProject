<?php

require_once __DIR__ . '/../src/VOYAGE/TweetCategorizer.php';

use \VOYAGE\TweetCategorizer;

class TweetCategorizerTest extends PHPUnit_Framework_TestCase
{
    public function test_replyでもmentionでもhashtagでもないTweetだった場合、普通のTweetと判定して返す()
    {
         $tweetCategorizer = new TweetCategorizer();

         $this->assertSame("Normal\tあいうえお", $tweetCategorizer->categorize("Alice\tあいうえお"), 'http://redmine.cs.is.saga-u.ac.jp/issues/1');
    }
}
