<?php
require_once 'BlogClient.php';
/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/12/17
 * Time: 3:25 PM
 */
class BlogfaBlogClient extends BlogClient
{
    public function __construct($username, $password, $blog_tag = null)
    {
        parent::__construct(
            $username,
            'usrid',
            $password,
            'usrpass',
            'input[name=btnSubmit]',
            'http://blogfa.com/',
            $blog_tag);
    }

    public function send_post($title, $content, $blog_tag = null)
    {
        $this->browser->wait()->until(function ($driver){
            return strpos($driver->getCurrentUrl(), 'https://blogfa.com/Desktop/Default.aspx') !== false;
        });
        $this->browser->get('https://blogfa.com/Desktop/home.aspx?type=first');
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::tagName('a'))->click();
        $this->browser->wait()->until(function ($driver){
            return count($driver->findElements(\Facebook\WebDriver\WebDriverBy::id('btnPublish'))) > 0;
        });
        $this->general_send_post($title, $content, 'txtTitle', 'txtPostBody');
    }

    public function submit_post()
    {
        sleep(5);
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('#btnPublish'))->click();
    }
}