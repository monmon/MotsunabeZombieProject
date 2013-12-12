<?php

namespace VOYAGE;

class Tweet
{
    const DELIMITER = "\t";

    protected $_screenName;
    protected $_body;

    public function __construct($str)
    {
        list($this->_screenName, $this->_body) = explode(self::DELIMITER, $str, 2);
    }

    public function isNormal()
    {
        if (preg_match('/@/', $this->_body)) {
            return false;
        }
        if (preg_match('/#/', $this->_body)) {
            return false;
        }

        return true;
    }
}
