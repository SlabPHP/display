<?php
/**
 * Json Display Resolver Tests
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Resolvers;

class JSONTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Exception
     */
    public function testResolver()
    {
        $mock = new \Slab\Tests\Display\Mocks\ControllerOutput();

        $resolver = new \Slab\Display\Resolvers\JSON();

        $this->expectOutputString('{"a":true,"b":["one","two"],"c":123,"template":"resolver-template.php"}');
        $resolver->resolveResponse($mock);
    }
}