<?php
/**
 * PlainText Display Resolver Tests
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Resolvers;

class PlainTextTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Exception
     */
    public function testResolver()
    {
        $mock = new \Slab\Tests\Display\Mocks\PlainTextControllerOutput();

        $resolver = new \Slab\Display\Resolvers\PlainText(new \Slab\Tests\Components\Mocks\System());

        $this->expectOutputString('Some Text!');
        $resolver->resolveResponse($mock);
    }
}