<?php
/**
 * Display Resolver for Plain Text Output
 *
 * @package Slab
 * @subpackage Display
 * @author Eric
 */
namespace Slab\Display\Resolvers;

class PlainText implements \Slab\Components\Output\ResolverInterface
{
    /**
     * @var \Slab\Components\SystemInterface
     */
    private $system;

    /**
     * JSON constructor.
     * @param \Slab\Components\SystemInterface $system
     */
    public function __construct(\Slab\Components\SystemInterface $system)
    {
        $this->system = $system;
    }

    /**
     * @param \Slab\Components\Output\ControllerResponseInterface $response
     * @throws \Exception
     */
    public function resolveResponse(\Slab\Components\Output\ControllerResponseInterface $response)
    {
        $data = $response->getData();

        if (!headers_sent())
        {
            $headers = $response->getHeaders();

            if (!empty($headers))
            {
                foreach ($headers as $header => $value)
                {
                    header($header . ': ' . $value);
                }
            }
        }

        echo $data;
    }
}