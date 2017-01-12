<?php
require_once 'BlogClient.php';
/**
 * Created by PhpStorm.
 * User: HP PC
 * Date: 12/29/2016
 * Time: 9:19 PM
 */
class BlogfaBlogClient extends BlogClient
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
            'usrid' => $username,
            'usrpass' => $password,
        ), "http://www.blogfa.com/Desktop/Login.aspx", null);
    }

    /**
     * @param null $blog_tag The blog ID, you can find it in the url while posting to a blog
     * @param $title The title for the post
     * @param $body The body
     * @return string
     */
    public function send_post($title, $body, $blog_tag = null)
    {
        $this->blog_tag = $blog_tag;
        $this->browser->wait(10);
        return $this->browser->getTitle();
    }




    /**
     * @return mixed returns url to post to weblog
     */
    protected function get_post_url()
    {
        // try to load posting page
        $html = $this->grab_page('http://www.blogfa.com/Desktop/home.aspx?type=first');
        $document = new DOMDocument();
        @$document->loadHTML($html);
        $last_url = 'http://www.blogfa.com/Desktop/'.$document->getElementsByTagName('a')->item(0)->getAttribute('href');
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