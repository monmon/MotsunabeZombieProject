<?php

namespace VOYAGE;

require_once __DIR__ . '/Tweet.php';

use \VOYAGE\Tweet;

class TweetCategorizer
{
    public function categorize($tweetString)
    {
        $tweetObject = new Tweet($tweetString);

        if ($tweetObject->isNormal()) {
            return "Normal\t" . $tweetObject->getBody();
        }
        if ($tweetObject->isHashTag()) {
            return "!HashTag\t" . $tweetObject->getBody();
        }
    }
}
