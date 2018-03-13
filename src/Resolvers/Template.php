<?php
/**
 * Display Resolver for SlabPHP Templates
 *
 * @package Slab
 * @subpackage Display
 * @author Eric
 */
namespace Slab\Display\Resolvers;

class Template implements \Slab\Components\Output\ResolverInterface
{
    /**
     * @var \Slab\Display\Template
     */
    private $template;

    /**
     * Template constructor.
     * @param array $templateSearchDirectories
     */
    public function __construct($templateSearchDirectories = [])
    {
        $this->template = new \Slab\Display\Template();

        $this->template->setTemplateSearchDirectories($templateSearchDirectories);
    }

    /**
     * @param \Slab\Components\Output\ControllerResponseInterface $response
     * @throws \Exception
     */
    public function resolveResponse(\Slab\Components\Output\ControllerResponseInterface $response)
    {
        $data = $response->getData();

        if (empty($data->template))
        {
            throw new \Exception("Can not render a SlabPHP template without a template file set.");
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

        $this->template->renderTemplate($data->template, $data);
    }
}