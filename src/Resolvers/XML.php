<?php
/**
 * Display Resolver for XML output
 *
 * @package Slab
 * @subpackage Display
 * @author Eric
 */
namespace Slab\Display\Resolvers;

class XML implements \Slab\Components\Output\ResolverInterface
{
    /**
     * @param \Slab\Components\Output\ControllerResponseInterface $response
     * @throws \Exception
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

        $converter = new \SalernoLabs\PHPToXML\Convert();
        $xml = $converter
            ->setObjectData($data)
            ->convert();

        echo $xml;
    }
}