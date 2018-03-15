<?php
/**
 * Mock Controller Output
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Mocks;

class ControllerOutput implements \Slab\Components\Output\ControllerResponseInterface
{
    /**
     * @return mixed
     */
    public function getResolver()
    {
        return 'Mock';
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $output = new \stdClass();
        $output->a = true;
        $output->b = ['one', 'two'];
        $output->c = 123;
        $output->template = 'resolver-template.php';

        return $output;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return [
            'test' => 'true'
        ];
    }

    public function getStatusCode()
    {
        return 200;
    }
}