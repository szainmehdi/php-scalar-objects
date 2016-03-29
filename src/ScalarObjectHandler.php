<?php
namespace RedCrystal\Scalars;

class ScalarObjectHandler
{

    public static function isArray($self) : bool
    {
        return false;
    }

    public static function isBool($self) : bool
    {
        return false;
    }

    public static function isFloat($self) : bool
    {
        return false;
    }

    public static function isInt($self) : bool
    {
        return false;
    }

    public static function isNull($self) : bool
    {
        return false;
    }

    public static function isResource($self) : bool
    {
        return false;
    }

    public static function isString($self) : bool
    {
        return false;
    }

    public static function toJson($self) : string
    {
        return json_encode($self);
    }

}
