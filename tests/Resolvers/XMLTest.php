<?php
/**
 * XML Display Resolver Tests
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Resolvers;

class XMLTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Exception
     */
    public function testResolver()
    {
        $mock = new \Slab\Tests\Display\Mocks\FeedControllerOutput();

        $resolver = new \Slab\Display\Resolvers\XML();

        $output = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . PHP_EOL;
        $output .= "<data>" . PHP_EOL;
        $output .= "    <a>1</a>" . PHP_EOL;
        $output .= "    <b>one</b>" . PHP_EOL;
        $output .= "    <b>two</b>" . PHP_EOL;
        $output .= "    <c>123</c>" . PHP_EOL;
        $output .= "</data>";

        $this->expectOutputString($output);
        $resolver->resolveResponse($mock);
    }
}