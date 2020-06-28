<?php
/**
 * Handlebars string
 *
 * @category  Xamin
 * @package   Handlebars
 * @author    fzerorubigd <fzerorubigd@gmail.com>
 * @author    Behrooz Shabani <everplays@gmail.com>
 * @author    Mardix <https://github.com/mardix>
 * @copyright 2012 (c) ParsPooyesh Co
 * @copyright 2013 (c) Behrooz Shabani
 * @copyright 2013 (c) Mardix
 * @license   MIT
 * @link      http://voodoophp.org/docs/handlebars
 */

namespace Handlebars;

class HandlebarsString
{
    private $string = "";

    /**
     * Create new string
     *
     * @param string $string input source
     */
    public function __construct($string)
    {
        $this->setString($string);
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getString();
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Create new string
     *
     * @param string $string input source
     *
     * @return void
     */
    public function setString($string)
    {
        $this->string = $string;
    }

}