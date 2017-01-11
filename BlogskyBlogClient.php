<?php

/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/29/2016
 * Time: 9:19 PM
 */
class BlogskyBlogClient extends BlogClient
{

    /**
     * PersianBlogClient constructor.
     * @param $username The user name for persian blog account
     * @param $password The password for persian blog account
     * @param null $blog_tag Blog specifier
     */
    public function __construct($username, $password, $blog_tag = null)
    {
        parent::__construct(array(
            'UserName' => $username,
            'Password' => $password,
        ), "http://www.blogsky.com/login", null);
    }

    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     */
    public function send_post($title, $body, $blog_tag = null)
    {
        $this->blog_tag = $blog_tag;
        parent::post(array('Post.Title' => $title, 'Post.Content' => $body));
    }




    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        return "http://www.blogsky.com/$this->blog_tag/post/new";
    }

    /**
     * @param $title
     * @param $content
     * @param $blogID
     * @return mixed
     */
    public function post($title, $content, $blogID)
    {
        // TODO: Implement post() method.
    }

    /**
     * @return mixed
     */
    protected function get_background_params()
    {
        // TODO: Implement get_background_params() method.
    }
}