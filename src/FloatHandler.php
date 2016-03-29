<?php
namespace RedCrystal\Scalars;

class FloatHandler extends NumberHandler
{
    public static function isFloat($self) : bool
    {
        return true;
    }

    public static function round(float $self, $precision = 0, $mode = null) : float
    {
        return round($self, $precision, $mode);
    }

    //Stub - TODO?
    public static function toPrecision(float $self, $int = null) : string
    {
        if (!$int === null) {
            return $self->toString();
        }
        return $self->toString();
    }

    public static function toFixed(float $self, $int = null) : string
    {
        if ($int === null) {
            return $self->toString();
        }
        return round($self, $int)->toString();
    }
}
