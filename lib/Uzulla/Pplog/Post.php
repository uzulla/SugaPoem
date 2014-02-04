<?php
namespace Uzulla\Pplog;

class Post
{
    /** @var String */
    public $screen_name;
    /** @var String */
    public $text;
    /** @var \DateTime */
    public $created_at;
    /** @var Comment[] */
    public $comment_list;

    public function __construct($screen_name, $created_at, $text, $comment_list)
    {
        $this->screen_name = preg_replace("/[[:cntrl:][:blank:]]/u", '', $screen_name);
        $this->text =  preg_replace("/[[:cntrl:][:blank:]]/u", '', $text);
        $this->created_at = $created_at;
        $this->comment_list = $comment_list;
    }
}