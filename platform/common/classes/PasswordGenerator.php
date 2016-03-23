<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }
/*
 * Unbiased random password generator.
 * Copyright (c) 2015, Taylor Hornby
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

class PasswordGenerator
{
    public static function getASCIIPassword($length)
    {
        $printable = "!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~";
        return self::getCustomPassword(str_split($printable), $length);
    }

    public static function getAlphaNumericPassword($length)
    {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        return self::getCustomPassword(str_split($alphanum), $length);
    }

    public static function getHexPassword($length)
    {
        $hex = "0123456789ABCDEF";
        return self::getCustomPassword(str_split($hex), $length);
    }

    /*
     * Create a random password composed of a custom character set.
     * $characterSet - An *array* of strings the password can be composed of.
     * $length - The number of random strings (in $characterSet) to include in the password.
     * Returns false on error (always check!).
     */
    public static function getCustomPassword($characterSet, $length)
    {
        if($length < 1 || !is_array($characterSet))
            return false;

        $charSetLen = count($characterSet);
        if($charSetLen == 0)
            return false;

        $random = self::getRandomInts($length * 2);
        $mask = self::getMinimalBitMask($charSetLen - 1);

        $password = "";

        // To generate the password, we repeatedly try random integers and use the ones within the range
        // 0 to $charSetLen - 1 to select an index into the character set. This is the only known way to
        // make a truly unbiased random selection from a set using random binary data.

        // A poorly implemented or malicious RNG could cause an infinite loop, leading to a denial of service.
        // We need to guarantee termination, so $iterLimit holds the number of further iterations we will allow.
        // It is extremely unlikely (about 2^-64) that more than $length*64 random ints are needed.
        $iterLimit = max($length, $length * 64);   // If length is close to PHP_INT_MAX we don't want to overflow.
        $randIdx = 0;
        while(strlen($password) < $length)
        {
            if($randIdx >= count($random))
            {
                $random = self::getRandomInts(2*($length - strlen($password)));
                $randIdx = 0;
            }

            // This is wasteful, but RNGs are fast and doing otherwise adds complexity and bias.
            $c = $random[$randIdx++] & $mask;
            // Only use the random number if it is in range, otherwise try another (next iteration).
            if($c < $charSetLen)
                $password .= self::sidechannel_safe_array_index($characterSet, $c);
            // FIXME: check the return value

            // Guarantee termination
            $iterLimit--;
            if($iterLimit <= 0)
                return false;
        }

        return $password;
    }

    // Returns the character at index $index in $string in constant time.
    private static function sidechannel_safe_array_index($string, $index)
    {
        // FIXME: Make the const-time hack below work for all integer sizes, or
        // check it properly.
        if (count($string) > 65535 || $index > count($string)) {
            return false;
        }
        $character = 0;
        for ($i = 0; $i < count($string); $i++) {
            $x = $i ^ $index;
            $mask = (((($x | ($x >> 16)) & 0xFFFF) + 0xFFFF) >> 16) - 1;
            $character |= ord($string[$i]) & $mask;
        }
        return chr($character);
    }

    // Returns the smallest bit mask of all 1s such that ($toRepresent & mask) = $toRepresent.
    // $toRepresent must be an integer greater than or equal to 1.
    private static function getMinimalBitMask($toRepresent)
    {
        if($toRepresent < 1)
            return false;
        $mask = 0x1;
        while($mask < $toRepresent)
            $mask = ($mask << 1) | 1;
        return $mask;
    }

    // Returns an array of $numInts random integers between 0 and PHP_INT_MAX
    public static function getRandomInts($numInts)
    {
        $ints = array();
        if ($numInts <= 0) {
            return $ints;
        }

        // Modified by Ivan Tcholakov, 23-MAR-2016.
        //$rawBinary = mcrypt_create_iv($numInts * PHP_INT_SIZE, MCRYPT_DEV_URANDOM);
        $rawBinary = get_instance()->security->get_random_bytes($numInts * PHP_INT_SIZE);
        if ($rawBinary === false) {
            throw new Exception('PasswordGenerator::getRandomInts(): There is no suitable CSPRNG installed on your system.');
        }
        //

        for($i = 0; $i < $numInts; ++$i)
        {
            $thisInt = 0;
            for($j = 0; $j < PHP_INT_SIZE; ++$j)
            {
                $thisInt = ($thisInt << 8) | (ord($rawBinary[$i * PHP_INT_SIZE + $j]) & 0xFF);
            }
            // Absolute value in two's compliment (with min int going to zero)
            $thisInt = $thisInt & PHP_INT_MAX;
            $ints[] = $thisInt;
        }
        return $ints;
    }

}
