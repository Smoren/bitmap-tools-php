<?php

namespace Smoren\BitmapTools\Helpers;

/**
 * Class BitmapHelper
 * @author Smoren <ofigate@gmail.com>
 */
class BitmapHelper
{
    /**
     * Creates bit mask from list of true bits
     * @param array<int> $bits array of true bit positions
     * @return int
     */
    public static function create(array $bits): int
    {
        $result = 0;
        foreach($bits as $code) {
            $result += 2**$code;
        }
        return $result;
    }

    /**
     * Parses bitmap to array of bit positions
     * @param int $bitmap bitmap
     * @return array<int>
     */
    public static function parse(int $bitmap): array
    {
        $result = [];
        $i = 0;

        while($bitmap) {
            if($bitmap % 2) {
                $result[] = $i;
            }

            $bitmap = (int)($bitmap / 2);
            ++$i;
        }

        return $result;
    }

    /**
     * Returns the result of "and" operation of bitmaps pair
     * (are there common bits in two operands)
     * @param int|array<int> $lhs left operand
     * @param int|array<int> $rhs right operand
     * @return bool
     */
    public static function intersects($lhs, $rhs): bool
    {
        if(is_array($lhs)) {
            $lhs = static::create($lhs);
        }
        if(is_array($rhs)) {
            $rhs = static::create($rhs);
        }

        return ($lhs & $rhs) !== 0;
    }

    /**
     * Returns true if haystack bitmap has all the bits in needle
     * @param int|array<int> $haystack haystack
     * @param int|array<int> $needle needle
     * @return bool
     */
    public static function includes($haystack, $needle): bool
    {
        if(is_array($haystack)) {
            $haystack = static::create($haystack);
        }
        if(is_array($needle)) {
            $needle = static::create($needle);
        }

        return ($haystack & $needle) === $needle;
    }
}
