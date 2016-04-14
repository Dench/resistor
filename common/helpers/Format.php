<?php

namespace common\helpers;

class Format
{

    public static function phone($value, $type = 0)
    {
        $result = preg_replace('/[^\d]/', '', $value);

        // +380441234567
        if ($type == 1 && strlen($result) == 12) {
            $result = '+' . $value;
        }

        // +38 (044) 123-45-67
        if ($type == 2 && strlen($result) == 12) {
            $result = '+' . substr($value, 0, 2) . ' (' . substr($value, 2, 3) . ') ' . substr($value, 5, 3) . '-' . substr($value, 8, 2) . '-' . substr($value, 10);
        }

        // (044) 123-45-67
        if ($type == 3 && strlen($result) == 12) {
            $result = '(' . substr($value, 2, 3) . ') ' . substr($value, 5, 3) . '-' . substr($value, 8, 2) . '-' . substr($value, 10);
        }

        return $result;
    }

}