<?php

namespace Dhii\Invocation\FuncTest;

use Xpmock\TestCase;
use Dhii\Invocation\CommandInvokerAwareTrait as TestSubject;
use Dhii\Invocation\CommandInvokerInterface;
use InvalidArgumentException;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class CommandInvokerAwareTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Invocation\CommandInvokerAwareTrait';

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
     * Creates a new command invoker.
     *
     * @since [*next-version*]
     *
     * @return CommandInvokerInterface The new command.
     */
    public function createCommandInvoker()
    {
        $mock = $this->mock('Dhii\Invocation\CommandInvokerInterface')
                ->invoke()
                ->new();

        return $mock;
    }

    /**
     * Tests whether setting and retrieving a command invoker works correctly.
     *
     * @since [*next-version*]
     */
    public function testSetGetCommandInvoker()
    {
        $invoker = $this->createCommandInvoker();

        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $_subject->_setCommandInvoker($invoker);
        $result = $_subject->_getCommandInvoker();

        $this->assertEquals($invoker, $result, 'Assigned command invoker is wrong');
    }

    /**
     * Tests whether setting and retrieving args works correctly.
     *
     * @since [*next-version*]
     */
    public function testSetGetCommandInvokerFailure()
    {
        $invoker = new \stdClass();

        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $this->setExpectedException('InvalidArgumentException');
        $_subject->_setCommandInvoker($invoker);
    }
}
