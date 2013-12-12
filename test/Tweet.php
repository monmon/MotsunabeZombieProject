<?php

require __DIR__ . '/../src/VOYAGE/Tweet.php';

use \VOYAGE\Tweet;

class Tweetextends extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider data_tweet
     */
    public function test_Tweetを取り込み、オブジェクトとして保持する($message, $expected, $str)
    {
        $tweet = new Tweet($str);

        $this->assertTrue(method_exists($tweet, 'isNormal'), '普通のTweetと判定できるmethodを持っているか');
        $this->assertSame($expected, $tweet->isNormal(), $message);
    }

    public function data_tweet()
    {
        return array(
            array('普通のTweetと判定できるか', true, "monmon\tこれは普通のtweetです"),
            array('普通のTweetとではないと判定できるか', false, "monmon\t@twitter これはreplyのtweetです"),
            array('普通のTweetとではないと判定できるか', false, "monmon\tmention @twitter これはmentionのtweetです"),
            array('普通のTweetとではないと判定できるか', false, "monmon\t#hashtab これはhashtagのtweetです"),
        );
    }
}
