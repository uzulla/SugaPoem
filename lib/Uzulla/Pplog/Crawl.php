<?php
namespace Uzulla\Pplog;

class Crawl
{
    static $pplog_user_url_prefix = 'https://www.pplog.net/u/';

    /**
     * @param $screen_name_list string[] twitter screen_name
     * @return array
     */
    public static function getByList($screen_name_list)
    {
        $list = [];
        foreach($screen_name_list as $screen_name){
            $list[] = static::get($screen_name);
        }
        return $list;
    }

    /**
     * @param $screen_name string twitter screen_name
     * @return Post
     * @throws \Exception
     */
    public static function get($screen_name)
    {
        $g = new \Goutte\Client();
        $c = $g->request('GET', static::$pplog_user_url_prefix.$screen_name);

        $text = null;
        $created_at_str = null;
        try{
            $title = $c->filter("div.content h1", 0)->text();
            $text = $c->filter("div.content .content-body", 0)->text();
            $created_at_str = $c->filter(".created-at",0)->text();
        }catch(\Exception $e){
            throw new \Exception("get fail {$screen_name}");
        }

        $date = \DateTime::createFromFormat('H:i D d M Y', $created_at_str);

        $comment_list = [];
        $c->filter(".star-contents .star-content")->each(
            function($node) use (&$comment_list) {
                try{
                    $star_name = $node->filter('span.user-name', 0)->text();
                    $star_text = $node->filter('span.text', 0)->text();
                    $comment = new Comment($star_name, $star_text);
                    $comment_list[] = $comment;
                }catch(\Exception $e){
                    return;
                }
            }
        );

        $post = new Post($screen_name, $date, $title, $text, $comment_list);

        return $post;
    }
}