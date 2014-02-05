<?php
namespace Uzulla\Pplog;

class Comment
{
    /** @var String */
    public $screen_name;
    /** @var String */
    public $text;

    public function __construct($screen_name, $text)
    {
        $this->text = preg_replace("/[[:cntrl:][:blank:]]/u", '', $text);
        $this->screen_name = ltrim(preg_replace("/[[:cntrl:][:blank:]]/u", '', $screen_name), '@');
    }
}