<?php
namespace RedCrystal\Scalars;

use InvalidArgumentException;

class ArrayHandler extends ScalarObjectHandler
{
    public static function isArray($self) : bool
    {
        return true;
    }

    // TODO - I don't like this.
    public static function any(array $self) : bool
    {
        foreach ($self as $val) {
            if ($val !== null) {
                return true;
            }
        }
        return false;
    }

    // TODO - I don't like this.
    public static function all(array $self) : bool
    {
        foreach ($self as $val) {
            if ($val === null) {
                return false;
            }
        }
        return true;
    }

    public static function compact(array $self) : array
    {
        return array_filter($self);
    }

    public static function chunk(array $self, int $size) : array
    {
        return array_chunk($self, $size);
    }

    public static function column(array $self, string $key) : array
    {
        return array_column($self, $key);
    }

    public static function combine(array $self, array $values) : array
    {
        return array_combine($self, $values);
    }

    public static function count(array $self) : int
    {
        return count($self);
    }

    public static function countValues(array $self) : int
    {
        return array_count_values($self);
    }

    public static function diff(array $self, array $compare) : array
    {
        return array_diff($self, $compare);
    }

    // TODO - Unnecessary
    public static function difference(array $self, array $compare) : array
    {
        return array_diff($self, $compare);
    }

    public static function each(array $self, callable $callback) : array
    {
        array_walk_recursive($self, $callback);
        return $self;
    }

    public static function filter(array $self, callable $callback) : array
    {
        return array_filter($self, $callback);
    }

    public static function has(array $self, $value) : bool
    {
        return in_array($value, $self, true);
    }

    public static function hasKey(array $self, string $key) : bool
    {
        return array_key_exists($key, $self);
    }

    /**
     * @return int|bool - int if found, false if not found.
     * @see array_search()
     */
    public static function indexOf(array $self, $value)
    {
        return array_search($value, $self);
    }

    public static function intersect(array $self, array $array) : array
    {
        return array_intersect($self, $array);
    }

    // TODO - figure out what's going on here.
    public static function intersperse(array $self, $value) : array
    {
        $array = $self;
        $chunk = array_chunk($array, 1);

        $intersperser = function (&$row) {
            $row[1] = "lalal";
        };
        foreach ($chunk as &$row) {
            $row[1] = $value;
        }
        $result = call_user_func_array('array_merge', $chunk);
        array_pop($result);
        return $result;
    }

    public static function join(array $self, string $on = "") : string
    {
        return implode($on, $self);
    }

    public static function keys(array $self) : array
    {
        return array_keys($self);
    }

    public static function keySort(array $self) : array
    {
        ksort($self);
        return $self;
    }

    public static function map(array $self, callable $callback, $arguments = null) : array
    {
        $array = $self;
        if ($arguments === null) {
            $result = array_map($callback, $array);
        } else {
            $args = func_get_args();
            array_shift($args);
            array_unshift($args, $callback, $array);
            $result = call_user_func_array("array_map", $args);
        }

        return $result;
    }

    public static function max(array $self)
    {
        return max($self);
    }

    public static function merge(array $self, array $array) : array
    {
        return array_merge($self, $array);
    }

    public static function min(array $self)
    {
        return min($self);
    }

    public static function push(array $self, $val) : array
    {
        array_push($self, $val);
        return $self;
    }

    public static function rand(array $self, int $number = 1)
    {
        $r = array_rand($self, $number);
        return $self[$r];
    }

    public static function reduce(array $self, callable $callback, $initial = null)
    {
        return array_reduce($self, $callback, $initial);
    }

    public static function reindex(array $self, callable $by = null) : array
    {
        if ($by === null) {
            return array_values($self);
        }
        if (is_callable($by)) {
            $keys = array_map($by, $self);
            return array_combine($keys, array_values($self));
        }
    }

    public static function reverse(array $self) : array
    {
        return array_reverse($self);
    }

    public static function reverseKeySort(array $self) : array
    {
        krsort($self);
        return $self;
    }

    public static function slice(array $self, int $offset, int $length = null, bool $preserve = false) : array
    {
        return array_slice($self, $offset, $length, $preserve);
    }

    public static function splice(array $self, int $offset, int $length = null, $replacement = null) : array
    {
        if (null === $length) {
            $extracted = array_splice($self, $offset);
        } else {
            $extracted = array_splice($self, $offset, $length, $replacement);
        }
        return $self;
    }

    public static function sort(array $self, int $flags = null) : array
    {
        $result = sort($self, $flags);

        if ($result === false) {
            throw new InvalidArgumentException("Array could not be sorted.");
        }

        return $self;
    }

    /**
     * @return int|float
     */
    public static function sum(array $self)
    {
        return array_sum($self);
    }

    public static function toArray(array $self) : array
    {
        return $self;
    }

    public static function toFloat(array $self) : float
    {
        return (float)$self;
    }

    public static function toInt(array $self) : int
    {
        return (int)$self;
    }

    public static function toJson(array $self) : string
    {
        return json_encode($self);
    }

    public static function toString(array $self) : string
    {
        return (string)$self;
    }

    public static function values(array $self) : array
    {
        return array_values($self);
    }
}
