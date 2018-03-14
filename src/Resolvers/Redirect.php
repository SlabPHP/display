<?php
/**
 * Display Resolver for Redirects
 *
 * @package Slab
 * @subpackage Display
 * @author Eric
 */
namespace Slab\Display\Resolvers;

class Redirect implements \Slab\Components\Output\ResolverInterface
{
    /**
     * @param \Slab\Components\Output\ControllerResponseInterface $response
     * @return bool|void
     * @throws \Exception
     */
    public function resolveResponse(\Slab\Components\Output\ControllerResponseInterface $response)
    {
        $data = $response->getData();

        if (empty($data->url))
        {
            throw new \Exception("Missing url in the Redirect resolver.");
        }

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

        $code = 301;
        if (!empty($data->code))
        {
            $code = $data->code;
        }

        header('Location: ' . $data->url, true, $code);
    }
}