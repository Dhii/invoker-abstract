<?php

namespace Dhii\Invocation\FuncTest;

use Xpmock\TestCase;
use Dhii\Invocation\ArgsAwareTrait as TestSubject;
use InvalidArgumentException;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class ArgsAwareTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Invocation\ArgsAwareTrait';

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
     * Tests whether setting and retrieving args works correctly.
     *
     * @since [*next-version*]
     */
    public function testSetGetArgs()
    {
        $args = ['Apple', 'Banana'];

        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $_subject->_setArgs($args);
        $result = $_subject->_getArgs();

        $this->assertEquals($args, $result, 'Assigned args are wrong');
    }

    /**
     * Tests whether setting and retrieving args works correctly.
     *
     * @since [*next-version*]
     */
    public function testSetGetArgsFailure()
    {
        $args = new \stdClass();

        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $this->setExpectedException('InvalidArgumentException');
        $_subject->_setArgs($args);
    }
}
