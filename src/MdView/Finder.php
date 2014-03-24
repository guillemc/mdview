<?php

namespace MdView;

class Finder
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function find($viewName)
    {
        $filePath = $this->path.'/'.$viewName.'.md';
        if (file_exists($filePath)) {
            return new View($viewName, file_get_contents($filePath));
        }
        return null;
    }

}
