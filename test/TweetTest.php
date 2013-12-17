<?php

require_once __DIR__ . '/../src/VOYAGE/Tweet.php';

use \VOYAGE\Tweet;

class TweetTest extends PHPUnit_Framework_TestCase
{
    public function test_Tweetを取り込み、bodyだけを返せる()
    {
        $tweet = new Tweet("Alice\tあいうえお");

        $this->assertSame('あいうえお', $tweet->getBody(), 'bodyだけを返せるか');
    }

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

    public function test_文字列が対応していない場合にはexceptionにする()
    {
        $actual = false;
        try {
            new Tweet('monmonの文字列');
        } catch (InvalidArgumentException $e) {
            $actual = true;
        }

        $this->assertTrue($actual, '例外が起きたか');
    }

    public function test_hashtagを含むTweetを取り込むとisHashTagで判定できる()
    {
        $tweet = new Tweet("monmon\t#hashtab これはhashtagのtweetです");

        $this->assertSame(true, $tweet->isHashTag(), 'hash tagの判定ができるか');
    }

    public function test_replyを含むTweetを取り込むとisReplyで判定できる()
    {
        $tweet = new Tweet("monmon\t@twitter これはreplyのtweetです");

        $this->assertSame(true, $tweet->isReply(), 'replyの判定ができるか');
    }

    public function test_mentionを含むTweetを取り込むとisMentionで判定できる()
    {
        $tweet = new Tweet("monmon\tmention @twitter これはmentionのtweetです");

        $this->assertSame(true, $tweet->isMention(), 'mentionの判定ができるか');
    }

}
