<?php
/**
 * Template Display Resolver Tests
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Resolvers;

class TemplateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Exception
     */
    public function testResolver()
    {
        $mock = new \Slab\Tests\Display\Mocks\ControllerOutput();

        $system = new \Slab\Tests\Display\Mocks\System(['site1'=>__DIR__.'/../templates']);
        $templateTest = new \Slab\Display\Resolvers\Template($system);

        $this->expectOutputString('A: 1 B: one-two C: 123');
        $templateTest->resolveResponse($mock);
    }
}