<?php

namespace RedCrystal\Scalars;

class BooleanHandler extends ScalarObjectHandler
{
    public static function isBool($self) : bool
    {
        return true;
    }
}
