<?php

namespace Dhii\Invocation\FuncTest;

use Xpmock\TestCase;
use Dhii\Invocation\CommandAwareTrait as TestSubject;
use Dhii\Util\String\StringableInterface as Stringable;
use InvalidArgumentException;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class CommandAwareTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Invocation\CommandAwareTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return object
     */
    public function createInstance()
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                ->getMockForTrait();
        $mock->method('__')
                ->will($this->returnArgument(0));
        $mock->method('_createInvalidArgumentException')
                ->will($this->returnCallback(function ($message) {
                    return new InvalidArgumentException($message);
                }));

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInternalType(
            'object',
            $subject,
            'A valid instance of the test subject could not be created.'
        );
    }

    /**
     * Creates a new command.
     *
     * @since [*next-version*]
     *
     * @param string $string The command string.
     *
     * @return Stringable The new command.
     */
    public function createCommand($string = '')
    {
        return $this->createStringable($string);
    }

    /**
     * Creates a new stringable object.
     *
     * @since [*next-version*]
     *
     * @param string $string The string that the stringable should represent.
     *
     * @return Stringable The new stringable.
     */
    public function createStringable($string = '')
    {
        $mock = $this->mock('Dhii\Util\String\StringableInterface')
                ->__toString($this->returnValue($string))
                ->new();

        return $mock;
    }

    /**
     * Tests whether setting and retrieving a command works correctly.
     *
     * @since [*next-version*]
     */
    public function testSetGetCommand()
    {
        $string = uniqid('command-');
        $command = $this->createCommand($string);

        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $_subject->_setCommand($command);
        $result = $_subject->_getCommand();

        $this->assertEquals($command, $result, 'Assigned command is wrong');
    }

    /**
     * Tests whether setting an invalid command fails correctly.
     *
     * @since [*next-version*]
     */
    public function testSetGetCommandFailure()
    {
        $command = new \stdClass();

        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $this->setExpectedException('InvalidArgumentException');
        $_subject->_setCommand($command);
    }
}
