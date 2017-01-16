<?php
include_once 'CurlBlogClient.php';
/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/11/2016
 * Time: 11:37 PM
 */
class PishroblogBlogClient extends CurlBlogClient
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
            'username' => $username,
            'password' => $password,
        ), "http://pishroblog.ir/Login", null);
    }
    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     */
    public function send_post($title, $body, $blog_tag = null){
        $this->blog_tag = $blog_tag;
        parent::post(array('mtitle' => $title, 'mtex' => $body));
    }
    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        return 'http://pishroblog.ir/Panel/npost6.php';
    }
}