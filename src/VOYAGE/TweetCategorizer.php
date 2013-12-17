<?php

namespace VOYAGE;

require_once __DIR__ . '/Tweet.php';

use \VOYAGE\Tweet;

class TweetCategorizer
{
    const CATEGORIZED_FORMAT = "%s\t%s";

    protected $_tweetObject;

    public function categorize($tweetString)
    {
        $this->_tweetObject = new Tweet($tweetString);

        if ($this->_tweetObject->isNormal()) {
            return $this->_createCategorizedString('Normal');
        }

        $symbols = array();
        if ($this->_tweetObject->isHashTag()) {
            $symbols[] = '!HashTag';
        }
        if ($this->_tweetObject->isReply()) {
            $symbols[] = 'Reply';
        }
        if ($this->_tweetObject->isMention()) {
            $symbols[] = 'Mention';
        }

        return $this->_createCategorizedString(implode(',', $symbols));
    }

    protected function _createCategorizedString($category)
    {
        return sprintf(self::CATEGORIZED_FORMAT, $category, $this->_tweetObject->getBody());
    }
}
