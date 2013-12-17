<?php

namespace VOYAGE;

class Tweet
{
    const DELIMITER = "\t";

    protected $_screenName;
    protected $_body;
    protected $_hashTag;
    protected $_reply;
    protected $_mention;

    public function __construct($str)
    {
        if (strpos($str, self::DELIMITER) === false) {
            throw new \InvalidArgumentException("Invalid: $str");
        }

        list($this->_screenName, $this->_body) = explode(self::DELIMITER, $str, 2);

        $siftedBody = $this->_sift();
        $this->_hashTag = $siftedBody['hashTag'];
        $this->_reply   = $siftedBody['reply'];
        $this->_mention = $siftedBody['mention'];
    }

    public function getBody()
    {
        return $this->_body;
    }

    public function isNormal()
    {
        if ($this->_hashTag || $this->_reply || $this->_mention) {
            return false;
        }

        return true;
    }

    public function isHashTag()
    {
        if ($this->_hashTag) {
            return true;
        }

        return false;
    }

    public function isReply()
    {
        if ($this->_reply) {
            return true;
        }

        return false;
    }

    public function isMention()
    {
        if ($this->_mention) {
            return true;
        }

        return false;
    }

    protected function _sift()
    {
        $sifted = array(
            'hashTag' => null,
            'reply'   => null,
            'mention' => null,
        );

        if (!preg_match_all('/#[^\s]+|^@[^\s]+|\s@[^\s]+/u', $this->_body, $m)) {
            return $sifted;
        }

        foreach ($m[0] as $symbol) {
            if (strpos($symbol, '#') === 0) {
                $sifted['hashTag'] = $symbol;
            } elseif (strpos($symbol, '@') === 0) {
                $sifted['reply'] = $symbol;
            } else {
                $sifted['mention'] = $symbol;
            }
        }

        return $sifted;
    }
}
