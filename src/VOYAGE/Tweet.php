<?php

namespace VOYAGE;

class Tweet
{
    const DELIMITER = "\t";

    protected $_screenName;
    protected $_body;
    protected $_hashTag;
    protected $_reply;

    public function __construct($str)
    {
        if (strpos($str, self::DELIMITER) === false) {
            throw new \InvalidArgumentException("Invalid: $str");
        }

        list($this->_screenName, $this->_body) = explode(self::DELIMITER, $str, 2);
        $this->_hashTag = $this->_pickOutHashTag();
        $this->_reply = $this->_pickOutReply();
    }

    public function getBody()
    {
        return $this->_body;
    }

    public function isNormal()
    {
        if (preg_match('/@/', $this->_body)) {
            return false;
        }
        if ($this->_hashTag) {
            return false;
        }
        if ($this->_reply) {
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

    protected function _pickOutHashTag()
    {
        // note. hash tagは#から始まり、空白の前まで
        if (!preg_match('/#([^\s]+)/', $this->_body, $m)) {
            return;
        }

        return $m[1];
    }

    protected function _pickOutReply()
    {
        // note. replyは@から始まり、空白の前まで
        if (!preg_match('/^@([^\s]+)/', $this->_body, $m)) {
            return;
        }

        return $m[1];
    }
}
