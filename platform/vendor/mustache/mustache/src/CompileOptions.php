<?php

/*
 * This file is part of Mustache.php.
 *
 * (c) 2010-2026 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mustache;

/**
 * Mustache compiler options.
 *
 * @internal Users should set options in Mustache\Engine, not here :)
 */
class CompileOptions
{
    public $customEscape = false;
    public $charset = 'UTF-8';
    public $strictCallables = false;
    public $entityFlags = ENT_COMPAT;
    public $strictTags = Engine::STRICT_COERCION;
    public $debugRendering = false;
    public $sourceName;

    /**
     * @param array $options Compiler options (default: [])
     */
    public function __construct(array $options = [])
    {
        if (isset($options['custom_escape'])) {
            $this->customEscape = (bool) $options['custom_escape'];
        }

        if (isset($options['charset'])) {
            $this->charset = $options['charset'];
        }

        if (isset($options['strict_callables'])) {
            $this->strictCallables = (bool) $options['strict_callables'];
        }

        if (isset($options['entity_flags'])) {
            $this->entityFlags = $options['entity_flags'];
        }

        if (isset($options['strict_tags'])) {
            $this->strictTags = Engine::normalizeStrictTags($options['strict_tags']);
        }

        if (isset($options['debug_rendering'])) {
            $this->debugRendering = (bool) $options['debug_rendering'];
        }

        if (isset($options['source_name'])) {
            $this->sourceName = $options['source_name'];
        }
    }
}
