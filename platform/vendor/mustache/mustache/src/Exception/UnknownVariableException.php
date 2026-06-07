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
 * Unknown variable exception.
 */
class UnknownVariableException extends \UnexpectedValueException implements Exception
{
    /**
     * @var string
     */
    protected $variableName;

    /**
     * @param string    $variableName
     * @param Exception $previous
     */
    public function __construct($variableName, $previous = null)
    {
        $this->variableName = $variableName;
        $message = sprintf('Unknown variable: %s', $variableName);
        parent::__construct($message, 0, $previous);
    }

    public function getVariableName()
    {
        return $this->variableName;
    }
}
