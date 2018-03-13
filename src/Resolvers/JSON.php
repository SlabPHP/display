<?php
/**
 * Display Resolver for JSON output
 *
 * @package Slab
 * @subpackage Display
 * @author Eric
 */
namespace Slab\Display\Resolvers;

class JSON implements \Slab\Components\Output\ResolverInterface
{
    /**
     * @param \Slab\Components\Output\ControllerResponseInterface $response
     */
    public function resolveResponse(\Slab\Components\Output\ControllerResponseInterface $response)
    {
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

        $data = $response->getData();
        echo json_encode($data);
    }
}