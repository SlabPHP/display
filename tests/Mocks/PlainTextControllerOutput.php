<?php
/**
 * Mock Controller Output for Plain Text
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Mocks;

class PlainTextControllerOutput implements \Slab\Components\Output\ControllerResponseInterface
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
        $output = 'Some Text!';

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