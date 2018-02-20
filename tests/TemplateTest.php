<?php
/**
 * Template Tests
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Display;

class TemplateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test simple template rendering
     */
    public function testSimpleTemplate()
    {
        $template = new \Slab\Display\Template();
        $template->setTemplateSearchDirectories(['default'=>__DIR__.'/templates']);

        $output = $template->renderTemplate('simple-test.php', ['test'=>'shenanigans'], true);

        $this->assertEquals('This is a super simple Template! Your test variable is shenanigans.', $output);
    }

    /**
     * Test complex template rendering
     */
    public function testComplexTemplate()
    {
        $template = new \Slab\Display\Template();
        $template->setTemplateSearchDirectories(['default'=>__DIR__.'/templates']);

        $output = $template->renderTemplate('complex-test.php', [], true);

        $this->assertEquals('Complex test! Hi!', $output);
    }

    /**
     * Test cascading directories
     */
    public function testCascadingDirectories()
    {
        $template = new \Slab\Display\Template();
        $template->setTemplateSearchDirectories(
            [
                'site2'=>__DIR__.'/templates/site2',
                'site1'=>__DIR__.'/templates/site1'
            ]
        );

        $output = $template->renderTemplate('default.php', [], true);
        $this->assertEquals('Site 2.', $output);

        $output = $template->renderTemplate('thing.php', [], true);
        $this->assertEquals('Site 1 THING!', $output);
    }
}