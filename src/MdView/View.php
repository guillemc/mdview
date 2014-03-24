<?php

namespace MdView;

use \Michelf\Markdown;

class View
{

    protected $name;
    protected $content;
    protected $html;
    protected $title;

    public function __construct($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getHtml()
    {
        if (isset($this->html)) {
            return $this->html;
        }

        $this->html = Markdown::defaultTransform($this->content);
        return $this->html;
    }

    public function getTitle()
    {
        if (isset($this->title)) {
            return $this->title;
        }

        $parts = \preg_split("/[_\-]/", $this->name, -1, \PREG_SPLIT_NO_EMPTY);
        $this->title = ucwords(implode(' ', $parts));
        return $this->title;
    }

}
