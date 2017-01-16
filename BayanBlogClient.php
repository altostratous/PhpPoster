<?php
require_once 'BlogClient.php';
/**
 * Created by PhpStorm.
 * User: alto
 * Date: 1/12/17
 * Time: 3:25 PM
 */
class BayanBlogClient extends BlogClient
{
    public function __construct($username, $password, $blog_tag = null)
    {
        parent::__construct(
            $username,
            'username',
            $password,
            'password',
            'input[type=submit]',
            'http://bayan.ir/service/blog/',
            $blog_tag);
    }

    public function send_post($title, $content, $blog_tag = null)
    {
        if ($blog_tag != null)
            $this->blog_tag = $blog_tag;
        $this->browser->wait()->until(function ($driver){
            return strpos($driver->getCurrentUrl(), "http://blog.ir/panel/$this->blog_tag") !== false;
        });
        $this->browser->get("http://blog.ir/panel/$this->blog_tag/post_edit/#new");
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('a[data-cmd=code]'))->click();
        $this->general_send_post($title, $content, 'title', 'content');
    }

    public function submit_post()
    {
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('#txtUrl'))->sendKeys(time());
        $this->browser->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('input.bigBut.saveBut'))->click();
    }
}