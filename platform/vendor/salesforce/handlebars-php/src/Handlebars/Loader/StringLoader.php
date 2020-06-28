<?php
/**
 * Handlebars Template string Loader implementation.
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

namespace Handlebars\Loader;
use Handlebars\Loader;
use Handlebars\HandlebarsString;

class StringLoader implements Loader
{

    /**
     * Load a Template by source.
     *
     * @param string $name Handlebars Template source
     *
     * @return HandlebarsString Handlebars Template source
     */
    public function load($name)
    {
        return new HandlebarsString($name);
    }

}
