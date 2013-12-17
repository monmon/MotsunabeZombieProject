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

    public function test_Tweetがhashtagを含んでいた場合、hashtagを表す記号をTweetの先頭に付け、Tweetとの間をタブ文字で区切って返せる()
    {
         $tweetCategorizer = new TweetCategorizer();

         $this->assertSame("!HashTag\t#hashtag あいうえお", $tweetCategorizer->categorize("Alice\t#hashtag あいうえお"), 'http://redmine.cs.is.saga-u.ac.jp/issues/2');
    }
}
