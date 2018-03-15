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
     * @var \Slab\Components\SystemInterface
     */
    private $system;

    /**
     * @var \Slab\Display\Template
     */
    private $template;

    /**
     * JSON constructor.
     * @param \Slab\Components\SystemInterface $system
     */
    public function __construct(\Slab\Components\SystemInterface $system)
    {
        $this->system = $system;

        $this->template = new \Slab\Display\Template();

        if ($system->stack())
        {
            $this->template->setTemplateSearchDirectories($system->stack()->getViewDirectories());
        }
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