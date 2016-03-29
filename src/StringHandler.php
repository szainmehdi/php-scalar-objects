<?php
namespace RedCrystal\Scalars;

class StringHandler extends ScalarObjectHandler
{
    public static function isString(string $self) : bool
    {
        return true;
    }

    public static function caseCompare(string $self, string $compare) : int
    {
        return strcasecmp($self, $compare);
    }

    public static function hash(string $self, int $algorithm = PASSWORD_DEFAULT, array $options = []) : string
    {
        return password_hash($self, $algorithm, $options);
    }

    public static function length(string $self) : int
    {
        return strlen($self);
    }

    public static function slice(string $self, int $offset, int $length = null) : string
    {
        $offset = self::prepareOffset($self, $offset);
        $length = self::prepareLength($self, $offset, $length);

        if (0 === $length) {
            return '';
        }

        return substr($self, $offset, $length);
    }

    public static function replaceSlice(string $self, string $replacement, int $offset, int $length = null) : string
    {
        $offset = self::prepareOffset($self, $offset);
        $length = self::prepareLength($self, $offset, $length);

        return substr_replace($self, $replacement, $offset, $length);
    }

    public static function indexOf(string $self, int $search, int $offset = 0)
    {
        $offset = self::prepareOffset($self, $offset);

        if ($search === '') {
            return $offset;
        }

        return strpos($self, $search, $offset);
    }

    public static function lastIndexOf(string $self, int $search, int $offset = null)
    {
        if ($offset === null) {
            $offset = $self->length();
        } else {
            $offset = self::prepareOffset($self, $offset);
        }

        if ($search === '') {
            return $offset;
        }

        /* Converts $offset to a negative offset as strrpos has a different
         * behavior for positive offsets. */
        return strrpos($self, $search, $offset - $self->length());
    }

    public static function capitalize(string $self) : string
    {
        return ucwords($self);
    }

    public static function contains(string $self, string $search) : bool
    {
        return $self->indexOf($search) !== false;
    }

    public static function lower(string $self) : string
    {
        return strtolower($self);
    }

    public static function startsWith(string $self, string $search) : bool
    {
        return $self->indexOf($search) === 0;
    }

    public static function endsWith(string $self, string $search) : bool
    {
        return $self->lastIndexOf($search) === $self->length() - $search->length();
    }

    public static function count(string $self, string $search, int $offset = 0, int $length = null) : int
    {
        $offset = self::prepareOffset($self, $offset);
        $length = self::prepareLength($self, $offset, $length);

        if ($search === '') {
            return $length + 1;
        }

        return substr_count($self, $search, $offset, $length);
    }

    public static function replace(string $self, string $from, string $to, int $limit = null) : string
    {
        if (is_array($from)) {
            return self::replacePairs($self, $from, $to);
        }

        if ($limit === null) {
            return str_replace($from, $to, $self);
        }

        self::verifyPositive($limit, 'Limit');
        return self::replaceWithLimit($self, $from, $to, $limit);
    }

    public static function split(string $self, string $separator, int $limit = PHP_INT_MAX) : array
    {
        return explode($separator, $self, $limit);
    }

    public static function chunk(string $self, int $chunkLength = 1) : array
    {
        self::verifyPositive($chunkLength, 'Chunk length');
        return str_split($self, $chunkLength);
    }

    public static function repeat(string $self, int $times) : string
    {
        self::verifyNotNegative($times, 'Number of repetitions');
        return str_repeat($self, $times);
    }

    public static function reverse(string $self) : string
    {
        return strrev($self);
    }

    public static function trim(string $self, string $characters = " \t\n\r\v\0") : string
    {
        return trim($self, $characters);
    }

    public static function trimLeft(string $self, string $characters = " \t\n\r\v\0") : string
    {
        return ltrim($self, $characters);
    }

    public static function trimRight(string $self, string $characters = " \t\n\r\v\0") : string
    {
        return rtrim($self, $characters);
    }

    public static function padLeft(string $self, int $length, string $padString = " ") : string
    {
        return str_pad($self, $length, $padString, STR_PAD_LEFT);
    }

    public static function padRight(string $self, int $length, string $padString = " ") : string
    {
        return str_pad($self, $length, $padString, STR_PAD_RIGHT);
    }

    public static function toArray(string $self) : array
    {
        return [$self];
    }

    public static function toFloat(string $self) : float
    {
        return (float)$self;
    }

    public static function toInt(string $self) : int
    {
        return (int)$self;
    }

    public static function toJson(string $self) : string
    {
        return json_encode($self);
    }

    public static function toString(string $self) : string
    {
        return $self;
    }

    public static function upper(string $self) : string
    {
        return strtoupper($self);
    }

    /** @internal */
    protected static function prepareOffset(string $string, $offset) : int
    {
        $len = $string->length();
        if ($offset < -$len || $offset > $len) {
            throw new \InvalidArgumentException('Offset must be in range [-len, len]');
        }

        if ($offset < 0) {
            $offset += $len;
        }

        return $offset;
    }

    /** @internal */
    protected static function prepareLength(string $string, $offset, $length) : int
    {
        if ($length === null) {
            return $string->length() - $offset;
        }

        if ($length < 0) {
            $length += $string->length() - $offset;

            if ($length < 0) {
                throw new \InvalidArgumentException('Length too small');
            }
        } else {
            if ($offset + $length > $string->length()) {
                throw new \InvalidArgumentException('Length too large');
            }
        }

        return $length;
    }

    /** @internal */
    protected static function verifyPositive($value, $name)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException("$name has to be positive");
        }
    }

    /** @internal */
    protected static function verifyNotNegative($value, $name)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException("$name can not be negative");
        }
    }

    /** @internal */
    protected static function replacePairs(string $string, $replacements, $limit)
    {
        if ($limit === null) {
            return strtr($string, $replacements);
        }

        self::verifyPositive($limit, 'Limit');
        $str = $string;
        foreach ($replacements as $from => $to) {
            $str = self::replaceWithLimit($str, $from, $to, $limit);
            if (0 === $limit) {
                break;
            }
        }
        return $str;
    }

    /** @internal */
    protected static function replaceWithLimit(string $string, string $from, string $to, &$limit)
    {
        $lenDiff = $to->length() - $from->length();
        $index = 0;

        while (false !== $index = $string->indexOf($from, $index)) {
            $string = $string->replaceSlice($to, $index, $to->length());
            $index += $lenDiff;

            if (0 === --$limit) {
                break;
            }
        }

        return $string;
    }
}
