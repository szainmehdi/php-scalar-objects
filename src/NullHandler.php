<?php
namespace RedCrystal\Scalars;

class NullHandler extends ScalarObjectHandler
{
    public static function isNull($self) : bool
    {
        return true;
    }

    public static function toJson($self) : string
    {
        return 'null';
    }
}
