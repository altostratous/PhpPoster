<?php
include_once 'CurlBlogClient.php';
/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/11/2016
 * Time: 11:37 PM
 */
class MihanBlogBlogClient extends CurlBlogClient
{
    /**
     * PersianBlogClient constructor.
     * @param $username The user name for persian blog account
     * @param $password The password for persian blog account
     * @param null $blog_tag Blog specifier
     */
    public function __construct($username, $password, $blog_tag)
    {
        parent::__construct(array(
            'data[userpass]' => $password,
            'data[username]' => $username,
            'data[address]' => $blog_tag
        ), $this->get_login_url(), null);
    }
    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     */
    public function send_post($title, $body, $blog_tag = null){
        $this->blog_tag = $blog_tag;
        // sleep(10);
        parent::post(array('data[title]' => $title, 'data[content1_html]' => $body), 'data%5Bcomment_status%5D=open&data%5Bcomment_close_status%5D=unlimited');
    }
    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        return 'http://mihanblog.com/blog/post/new';
    }

    private function get_login_url()
    {
        $html = $this->grab_page('http://mihanblog.com/web/signin');
        return $this->get_form_action($html);
    }
}