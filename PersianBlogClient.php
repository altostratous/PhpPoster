<?php

include_once 'BlogClient.php';

/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/11/2016
 * Time: 11:37 PM
 */
class PersianBlogClient extends BlogClient
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
            'TxtPassword' => $password,
            'TxtUsername' => $username
        ), "http://persianblog.ir/Login.aspx?ReturnUrl=%2fHome.aspx", null);
    }

    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     */
    public function send_post($title, $body, $blog_tag = null){
        $this->blog_tag = $blog_tag;
        parent::post(array('TxtTitle' => $title, 'intrContent' => $body));
    }




    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        // try to load posting page
        $ch = $this->grab_page_handle("http://persianblog.ir/CreatePost.aspx?blogID=$this->blog_tag");
        // get the redirected url containing the 'h' parameter
        $last_url = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
        return $last_url;
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