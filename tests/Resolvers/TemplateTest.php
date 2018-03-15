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
        return;

        $mock = new \Slab\Tests\Display\Mocks\ControllerOutput();

        $dirs = ['site1'=>__DIR__.'/../templates'];
        $templateTest = new \Slab\Display\Resolvers\Template(new \Slab\Tests\Components\Mocks\System());

        $this->expectOutputString('A: 1 B: one-two C: 123');
        $templateTest->resolveResponse($mock);
    }
}