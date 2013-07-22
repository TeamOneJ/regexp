<?php

namespace DanDoesCode\RegExp;

/**
 * RE is a Facade for the DanDoesCode\RegExp\RegExp class
 */
class RE {
    /**
     * Compiles the given regular expression using the given flags (which are
     * Or'd together using `|`).  This returns a RegExObject object.
     * 
     * @param  string  $pattern The regular expression.
     * @param  integer $flags   The flags to use for the `preg_*` calls.
     * @return RegExObject
     */
    public static function compile($pattern, $flags = 0)
    {
        return new RegExp($pattern, $flags);
    }

    /**
     * Runs the given RegExp against the give subject and returns an array of
     * DanDoesCode\RegExp\Match objects if matches are found, otherwise, false.
     * 
     * @param  string  $pattern The regular expression.
     * @param  string  $subject The subject to match against.
     * @param  integer $flags   The flags to use for the `preg_match` call.
     * @param  integer $offset  The offset at which to start matching.
     * @return array|bool  An array of DanDoesCode\RegExp\Match objects, or false.
     */
    public static function match($pattern, $subject, $flags = 0, $offset = 0)
    {
        return self::compile($pattern, $flags)->match($subject, $flags, $offset);
    }

    /**
     * Splits the given subject by the given regular expression.
     * 
     * @param  string  $pattern The regular expression.
     * @param  string  $subject The subject to split.
     * @param  integer $limit   The max number of substrings to return.
     * @param  integer $flags   The flags to use for the `preg_split` call.
     * @return array  An array containing the substrings.
     */
    public static function split($pattern, $subject, $limit = null, $flags = 0)
    {
        return self::compile($pattern, $flags)->split($subject, $limit, $flags);
    }

    /**
     * A regular expression search and replace using `preg_replace`.  If the
     * replacement is a Closure, `preg_replace_callback` will be used instead.
     * 
     * @param  string  $pattern     The regular expression string or array.
     * @param  string  $replacement The replacement string, array or Closure.
     * @param  integer $limit       The max number of replacements.
     * @param  integer $count       (by ref) The number of replacements done.
     * @return string|array  The result of the replacement.
     */
    public static function replace($pattern, $replacement, $subject, $limit = null, &$count = null)
    {
        return self::compile($pattern, $flags)->replace($replacement, $subject, $limit, $count);
    }

    /**
     * A regular expression search and replace using `preg_replace_callback`.
     * 
     * @param  string  $pattern     The regular expression string or array.
     * @param  string  $replacement The replacement callback.
     * @param  integer $limit       The max number of replacements.
     * @param  integer $count       (by ref) The number of replacements done.
     * @return string|array  The result of the replacement.
     */
    public static function replaceCallback($pattern, $replacement, $subject, $limit = null, &$count = null)
    {
        return self::compile($pattern, $flags)->replaceCallback($replacement, $subject, $limit, $count);
    }
}