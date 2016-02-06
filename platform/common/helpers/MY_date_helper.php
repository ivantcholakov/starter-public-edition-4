<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if ( ! function_exists('timespan'))
{
    /**
     * Timespan
     *
     * Returns a span of seconds in this format:
     *    10 days 14 hours 36 minutes 47 seconds
     *
     * @param       int     a number of seconds
     * @param       int     Unix timestamp
     * @param       int     a number of display units
     * @return      string
     */
    function timespan($seconds = 1, $time = '', $units = 7)
    {
        $CI =& get_instance();
        $CI->lang->load('date');

        is_numeric($seconds) OR $seconds = 1;
        is_numeric($time) OR $time = time();
        is_numeric($units) OR $units = 7;

        $seconds = ($time <= $seconds) ? 1 : $time - $seconds;

        $str = array();
        $years = floor($seconds / 31557600);

        if ($years > 0)
        {
            $str[] = $years.' '.$CI->lang->line($years > 1 ? 'date_years' : 'date_year');
        }

        $seconds -= $years * 31557600;
        $months = floor($seconds / 2629743);

        if (count($str) < $units && ($years > 0 OR $months > 0))
        {
            if ($months > 0)
            {
                $str[] = $months.' '.$CI->lang->line($months > 1 ? 'date_months' : 'date_month');
            }

            $seconds -= $months * 2629743;
        }

        $weeks = floor($seconds / 604800);

        if (count($str) < $units && ($years > 0 OR $months > 0 OR $weeks > 0))
        {
            if ($weeks > 0)
            {
                $str[] = $weeks.' '.$CI->lang->line($weeks > 1 ? 'date_weeks' : 'date_week');
            }

            $seconds -= $weeks * 604800;
        }

        $days = floor($seconds / 86400);

        if (count($str) < $units && ($months > 0 OR $weeks > 0 OR $days > 0))
        {
            if ($days > 0)
            {
                $str[] = $days.' '.$CI->lang->line($days > 1 ? 'date_days' : 'date_day');
            }

            $seconds -= $days * 86400;
        }

        $hours = floor($seconds / 3600);

        if (count($str) < $units && ($days > 0 OR $hours > 0))
        {
            if ($hours > 0)
            {
                $str[] = $hours.' '.$CI->lang->line($hours > 1 ? 'date_hours' : 'date_hour');
            }

            $seconds -= $hours * 3600;
        }

        $minutes = floor($seconds / 60);

        if (count($str) < $units && ($days > 0 OR $hours > 0 OR $minutes > 0))
        {
            if ($minutes > 0)
            {
                $str[] = $minutes.' '.$CI->lang->line($minutes > 1 ? 'date_minutes' : 'date_minute');
            }

            $seconds -= $minutes * 60;
        }

        if (count($str) === 0)
        {
            $str[] = $seconds.' '.$CI->lang->line($seconds > 1 ? 'date_seconds' : 'date_second');
        }

        // Modified by Ivan Tcholakov, 06-FEB-2016.
        //return implode(', ', $str);
        $result = implode(', ', $str);

        switch ($CI->lang->current())
        {
            case 'english':
            case 'bulgarian':

                $result = IS_UTF8_CHARSET ? UTF8::strtolower($result) : strtolower($result);
                break;
        }

        return $result;
        //
    }

}
