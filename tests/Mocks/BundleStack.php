<?php
/**
 * Bundle stack mock override so we can insert view directories for template testing
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Mocks;

class BundleStack
{
    private $dirs;

    public function __construct($dirs)
    {
        $this->dirs = $dirs;
    }

    public function getViewDirectories()
    {
        return $this->dirs;
    }
}