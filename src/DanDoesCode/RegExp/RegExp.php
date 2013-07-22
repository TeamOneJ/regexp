<?php

namespace DanDoesCode\RegExp;

use Closure;

class RegExp {

    /**
     * Holds the regular expression.
     * 
     * @var string
     */
    private $pattern;

    /**
     * Holds the flags to use for all runs of the regular expression,
     * unless it is overriden by the individual call.
     * 
     * @var integer
     */
    private $flags;

    /**
     * Converts the last PCRE error into a string.
     * 
     * @return string  The last PCRE error string.
     */
    private static function lastError()
    {
        $err = preg_last_error();
        switch (preg_last_error()) {
            case PREG_NO_ERROR:
                return 'There was no error.';
            case PREG_INTERNAL_ERROR:
                return 'Internal PCRE error.';
            case PREG_BACKTRACK_LIMIT_ERROR:
                return 'The backtrack limit was exhausted.';
            case PREG_RECURSION_LIMIT_ERROR:
                return 'The recursion limit was exhausted.';
            case PREG_BAD_UTF8_ERROR:
                return 'Encountered malformed UTF-8 data.';
            case PREG_BAD_UTF8_OFFSET_ERROR:
                return 'Offset didn\'t correspond to the begin of a valid UTF-8 code point.';
        }
        return null;
    }

    /**
     * Sets some instance variables.
     * 
     * @param string  $pattern The regular expression.
     * @param integer $flags   The flags to use.
     */
    public function __construct($pattern, $flags = 0)
    {
        $this->pattern = $pattern;
        $this->flags = $flags;
    }

    public function match($subject, $flags = 0, $offset = 0)
    {
        if ($flags === 0) {
            $flags = $this->flags;
        }

        $res = preg_match($this->pattern, $subject, $matches, $flags, $offset);

        if ($res === 0) {
            return false;
        } elseif ($res === false) {
            throw new RuntimeException('PCRE Error: '.self::lastError());
        }

        $res = array();
        foreach ($matches as $k => $m) {
            if ($flags & PREG_OFFSET_CAPTURE) {
                $res[$k] = new Match($this, $m[0], $m[1]);
            } else {
                $res[$k] = new Match($this, $m);
            }
        }

        return $res;
    }

    public function split($subject, $limit = null, $flags = 0)
    {
        if ($flags === 0) {
            $flags = $this->flags;
        }

        return preg_split($this->pattern, $subject, $limit, $flags);
    }

    public function replace($replacement, $subject, $limit = null, &$count = null)
    {
        if ($flags === 0) {
            $flags = $this->flags;
        }

        if ($limit === null) {
            $limit = -1;
        }

        if ($replacement instanceof Closure) {
            $res = preg_replace_callback($this->pattern, $replacement, $subject, $limit, $count);
        } else {
            $res = preg_replace($this->pattern, $replacement, $subject, $limit, $count);
        }

        if ($res === null) {
            throw new RuntimeException('PCRE Error: '.self::lastError());
        }

        return $res;
    }

    public function replaceCallback($replacement, $subject, $limit = null, &$count = null)
    {
        if ($flags === 0) {
            $flags = $this->flags;
        }

        if ($limit === null) {
            $limit = -1;
        }

        $res = preg_replace_callback($this->pattern, $replacement, $subject, $limit, $count);

        if ($res === null) {
            throw new RuntimeException('PCRE Error: '.self::lastError());
        }

        return $res;
    }
}