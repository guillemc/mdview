<?php

namespace MdView;

class Layout
{
    protected $basePath = '';
    protected $path;
    protected $defaultTemplate = 'main';
    protected $errorTemplate = 'error';

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function setBasePath($path)
    {
        $this->basePath = $path;
    }

    public function setDefaultTemplate($name)
    {
        $this->defaultTemplate = $name;
    }

    public function setErrorTemplate($name)
    {
        $this->errorTemplate = $name;
    }

    protected function getTemplatePath($name)
    {
        if (substr($name, -4) !== '.php') {
            $name .= '.php';
        }
        $templatePath = $this->path.'/'.$name;
        if (!file_exists($templatePath)) {
            throw new \Exception("Layout not found: {$name}");
        }
        return $templatePath;
    }

    public function render(View $v)
    {
        $filePath = $this->getTemplatePath($this->defaultTemplate);
        //TO DO: specific layouts for views
        return $this->renderInternal($filePath, array(
            'title' => $v->getTitle(),
            'content' => $v->getHtml(),
        ));
    }

    public function error($message, $code)
    {
        $filePath = $this->getTemplatePath($this->errorTemplate);
        return $this->renderInternal($filePath, array(
            'code' => $code,
            'title' => "Error $code",
            'content' => $message,
        ));
    }

    protected function renderInternal($filePath, $vars)
    {
        extract($vars);
        $basePath = $this->basePath;
        ob_start();
        include($filePath);
        $content = ob_get_clean();
        return $content;
    }

}
