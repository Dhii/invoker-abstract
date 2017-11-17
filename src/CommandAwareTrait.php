<?php

namespace Dhii\Invocation;

use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use InvalidArgumentException;

/**
 * Functionality for command awareness.
 *
 * @since [*next-version*]
 */
trait CommandAwareTrait
{
    /**
     * The command.
     *
     * @since [*next-version*]
     *
     * @var string|Stringable|null
     */
    protected $command;

    /**
     * Retrieves the command associated with this instance.
     *
     * @since [*next-version*]
     *
     * @return string|Stringable|null The command.
     */
    protected function _getCommand()
    {
        return $this->command;
    }

    /**
     * Assigns a command to this instance.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $command The command to assign.
     *
     * @throws InvalidArgumentException If the command is invalid.
     */
    protected function _setCommand($command)
    {
        if ($command !== null && !is_string($command) && !($command instanceof Stringable)) {
            throw $this->_createInvalidArgumentException($this->__('Invalid command'), null, null, $command);
        }

        $this->command = $command;
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
