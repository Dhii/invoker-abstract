<?php

namespace Dhii\Invocation;

use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use InvalidArgumentException;

/**
 * Functionality for command invoker awareness.
 *
 * @since [*next-version*]
 */
trait CommandInvokerAwareTrait
{
    /**
     * The command invoker.
     *
     * @since [*next-version*]
     *
     * @var CommandInvokerInterface
     */
    protected $commandInvoker;

    /**
     * Retrieves the commandInvoker associated with this instance.
     *
     * @since [*next-version*]
     *
     * @return CommandInvokerInterface|null The commandInvoker.
     */
    protected function _getCommandInvoker()
    {
        return $this->commandInvoker;
    }

    /**
     * Assigns a command invoker to this instance.
     *
     * @since [*next-version*]
     *
     * @param CommandInvokerInterface|null $invoker The command invoker to assign.
     *
     * @throws InvalidArgumentException If the command invoker is invalid.
     */
    protected function _setCommandInvoker($invoker)
    {
        if ($invoker !== null && !($invoker instanceof CommandInvokerInterface)) {
            throw $this->_createInvalidArgumentException($this->__('Invalid command invoker'), null, null, $invoker);
        }

        $this->commandInvoker = $invoker;
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
