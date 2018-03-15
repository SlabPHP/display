<?php
/**
 * Mock Controller Output
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Mocks;

class FeedControllerOutput implements \Slab\Components\Output\ControllerResponseInterface
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
        $output->feedData = new \stdClass();
        $output->feedData->a = true;
        $output->feedData->b = ['one', 'two'];
        $output->feedData->c = 123;

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