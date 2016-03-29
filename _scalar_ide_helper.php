<?php

/**
 * String methods.
 */
class string
{
    /**
     * @return bool
     */
    public function isString() : bool {}

    /**
     * @param string $compare
     *
     * @return int
     */
    public function caseCompare(string $compare) : int {}

    /**
     * @param int $algorithm
     * @param array $options
     *
     * @return string
     */
    public function hash(int $algorithm = PASSWORD_DEFAULT, array $options = []) : string {}

    /**
     * @return int
     */
    public function length() : int {}

    /**
     * @param int $offset
     * @param int|null $length
     *
     * @return string
     */
    public function slice(int $offset, int $length = null) : string {}

    /**
     * @param string $replacement
     * @param int $offset
     * @param int|null $length
     *
     * @return string
     */
    public function replaceSlice(string $replacement, int $offset, int $length = null) : string {}

    /**
     * @param string $search
     * @param int $offset
     *
     * @return int|bool - returns int if found, false if not found.
     * @see strpos()
     */
    public function indexOf(string $search, int $offset = 0) {}

    /**
     * @param string $string
     * @param int|null $offset
     *
     * @return int|bool - returns int if found, false if not found.
     * @see strrpos()
     */
    public function lastIndexOf(string $string, int $offset = null) {}

    /**
     * @return string
     */
    public function capitalize() : string {}

    /**
     * @param string $search
     *
     * @return bool
     */
    public function contains(string $search) : bool {}

    /**
     * @return string
     */
    public function lower() : string {}

    /**
     * @param string $search
     *
     * @return bool
     */
    public function startsWith(string $search) : bool {}

    /**
     * @param string $search
     *
     * @return bool
     */
    public function endsWith(string $search) : bool {}

    /**
     * @param string $search
     * @param int $offset
     * @param int|null $length
     *
     * @return int
     */
    public function count(string $search, int $offset = 0, int $length = null) : int {}

    /**
     * @param string $from
     * @param string $to
     * @param int|null $limit
     *
     * @return string
     */
    public function replace(string $from, string $to, int $limit = null) : string {}

    /**
     * @param string $separator
     * @param int $limit
     *
     * @return array
     */
    public function split(string $separator, int $limit = PHP_INT_MAX) : array {}

    /**
     * @param int $chunkLength
     *
     * @return array
     */
    public function chunk(int $chunkLength = 1) : array {}

    /**
     * @param int $times
     *
     * @return string
     */
    public function repeat(int $times) : string {}

    /**
     * @return string
     */
    public function reverse() : string {}

    /**
     * @param string $characters
     *
     * @return string
     */
    public function trim(string $characters = " \t\n\r\v\0") : string {}

    /**
     * @param string $characters
     *
     * @return string
     */
    public function trimLeft(string $characters = " \t\n\r\v\0") : string {}

    /**
     * @param string $characters
     *
     * @return string
     */
    public function trimRight(string $characters = " \t\n\r\v\0") : string {}

    /**
     * @param int $length
     * @param string $padString
     *
     * @return string
     */
    public function padLeft(int $length, string $padString = " ") : string {}

    /**
     * @param int $length
     * @param string $padString
     *
     * @return string
     */
    public function padRight(int $length, string $padString = " ") : string {}

    /**
     * @return array
     */
    public function toArray() : array {}

    /**
     * @return float
     */
    public function toFloat() : float {}

    /**
     * @return int
     */
    public function toInt() : int {}

    /**
     * @return string
     */
    public function toJSON() : string {}

    /**
     * @return string
     */
    public function toString() : string {}

    /**
     * @return string
     */
    public function upper() : string {}
}
