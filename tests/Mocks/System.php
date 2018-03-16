<?php
/**
 * System mock override so we can insert view directories for template testing
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display\Mocks;

class System extends \Slab\Tests\Components\Mocks\System
{
    private $dirs;

    public function __construct($dirs)
    {
        $this->dirs = $dirs;
    }

    public function stack()
    {
        $bundle = new BundleStack($this->dirs);

        return $bundle;
    }
}