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

use Mustache\Context;
use Mustache\Exception;

/**
 * Rendering exception with Mustache tag context.
 */
class RenderingException extends RuntimeException implements Exception
{
    private $frames;

    /**
     * @param string    $message
     * @param Exception $previous
     */
    public function __construct($message, array $frames = [], $previous = null)
    {
        $this->frames = $frames;

        parent::__construct($message, 0, $previous);
    }

    /**
     * Create an exception from the current rendering debug context.
     *
     * @param mixed $previous
     *
     * @return self
     */
    public static function fromDebugContext($previous, Context $context)
    {
        $frames = $context->getRenderingStack();
        $context->clearRenderingStack();

        return new self(self::formatMessage($previous, $frames), $frames, $previous);
    }

    /**
     * Get the Mustache rendering frames captured when the exception was thrown.
     *
     * @return array
     */
    public function getFrames()
    {
        return $this->frames;
    }

    /**
     * @param mixed $previous
     *
     * @return string
     */
    private static function formatMessage($previous, array $frames)
    {
        $previousMessage = self::getPreviousMessage($previous);

        if (empty($frames)) {
            return 'Error rendering template: ' . $previousMessage;
        }

        $frames = array_reverse($frames);
        $message = 'Error rendering ' . self::formatFrame(array_shift($frames)) . ': ' . $previousMessage;

        foreach ($frames as $frame) {
            $message .= "\nwhile rendering " . self::formatFrame($frame);
        }

        return $message;
    }

    /**
     * @param mixed $previous
     *
     * @return string
     */
    private static function getPreviousMessage($previous)
    {
        if (is_object($previous) && method_exists($previous, 'getMessage')) {
            return $previous->getMessage();
        }

        return 'unknown rendering error';
    }

    /**
     * @return string
     */
    private static function formatFrame(array $frame)
    {
        $type = isset($frame['type']) ? $frame['type'] : 'tag';
        $name = isset($frame['name']) ? sprintf(' "%s"', $frame['name']) : '';
        $line = isset($frame['line']) ? sprintf(' on line %d', $frame['line']) : '';
        $source = isset($frame['source']) ? sprintf(' of %s', $frame['source']) : '';

        return $type . $name . $line . $source;
    }
}
