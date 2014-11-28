<?php

/**
 * Partial PHP implementations of idn_*() functions from INTL.
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

defined('INTL_IDNA_VARIANT_2003') OR define('INTL_IDNA_VARIANT_2003', 0);
defined('INTL_IDNA_VARIANT_UTS46') OR define('INTL_IDNA_VARIANT_UTS46', 1);

if (!function_exists('idn_to_utf8')) {

    // The parameters $options and $idna_info are ignored.
    function idn_to_utf8($domain, $options = 0, $variant = INTL_IDNA_VARIANT_2003, & $idna_info = null) {

        if ($domain && preg_match('/(^|\.)xn--/i', $domain)) {

            if ($variant == INTL_IDNA_VARIANT_2003) {
                $idn = Net_IDNA2::singleton(array('encoding' => 'utf8', 'version' => '2003', 'overlong' => false));
            } else {
                $idn = Net_IDNA2::singleton(array('encoding' => 'utf8', 'version' => '2008', 'overlong' => false));
            }

            try {
                $domain = $idn->decode($domain);
            }
            catch (Exception $e) {
            }
        }

        return $domain;
    }

}

if (!function_exists('idn_to_unicode')) {

    // The parameters $options and $idna_info are ignored.
    function idn_to_unicode($domain, $options = 0, $variant = INTL_IDNA_VARIANT_2003, & $idna_info = null) {

        return idn_to_utf8($domain, $options, $variant, $idna_info);
    }

}

if (!function_exists('idn_to_ascii')) {

    // The parameters $options and $idna_info are ignored.
    function idn_to_ascii($domain, $options = 0, $variant = INTL_IDNA_VARIANT_2003, & $idna_info = null) {

        if ($domain && preg_match('/[^\x20-\x7E]/', $domain)) {

            if ($variant == INTL_IDNA_VARIANT_2003) {
                $idn = Net_IDNA2::singleton(array('encoding' => 'utf8', 'version' => '2003', 'overlong' => false));
            } else {
                $idn = Net_IDNA2::singleton(array('encoding' => 'utf8', 'version' => '2008', 'overlong' => false));
            }

            try {
                $domain = $idn->encode($domain);
            }
            catch (Exception $e) {
            }
        }

        return $domain;
    }

}
