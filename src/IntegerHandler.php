<?php
namespace RedCrystal\Scalars;

class IntegerHandler extends NumberHandler
{
    public static function isInt($self) : bool
    {
        return true;
    }

    public static function toInt($self) : int
    {
        return $self;
    }

    public static function even(int $self) : bool
    {
        return $self % 2 === 0;
    }

    public static function odd(int $self) : bool
    {
        return $self % 2 === 1;
    }
}
