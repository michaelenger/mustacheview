<?php

namespace Mustache;

/*
 * This file is part of Mustache.php.
 *
 * (c) 2012 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Mustache Lambda Helper.
 *
 * Passed to section and interpolation lambdas, giving them access to a `render`
 * method for rendering a string with the current context.
 */
class LambdaHelper
{
    private $mustache;
    private $context;

    /**
     * Mustache Lambda Helper constructor.
     *
     * @param  Engine  $mustache Mustache engine instance.
     * @param  Context $context  Rendering context.
     */
    public function __construct( Engine $mustache,  Context $context)
    {
        $this->mustache = $mustache;
        $this->context  = $context;
    }

    /**
     * Render a string as a Mustache template with the current rendering context.
     *
     * @param string $string
     *
     * @return Rendered template.
     */
    public function render($string)
    {
        return $this->mustache
            ->loadLambda((string) $string)
            ->renderInternal($this->context);
    }
}
