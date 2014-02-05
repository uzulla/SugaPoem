<?php
namespace Uzulla\Pplog;

class Post
{
    /** @var String */
    public $screen_name;
    /** @var String */
    public $title;
    /** @var String */
    public $text;
    /** @var \DateTime */
    public $created_at;
    /** @var Comment[] */
    public $comment_list;

    public function __construct($screen_name, \DateTime $created_at, $title, $text, array $comment_list)
    {
        $this->screen_name = ltrim(preg_replace("/[[:cntrl:][:blank:]]/u", '', $screen_name), '@');
        $this->title = preg_replace("/[[:cntrl:][:blank:]]/u", '', $title);
        $this->text = rtrim(ltrim($text));
        $this->created_at = $created_at;
        $this->comment_list = $comment_list;
    }
}