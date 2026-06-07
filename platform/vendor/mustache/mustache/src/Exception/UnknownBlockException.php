<?php

/*
 * This file is part of Mustache.php.
 *
 * (c) 2010-2026 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mustache\Exception;

use Mustache\Exception;

/**
 * Unknown block exception.
 */
class UnknownBlockException extends \UnexpectedValueException implements Exception
{
    protected $blockName;

    /**
     * @param string    $blockName
     * @param Exception $previous
     */
    public function __construct($blockName, $previous = null)
    {
        $this->blockName = $blockName;
        $message = sprintf('Unknown block: %s', $blockName);
        parent::__construct($message, 0, $previous);
    }

    public function getBlockName()
    {
        return $this->blockName;
    }
}
