<?php

namespace App\Base\RuleManager;

trait HasRules
{
    public static function rules(array $appends = []) : array
    {
        return array_merge(self::$baseRules,$appends);
    }
}
