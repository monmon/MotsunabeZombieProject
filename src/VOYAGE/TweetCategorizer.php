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
        if ($this->_tweetObject->isHashTag()) {
            return $this->_createCategorizedString('!HashTag');
        }
        if ($this->_tweetObject->isReply()) {
            return $this->_createCategorizedString('Reply');
        }
        if ($this->_tweetObject->isMention()) {
            return $this->_createCategorizedString('Mention');
        }
    }

    protected function _createCategorizedString($category)
    {
        return sprintf(self::CATEGORIZED_FORMAT, $category, $this->_tweetObject->getBody());
    }
}
