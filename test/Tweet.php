<?php

require __DIR__ . '/../src/VOYAGE/Tweet.php';

use \VOYAGE\Tweet;

class Tweetextends extends PHPUnit_Framework_TestCase
{
    public function test_Tweetを取り込み、オブジェクトとして保持する()
    {
        $str = "monmon\tこれは普通のtweetです";
        $tweet = new Tweet($str);

        $this->assertTrue(method_exists($tweet, 'isNormal'), '普通のTweetと判定できるmethodを持っているか');
        $this->assertSame(true, $tweet->isNormal(), '普通のTweetと判定できるか');
    }
}
