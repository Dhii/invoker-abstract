<?php

namespace Dhii\Invocation;

use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use InvalidArgumentException;

/**
 * Functionality for invoking a callable.
 *
 * @since [*next-version*]
 */
trait InvokeCallableCapableTrait
{
    /**
     * Invokes a callable.
     *
     * @since [*next-version*]
     *
     * @param callable $callable The callable to invoke.
     * @param array    $args     The arguments to invoke the callable with.
     *
     * @throws InvalidArgumentException If the callable is not callable.
     *
     * @return mixed The result of the invocation.
     */
    protected function _invokeCallable($callable, array $args)
    {
        if (!is_callable($callable)) {
            throw $this->_createInvalidArgumentException($this->__('Callable is not callable'), null, null, $callable);
        }

        return call_user_func_array($callable, $args);
    }

    /**
     * Creates a new invalid argument exception.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $message  The error message, if any.
     * @param int|null               $code     The error code, if any.
     * @param RootException|null     $previous The inner exception for chaining, if any.
     * @param mixed|null             $argument The invalid argument, if any.
     *
     * @return InvalidArgumentException The new exception.
     */
    abstract protected function _createInvalidArgumentException(
            $message = null,
            $code = null,
            RootException $previous = null,
            $argument = null
    );

    /**
     * Translates a string, and replaces placeholders.
     *
     * @since [*next-version*]
     * @see   sprintf()
     *
     * @param string $string  The format string to translate.
     * @param array  $args    Placeholder values to replace in the string.
     * @param mixed  $context The context for translation.
     *
     * @return string The translated string.
     */
    abstract protected function __($string, $args = [], $context = null);
}
