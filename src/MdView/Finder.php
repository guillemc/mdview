<?php

namespace MdView;

class Finder
{
    protected $path;
    protected $defaultNames;

    public function __construct($path, $defaultNames)
    {
        $this->path = $path;
        $this->defaultNames = $defaultNames;
    }

    public function find($viewName)
    {
        $test = $this->path;
        $viewName = trim($viewName, '/');
        if ($viewName) {
            $test = $test."/$viewName";
        }

        foreach (array($test, $test.'.md') as $file) {
            if (is_file($file)) {
                return new View($viewName, file_get_contents($file));
            }
        }

        if (is_dir($test)) {
            foreach ($this->defaultNames as $name) {
                $file = $test.'/'.$name;
                if (is_file($file)) {
                    return new View($viewName, file_get_contents($file));
                }
            }
        }

        return null;
    }

}
