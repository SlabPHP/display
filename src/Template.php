<?php
/**
 * SlabPHP Template rendering class
 *
 * @author Eric
 * @package Slab
 * @subpackage Display
 */
namespace Slab\Display;

class Template
{
    /**
     * Template data
     *
     * @var array
     */
    private $_templateData = array();

    /**
     * Curent template
     *
     * @var string
     */
    private $currentTemplate;

    /**
     * Parent template
     *
     * @var string
     */
    private $parentTemplate;

    /**
     * Allow recursion
     *
     * @var bool
     */
    private $allowRecursion = false;

    /**
     * @var array
     */
    private $templateSearchDirectories = [];

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $log;

    /**
     * @return Template
     */
    private function createSubTemplate()
    {
        $className = get_called_class();

        /**
         * @var Template $class
         */
        $class = new $className();

        if (!empty($this->log))
        {
            $class->setLog($this->log);
        }

        $class->setAllowRecursion($this->allowRecursion);
        $class->setTemplateSearchDirectories($this->templateSearchDirectories);
        $class->setParentTemplate($this->currentTemplate);

        return $class;
    }

    /**
     * @param \Psr\Log\LoggerInterface $log
     * @return $this
     */
    public function setLog(\Psr\Log\LoggerInterface $log)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * @param $allowRecursion
     * @return $this
     */
    public function setAllowRecursion($allowRecursion)
    {
        $this->allowRecursion = $allowRecursion;

        return $this;
    }

    /**
     * @param array $searchDirectories
     * @return $this
     */
    public function setTemplateSearchDirectories(array $searchDirectories)
    {
        $this->templateSearchDirectories = $searchDirectories;

        return $this;
    }

    /**
     * Render a template
     *
     * @param string $filename
     * @param mixed $data
     * @param boolean $return
     */
    public function renderTemplate($filename, $data, $return = false)
    {
        $templateOutput = $this->parseTemplate($filename, $data);

        if ($return)
            return $templateOutput;
        else
            echo $templateOutput;
    }

    /**
     * Build a template
     *
     * @param string $filename
     * @param mixed $data
     * @param boolean $return
     * @return string
     */
    private function load($filename, $data = array(), $return = false)
    {
        $template = $this->createSubTemplate();

        try {
            return $template->renderTemplate($filename, $data, $return);
        } catch (\Exception $exception) {
            if (!empty($this->log))
            {
                $this->log->error("Failed to render template " . $filename, $exception);
            }
            return '';
        }
    }

    /**
     * Set current template for the display renderer
     *
     * @param string $currentTemplate
     * @return $this
     */
    public function setCurrentTemplate($currentTemplate)
    {
        $this->currentTemplate = $currentTemplate;

        return $this;
    }

    /**
     * Set parent template
     *
     * @param string $parentTemplate
     * @return $this
     */
    public function setParentTemplate($parentTemplate)
    {
        $this->parentTemplate = $parentTemplate;

         return $this;
    }

    /**
     * Parse a specific filename with data
     *
     * @param string $filename
     * @param array $data
     * @return bool|string
     */
    private function parseTemplate($filename, $data)
    {
        if (is_array($data)) {
            $this->_templateData = $data;
        } else if (is_object($data)) {
            if (method_exists($data, 'getTemplateData')) {
                $this->_templateData = $data->getTemplateData();
            } else {
                $this->_templateData = (array)$data;
            }
        } else {
            $this->_templateData = array('variable' => $data);
        }

        $this->allowRecursion = (!empty($this->_templateData['_allowRecursion']) ? true : false);

        $filename = $this->locateViewFile($filename);

        if ($filename) {
            $this->setCurrentTemplate($filename);

            ob_start();
            include $filename;
            $info = ob_get_contents();
            ob_end_clean();

            return $info;
        }

        return false;
    }

    /**
     * Locate a desired view file
     *
     * @param string $filename
     * @param string $requiredNamespace
     * @return string
     */
    public function locateViewFile($filename, $requiredNamespace = '')
    {
        foreach ($this->templateSearchDirectories as $namespace => $location) {
            if (!empty($requiredNamespace) && ($namespace != $requiredNamespace)) {
                continue;
            }

            $fullFilename = $location . DIRECTORY_SEPARATOR . str_replace('..', '', $filename);

            if (!$this->allowRecursion && ($fullFilename == $this->parentTemplate)) {
                if (!empty($this->log))
                {
                    $this->log->error("Disallowed template recursion found in filename " . $filename . ". To allow recursion, send _allowRecursion=true into the template data.");
                }
                return '';
            }

            if (is_file($fullFilename)) {
                return $fullFilename;
            }
        }

        if (!empty($this->log))
        {
            $this->log->error("Invalid template filename specified " . $filename);
        }

        return '';
    }

    /**
     * Magic getter function for template data
     *
     * @param mixed $value
     * @return mixed
     */
    public function __get($value)
    {
        if (isset($this->_templateData[$value])) {
            return $this->_templateData[$value];
        } else {
            return '';
        }
    }

    /**
     * Magic setter for template data
     *
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value)
    {
        $this->_templateData[$key] = $value;
    }

    /**
     * Isset for template data
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return isset($this->_templateData[$key]);
    }

    /**
     * Used for returning the template data to subtemplates
     *
     * @return array
     */
    public function getTemplateData()
    {
        return $this->_templateData;
    }
}