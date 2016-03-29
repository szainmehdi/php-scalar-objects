<?php
namespace RedCrystal\Scalars;

class NumberHandler extends ScalarObjectHandler
{
    /**
     * @return int|float
     */
    public static function abs($self)
    {
        return abs($self);
    }

    public static function ceil($self) : float
    {
        return ceil($self);
    }

    public static function equals($self, $number) : bool
    {
        return $self === $number;
    }

    public static function floor($self) : float
    {
        return floor($self);
    }

    public static function isBoolean($self) : bool
    {
        return is_bool($self);
    }

    public static function isFloat($self) : bool
    {
        return is_float($self);
    }

    public static function isInt($self) : bool
    {
        return is_int($self);
    }

    public static function mod($self, $num) : float
    {
        return floor($self - $num * ($self / $num));
    }

    public static function sqrt($self) : float
    {
        return sqrt($self);
    }

    public static function toArray($self) : array
    {
        return [$self];
    }

    public static function toFloat($self) : float
    {
        return (float)$self;
    }

    public static function toInt($self) : int
    {
        return intval($self);
    }

    public static function toJson($self) : string
    {
        return json_encode($self);
    }

    public static function toString($self) : string
    {
        return (string)$self;
    }

    protected static function verifyNumeric($input = null, $methodName = "")
    {
        if (is_numeric($input) === false) {
            throw new \InvalidArgumentException("Argument passed to $methodName must be numeric");
        }
    }
}
