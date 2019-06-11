<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Overwriting the timezones function to include Arizona timezone
 */


if ( ! function_exists('timezones'))
{
    /**
     * Timezones
     *
     * Returns an array of timezones. This is a helper function
     * for various other ones in this library
     *
     * @param   string  timezone
     * @return  string
     */
    function timezones($tz = '')
    {
        // Note: Don't change the order of these even though
        // some items appear to be in the wrong order

        $zones = array(
            'UM12'      => -12,
            'UM11'      => -11,
            'UM10'      => -10,
            'UM95'      => -9.5,
            'UM9'       => -9,
            'UM8'       => -8,
            'UM75'      => -7,
            'UM7'       => -7,
            'UM6'       => -6,
            'UM5'       => -5,
            'UM45'      => -4.5,
            'UM4'       => -4,
            'UM35'      => -3.5,
            'UM3'       => -3,
            'UM2'       => -2,
            'UM1'       => -1,
            'UTC'       => 0,
            'UP1'       => +1,
            'UP2'       => +2,
            'UP3'       => +3,
            'UP35'      => +3.5,
            'UP4'       => +4,
            'UP45'      => +4.5,
            'UP5'       => +5,
            'UP55'      => +5.5,
            'UP575'     => +5.75,
            'UP6'       => +6,
            'UP65'      => +6.5,
            'UP7'       => +7,
            'UP8'       => +8,
            'UP875'     => +8.75,
            'UP9'       => +9,
            'UP95'      => +9.5,
            'UP10'      => +10,
            'UP105'     => +10.5,
            'UP11'      => +11,
            'UP115'     => +11.5,
            'UP12'      => +12,
            'UP1275'    => +12.75,
            'UP13'      => +13,
            'UP14'      => +14
        );

        if ($tz === '')
        {
            return $zones;
        }

        return isset($zones[$tz]) ? $zones[$tz] : 0;
    }
}
